<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Inscription;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InscriptionController extends Controller
{
    // public function indexById($id)
    // {
    //     return view('pages.indexs.inscription_index', [
    //         'inscriptions' => Inscription::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(1),
    //     ]);
    // }

    public function indexById(Request $request)
    {
        $query = Inscription::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->search($search);
        }

        $inscriptions = $query->paginate(6);

        return view('pages.indexs.inscription_index', compact('inscriptions'));
    }

    public function inscrire($formationId)
    {
        $formation = Formation::findOrFail($formationId);

        $inscription = new Inscription();
        $inscription->user_id = Auth::id();
        $inscription->formation_id = $formationId;
        $inscription->date_inscription = now();
        $inscription->save();
        NotificationService::notifyInscription($inscription);
        return redirect()->back()->with('success', 'Vous êtes inscrit à la formation.');
    }

    public function quitter($formationId)
    {
        $inscription = Inscription::where('user_id', Auth::id())
            ->where('formation_id', $formationId)
            ->first();

        if ($inscription) {
            $inscription->delete();
        }
        return redirect()->back()->with('success', 'Vous avez quitté la formation.');
    }
}
