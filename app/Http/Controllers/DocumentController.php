<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use App\Services\NotificationService;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function generate_contract(User $user)
    {
        if (!$user->salaire || !$user->duree_contrat) {
            return to_route('edit_created_user', $user)->with('error', 'Certaines informations sont manquantes');
        } else {

            $fileName = $user->matricule . '_contrat.pdf';

            // Charger la vue
            $view = view('pages.contrat', ['user' => $user]);
            $page = $view->render();

            // Générer le PDF
            $pdf = new Dompdf();
            $pdf->loadHtml($page);
            $pdf->setPaper('A4', 'Portrait');
            $pdf->render();

            // Enregistrer le fichier PDF sur le serveur
            $output = $pdf->output();
            $filePath = 'contracts/' . $fileName;
            Storage::disk('public')->put($filePath, $output);

            // Mettre à jour l'utilisateur avec le chemin du fichier PDF
            $user->lien_contrat = $filePath;
            $user->save();
            NotificationService::notifyContrat($user->id, $filePath);

            // Rediriger vers une vue qui affiche le PDF
            return view('pages.show_pdf_view', ['lien' => $user->lien_contrat]);
        }
    }


    public function dossier_perso()
    {
        // Obtenez tous les utilisateurs avec tous leurs fichiers personnels
        $users = User::with(['demandeconges' => function ($query) {
            $query->whereNotNull('justificatif');
        }])
            ->orWhereNotNull('comp_file')
            ->orWhereNotNull('photo_file')
            ->orWhereNotNull('lien_contrat')
            ->with('fichePaies')
            ->get();

        return view('pages.update.dossiers', compact('users'));
    }

    public function dossier_perso_folder()
    {
        $users = User::with(['demandeconges', 'fichePaies'])->get();

        $filesGroupedByType = [
            'photos' => [],
            'comp_files' => [],
            'contrats' => [],
            'justificatifs' => [],
            'fiches_de_paie' => []
        ];

        foreach ($users as $user) {
            if ($user->photo_file) {
                $filesGroupedByType['photos'][] = [
                    'user' => $user,
                    'file' => $user->photo_file,
                    'type' => 'Photo'
                ];
            }
            if ($user->comp_file) {
                $filesGroupedByType['comp_files'][] = [
                    'user' => $user,
                    'file' => $user->comp_file,
                    'type' => 'Compétence'
                ];
            }
            if ($user->lien_contrat) {
                $filesGroupedByType['contrats'][] = [
                    'user' => $user,
                    'file' => $user->lien_contrat,
                    'type' => 'Contrat'
                ];
            }
            foreach ($user->demandeconges as $demandeconge) {
                if ($demandeconge->justificatif) {
                    $filesGroupedByType['justificatifs'][] = [
                        'user' => $user,
                        'file' => $demandeconge->justificatif,
                        'type' => 'Justificatif'
                    ];
                }
            }
            foreach ($user->fichePaies as $fiche) {
                if ($fiche->lien_fiche) {
                    $filesGroupedByType['fiches_de_paie'][] = [
                        'user' => $user,
                        'file' => $fiche->lien_fiche,
                        'type' => 'Fiche de paie'
                    ];
                }
            }
        }

        return view('pages.update.dossiers', compact('filesGroupedByType'));
    }
}
