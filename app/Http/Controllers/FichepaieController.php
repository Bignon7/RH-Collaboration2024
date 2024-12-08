<?php

namespace App\Http\Controllers;

use App\Models\Fichepaie;
use App\Models\User;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FichepaieController extends Controller
{
    public function showsession()
    {
        return view('pages.manager.generation');
    }

    public function showImportForm()
    {
        return view('pages.fiches.import');
    }

    // public function importFiches(Request $request)
    // {
    //     $request->validate([
    //         'payslips_files' => 'required',
    //         'payslips_files.*' => 'file|mimes:pdf,jpeg,png,jpg,doc,docx,xlsx|max:4096', // Exemple: Taille maximale de 2 Mo
    //     ]);

    //     $files = $request->file('payslips_files');
    //     if (!$files) {
    //         return redirect()->route('fiches.import')->with('error', 'Aucun fichier trouvé.');
    //     }
    //     foreach ($files as $file) {
    //         $originalName = $file->getClientOriginalName();
    //         $filename = pathinfo($originalName, PATHINFO_FILENAME);
    //         //$extension = $file->getClientOriginalExtension();

    //         $pattern = '/^\d+_[\w!@#$%_()\/-|.]+$/';

    //         if (preg_match($pattern, $filename)) {

    //             list($matricule, $nom) = explode('_', $filename);

    //             // Find the user by matricule
    //             $user = User::where('matricule', $matricule)->first();
    //             if ($user) {
    //                 $path = $file->storeAs('public/payslips', $originalName);
    //                 Fichepaie::create([
    //                     'user_id' => $user->id,
    //                     'lien_fiche' => $path,
    //                 ]);
    //             } else {
    //                 return back()->with('error', "Le fichier $originalName n'a pas été stocké parce qu'il ne correspond à aucun utilisateur");
    //             }
    //         } else {
    //             return back()->with('error', "Le fichier $originalName importé n'a pas un format acceptable et ne peut donc pas être stocké");
    //         }
    //     }
    //     return redirect()->route('fiches.import')->with('success', 'Fiches de paie importées avec succès.');
    // }

    public function importFiches(Request $request)
    {
        $request->validate([
            'payslips_files' => 'required',
            'payslips_files.*' => 'file|mimes:pdf,jpeg,png,jpg,doc,docx,xlsx|max:4096', // Exemple: Taille maximale de 4 Mo
        ]);

        $files = $request->file('payslips_files');
        if (!$files) {
            return redirect()->route('fiches.import')->with('error', 'Aucun fichier trouvé.');
        }

        $errors = [];
        $successCount = 0;

        foreach ($files as $file) {
            $originalName = $file->getClientOriginalName();
            $filename = pathinfo($originalName, PATHINFO_FILENAME);

            $pattern = '/^\d+_[\w!@#$%_()\/\-|.]+$/';

            if (preg_match($pattern, $filename)) {
                list($matricule, $nom) = explode('_', $filename);

                // Find the user by matricule
                $user = User::where('matricule', $matricule)->first();
                if ($user) {
                    $path = $file->storeAs('public/payslips', $originalName);
                    Fichepaie::create([
                        'user_id' => $user->id,
                        'lien_fiche' => $path,
                    ]);
                    $successCount++;
                } else {
                    $errors[] = "Le fichier $originalName n'a pas été stocké parce qu'il ne correspond à aucun utilisateur.";
                }
            } else {
                $errors[] = "Le fichier $originalName importé n'a pas un format acceptable et ne peut donc pas être stocké.";
            }
        }

        if ($successCount > 0) {
            $successMessage = "$successCount fiches de paie importées avec succès.";
        } else {
            $successMessage = "Aucune fiche de paie n'a été importée.";
        }

        return redirect()->route('fiches.import')->with([
            'success' => $successMessage,
            'errors' => $errors,
        ]);
    }

    public function viewFiche($id)
    {
        $fiche = Fichepaie::findOrFail($id);
        $filePath = storage_path('app/public/' . str_replace('public/', '', $fiche->lien_fiche));
        if (!file_exists($filePath)) {
            return redirect()->route('fiches.mes')->with('error', 'Fichier non trouvé.');
        }

        return response()->file($filePath);
    }

    public function mesFiches()
    {
        $userId = auth()->id();
        $fiches = Fichepaie::where('user_id', $userId)->get();

        return view('pages.fiches.mes', ['fiches' => $fiches]);
    }

    public function send_notif_employee()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $users = User::where('role', 'Employé')->orWhere('role', 'Gestionnaire')->get();

        foreach ($users as $user) {
            // Trouver la fiche de paie pour le mois et l'année actuels
            $fiche = $user->fichepaies()
                ->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear)
                ->first();
            $lienFiche = $fiche ? $fiche->lien_fiche : '';
            NotificationService::notifyFiche($user->id, $lienFiche);
        }
        return redirect()->back()->with('success', 'Notifications envoyées à tous les employés.');
    }



    public function showOneFicheForm()
    {
        return view('pages.forms.fichepaieuser_form');
    }

    public function storeOneUserFiche(Request $request)
    {
        // var_dump($request);
        // dd($request);
        $request->validate([
            'matricule' => 'required|numeric',
            'email' => 'required|email',
            'lien_fiche' => 'required|file|mimes:png,jpg,jpeg,pdf,docx,doc|max:2048',
            //'lien_fiche.*' => 'file|mimes:png,jpg,jpeg,pdf,docx,doc|max:2048',
        ]);
        $matricule = $request->matricule;
        $email = $request->email;
        $user = User::where('matricule', $matricule)->where('email', $email)->first();
        if ($user) {
            $fichePath = $matricule . '_' . $request->file('lien_fiche')->getClientOriginalName();
            $lien_fiche = $request->file('lien_fiche')->storeAs('public/payslips', $fichePath);
            Fichepaie::create([
                'user_id' => $user->id,
                'lien_fiche' => $lien_fiche,
            ]);
            NotificationService::notifyFiche($user->id, $lien_fiche);
            return redirect()->route('get_dash')->with('success', 'La fiche de paie a bien été importée');
        } else {
            return back()->with('error', 'Aucun utilisateur ne correspond aux informations entrées.');
        }
    }
}
