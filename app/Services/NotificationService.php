<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    //Ici les fonctions sont définies avec static parce qu'on veut pouvoir les appeler en utilisant ClassName::methodName


    // Envoyer une notification à un utilisateur
    public static function sendToUser($userId, $type, $title, $content, $data = [])
    {
        return Notification::create([
            'user_id' => $userId,
            'type_notification' => $type,
            'title_notification' => $title,
            'contenu_notification' => $content,
            'data' => $data,
        ]);
    }

    // Envoyer une notification à plusieurs utilisateurs
    public static function sendToUsers($userIds, $type, $title, $content, $data = [])
    {
        foreach ($userIds as $userId) {
            self::sendToUser($userId, $type, $title, $content, $data);
        }
    }

    // Méthode pour générer une notification de type "new_formation"
    public static function notifyNewFormation($userIds, $formation)
    {
        $type = 'new_formation';
        $title = 'Lancement d\'une nouvelle formation';
        $content = 'Une nouvelle formation a été créée pour un but spécifique.';
        $data = ['formation' => $formation];

        self::sendToUsers($userIds, $type, $title, $content, $data);
    }

    // Méthode pour générer une notification de type "new_employee"
    public static function notifyNewEmployee($employe)
    {
        $type = 'new_employee';
        $title = 'Un nouvel employé a été enregistré ';
        $content = 'Un nouvel employé a été ajouté.';
        $data = ['employe' => $employe];
        $userIds = User::where('role', 'Admin')->orWhere('role', 'Gestionnaire')->pluck('id');

        self::sendToUsers($userIds, $type, $title, $content, $data);
    }

    public static function notifyDemandeConge($demandeconge)
    {
        $type = 'new_demande_conge';
        $title = 'Nouvelle demande d\'absence';
        $content = "Une nouvelle demande d\'absence ou de congés a été émise";
        $data = ['demandeconge' => $demandeconge];
        $userIds = User::where('role', 'Gestionnaire')->pluck('id');

        self::sendToUsers($userIds, $type, $title, $content, $data);
    }

    public static function notifyDemandeCongeResponse($userId, $demandecongeId, $response)
    {
        $type = 'demande_conge_response';
        $title = 'Réponse à une demande';
        $content = "Votre demande de congé a reçu une réponse : $response.";
        $data = ['demandeconge_id' => $demandecongeId, 'response' => $response];

        self::sendToUser($userId, $type, $title, $content, $data);
    }


    public static function notifyInscription($inscription)
    {
        $type = 'new_inscription';
        $title = 'Un participant de plus à une formation';
        $content = "Une nouvelle inscription à une formation à été enregistrée";
        $data = ['inscription' => $inscription];
        $userIds = User::where('role', 'Gestionnaire')->pluck('id');
        self::sendToUsers($userIds, $type, $title, $content, $data);
    }

    public static function notifyFiche($userId, $fiche)
    {
        $type = 'new_fiche';
        $title = 'Viche de paie du mois générée!';
        $content = "Votre fiche de paie a été générée pour le mois courant";
        $data = ['fiche' => $fiche];
        self::sendToUser($userId, $type, $title, $content, $data);
    }

    public static function notifyContrat($userId, $contrat)
    {
        $type = 'new_contrat';
        $title = 'Votre contrat de travail est prêt!';
        $content = "Votre contrat de travail est disponible";
        $data = ['contrat' => $contrat];
        self::sendToUser($userId, $type, $title, $content, $data);
    }

    //Pour informer le gestionnaire qu'un utilisateur a mis à jour ses informations personnelles
    public static function notifySelfProfileUpdate($user)
    {
        $type = 'new_profile_update';
        $title = 'Nouvelle mise à jour de profil';
        $content = "Un utilisateur vient de mettre à jour son profil en modifiant ses informations personnelles";
        $data = ['user' => $user];
        $userIds = User::where('role', 'Gestionnaire')->pluck('id');

        self::sendToUsers($userIds, $type, $title, $content, $data);
    }


    //Pour informer un utilisateur que ses informations administratives ont été mises à jour
    public static function notifyUserProfileUpdate($userId)
    {
        $type = 'new_profile_update';
        $title = 'Mise à jour de vos données administratives';
        $content = "Vos informations administratives ont été mises à jour par un gestionnaire";
        $data = [];

        self::sendToUser($userId, $type, $title, $content, $data);
    }
}

//Penser à l'améliorer lorsque les objectifs seront mieux définis
