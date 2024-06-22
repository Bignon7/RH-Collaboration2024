<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $query = Notification::where('user_id', Auth::user()->id)
            ->whereNull('read_at')
            ->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->input('search');

            // Vérifier si le terme de recherche est une durée relative ou une date spécifique
            if (preg_match('/^(\d+)\s*(minute|minutes|heure|heures|jour|jours|semaine|semaines|mois)?$/i', $search, $matches)) {
                // Durée relative
                $quantity = (int) $matches[1];
                $unit = isset($matches[2]) ? strtolower($matches[2]) : 'jours'; // Utiliser "jours" par défaut si aucune unité n'est spécifiée

                // Calculer la date limite en fonction de la durée relative
                $dateLimit = Carbon::now();
                switch ($unit) {
                    case 'minute':
                    case 'minutes':
                        $dateLimit->subMinutes($quantity);
                        break;
                    case 'heure':
                    case 'heures':
                        $dateLimit->subHours($quantity);
                        break;
                    case 'jour':
                    case 'jours':
                        $dateLimit->subDays($quantity);
                        break;
                    case 'semaine':
                    case 'semaines':
                        $dateLimit->subWeeks($quantity);
                        break;
                    case 'mois':
                        $dateLimit->subMonths($quantity);
                        break;
                }

                $query->where('created_at', '>=', $dateLimit);
            } else {
                // Essayer de convertir l'entrée en date
                $dateFormats = ['d/m', 'd-m', 'd F', 'd F Y', 'd/m/Y', 'd-m-Y', 'Y-m-d'];
                $date = null;
                foreach ($dateFormats as $format) {
                    try {
                        $date = Carbon::createFromFormat($format, $search, 'Europe/Paris');
                        break;
                    } catch (\Exception $e) {
                        // Ignorer l'exception et essayer le format suivant
                    }
                }

                if ($date) {
                    $query->whereDate('created_at', $date);
                } else {
                    $query->where(function ($q) use ($search) {
                        $q->where('type_notification', 'LIKE', "%{$search}%")
                            ->orWhere('title_notification', 'LIKE', "%{$search}%")
                            ->orWhere('contenu_notification', 'LIKE', "%{$search}%")
                            ->orWhere('data', 'LIKE', "%{$search}%");
                    });
                    // Recherche également dans le champ formattedDate
                    $query->orWhere(function ($q) use ($search) {
                        $q->whereRaw("DATE_FORMAT(created_at, '%e %M') LIKE ?", ["%$search%"])
                            ->orWhereRaw("DATE_FORMAT(created_at, '%e %M %Y') LIKE ?", ["%$search%"]);
                    });
                }
            }
        }

        $notifications = $query->paginate(10);
        return view('pages.indexs.notification_index', compact('notifications'));
    }



    public function read(Request $request)
    {
        $query = Notification::where('user_id', Auth::user()->id)->whereNotNull('read_at')->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->input('search');
            if (preg_match('/^(\d+)\s*(minute|minutes|heure|heures|jour|jours|semaine|semaines|mois)?$/i', $search, $matches)) {
                // Durée relative
                $quantity = (int) $matches[1];
                $unit = isset($matches[2]) ? strtolower($matches[2]) : 'jours'; // Utiliser "jours" par défaut si aucune unité n'est spécifiée

                // Calculer la date limite en fonction de la durée relative
                $dateLimit = Carbon::now();
                switch ($unit) {
                    case 'minute':
                    case 'minutes':
                        $dateLimit->subMinutes($quantity);
                        break;
                    case 'heure':
                    case 'heures':
                        $dateLimit->subHours($quantity);
                        break;
                    case 'jour':
                    case 'jours':
                        $dateLimit->subDays($quantity);
                        break;
                    case 'semaine':
                    case 'semaines':
                        $dateLimit->subWeeks($quantity);
                        break;
                    case 'mois':
                        $dateLimit->subMonths($quantity);
                        break;
                }

                $query->where('created_at', '>=', $dateLimit);
            } else {
                // Essayer de convertir l'entrée en date
                $dateFormats = ['d/m', 'd-m', 'd F', 'd F Y', 'd/m/Y', 'd-m-Y', 'Y-m-d'];
                $date = null;
                foreach ($dateFormats as $format) {
                    try {
                        $date = Carbon::createFromFormat($format, $search, 'Europe/Paris');
                        break;
                    } catch (\Exception $e) {
                        // Ignorer l'exception et essayer le format suivant
                    }
                }

                if ($date) {
                    $query->whereDate('created_at', $date);
                } else {
                    $query->where(function ($q) use ($search) {
                        $q->where('type_notification', 'LIKE', "%{$search}%")
                            ->orWhere('title_notification', 'LIKE', "%{$search}%")
                            ->orWhere('contenu_notification', 'LIKE', "%{$search}%")
                            ->orWhere('data', 'LIKE', "%{$search}%");
                    });
                    // Recherche également dans le champ formattedDate
                    $query->orWhere(function ($q) use ($search) {
                        $q->whereRaw("DATE_FORMAT(created_at, '%e %M') LIKE ?", ["%$search%"])
                            ->orWhereRaw("DATE_FORMAT(created_at, '%e %M %Y') LIKE ?", ["%$search%"]);
                    });
                }
            }
        }

        $notifications = $query->paginate(10);
        return view('pages.indexs.notification_index', compact('notifications'));
    }

    // Marquer une notification comme lue
    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->markAsRead();
        return back()->with('success', 'Cette notification a été marquée comme lue');
    }

    // Marquer une notification comme non lue
    public function markAsUnread($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->markAsUnread();
        return back()->with('success', 'Cette notification a été marquée comme non lue');
    }

    // Supprimer une notification
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
        return back()->with('success', 'Cette notification a été supprimée');
    }


    public function store_message(Request $request)
    {
        $messages = [
            'nom_message.required' => 'Le champ nom est requis.',
            'nom_message.string' => 'Le champ nom doit contenir uniquement des lettres.',
            'nom_message.max' => 'Le champ nom ne doit pas dépasser :max caractères.',
            'nom_message.regex' => 'Le champ nom ne doit contenir que des caractères alphabétiques commençant par une majuscule',
            'email_message.required' => 'Le champ email est requis.',
            'email_message.email' => 'Veuillez saisir une adresse email valide.',
            'email_message.max' => 'Le champ email ne doit pas dépasser :max caractères.',
            'contenu_message.min' => 'Le champ contenu doit contenir au moins :min caractères.',
            'contenu_message.required' => 'Le champ contenu est requis.',
            'contenu_message.string' => 'Le champ contenu doit contenir uniquement des caractères alphanumériques.',
        ];
        $request->validate([
            'nom_message' => 'required|string|max:150|regex:/^[A-ZÀ-ÖÙ-ÝŸ][a-zA-ZÀ-ÖØ-öø-ÿ-]*(\s[A-ZÀ-ÖÙ-ÝŸ][a-zA-ZÀ-ÖØ-öø-ÿ-]*)*$/',
            'email_message' => 'required|string|email|max:100',
            'contenu_message' => 'required|string|min:50',
        ], $messages);

        Message::create([
            'nom_message' => $request->nom_message,
            'email_message' => $request->email_message,
            'contenu_message' => $request->contenu_message,
        ]);
        return back()->with('success', 'Votre message a bien été envoyé!');
    }
}
