<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;

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
        $title = "Lancement d'une nouvelle formation nommée:" . ' ' . $formation->intitule_formation;
        $content = 'Une nouvelle formation a été créée pour un but spécifique et débutera le' . ' ' . $formation->date_debut_formation . ' pour une durée de ' . $formation->duree_formation;
        $data = ['formation' => $formation];

        self::sendToUsers($userIds, $type, $title, $content, $data);
    }

    // Méthode pour générer une notification de type "new_employee"
    public static function notifyNewEmployee($employe)
    {
        $type = 'new_employee';
        $title = 'Un nouvel employé a été enregistré ';
        $content = "L'employé " . $employe->nom . ' ' . $employe->prenom . " vient de rejoindre l'entreprise";
        $data = ['employe' => $employe];
        $userIds = User::where('role', 'Admin')->orWhere('role', 'Gestionnaire')->pluck('id');

        self::sendToUsers($userIds, $type, $title, $content, $data);
    }

    public static function notifyDemandeConge($demandeconge)
    {
        $type = 'new_demande_conge';
        $title = "Nouvelle demande d'absence par: " . $demandeconge->user->nom . ' ' . $demandeconge->user->prenom;
        $content = "Cet employé demande à s'absenter pour une durée de " . $demandeconge->duree_conge;
        $data = ['demandeconge' => $demandeconge];
        $userIds = User::where('role', 'Gestionnaire')->orWhere('role', 'Admin')->pluck('id');

        self::sendToUsers($userIds, $type, $title, $content, $data);
    }

    public static function notifyDemandeCongeResponse($userId, $demandeconge, $response)
    {
        $type = 'demande_conge_response';
        $title = "Réponse à votre demande d'absence";
        $content = "Votre demande de congé a reçu une réponse : $response.";
        $data = ['demandeconge' => $demandeconge, 'response' => $response];

        self::sendToUser($userId, $type, $title, $content, $data);
    }


    public static function notifyInscription($inscription)
    {
        $type = 'new_inscription';
        $title = 'Un participant de plus à la formation' . ' ' . $inscription->formation->intitule_formation;
        $content = "L'employé " . $inscription->user->nom . ' ' . $inscription->user->prenom . " vient de s'inscrire à la formation: " . $inscription->formation->intitule_formation;
        $data = ['inscription' => $inscription];
        $userIds = User::where('role', 'Gestionnaire')->orWhere('role', 'Admin')->pluck('id');
        self::sendToUsers($userIds, $type, $title, $content, $data);
    }

    public static function notifyService($service)
    {
        $type = 'new_service';
        $title = 'Nouveau service!';
        $content = "Un nouveau service ou département nommé " . $service->nom_service . " a été créé dans la structure";
        $data = ['service' => $service];
        $userIds = User::where('role', 'Gestionnaire')->pluck('id');
        self::sendToUsers($userIds, $type, $title, $content, $data);
    }

    public static function notifyFiche($userId, $fiche)
    {
        $type = 'new_fiche';
        $currentMonth = Carbon::now()->locale('fr_FR')->isoFormat('MMMM YYYY');
        $title = "La Fiche de paie de $currentMonth est générée !";
        $content = "Votre fiche de paie pour le mois de $currentMonth est prête";
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
        $content = $user->nom . ' ' . $user->prenom . " vient de mettre à jour son profil en modifiant ses informations personnelles";
        $data = ['user' => $user];
        $userIds = User::where('role', 'Gestionnaire')->orWhere('role', 'Admin')->pluck('id');

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
