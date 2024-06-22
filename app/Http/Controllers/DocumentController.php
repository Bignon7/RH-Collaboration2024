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
}
