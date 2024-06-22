<?php

namespace App\Http\Controllers;

use App\Http\Requests\DemandecongeFormRequest;
use App\Models\Demandeconge;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DemandecongeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Demandeconge::orderBy('created_at', 'desc');

        if ($request->has('search')) {
            $search = $request->input('search');

            $query->where(function ($query) use ($search) {
                $query->where('user_id', 'LIKE', "%{$search}%")
                    ->orWhere('type_conge', 'LIKE', "%{$search}%")
                    ->orWhere('date_debut_conge', 'LIKE', "%{$search}%")
                    ->orWhere('duree_conge', 'LIKE', "%{$search}%")
                    ->orWhere('date_retour_conge', 'LIKE', "%{$search}%")
                    ->orWhere('motif_conge', 'LIKE', "%{$search}%")
                    ->orWhere('statut_conge', 'LIKE', "%{$search}%");
            });
            $query->orWhereHas('user', function ($q) use ($search) {
                $q->where('matricule', 'LIKE', "%{$search}%")
                    ->orWhere('nom', 'LIKE', "%{$search}%")
                    ->orWhere('prenom', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // Exécuter la requête et obtenir les résultats
        //$demandeconges = $query->get();
        $demandeconges = $query->paginate(6);

        return view('pages.indexs.demandeconge_index', compact('demandeconges'));
    }

    // public function indexById($id)
    // {
    //     return view('pages.indexs.demandeconge_index', [
    //         'demandeconges' => Demandeconge::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(6),
    //     ]);
    // }


    public function indexById(Request $request, $id)
    {
        $search = $request->input('search');
        $query = Demandeconge::where('user_id', $id);

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('type_conge', 'LIKE', "%{$search}%")
                    ->orWhere('date_debut_conge', 'LIKE', "%{$search}%")
                    ->orWhere('duree_conge', 'LIKE', "%{$search}%")
                    ->orWhere('date_retour_conge', 'LIKE', "%{$search}%")
                    ->orWhere('motif_conge', 'LIKE', "%{$search}%")
                    ->orWhere('statut_conge', 'LIKE', "%{$search}%");
            });
            $query->orWhereHas('user', function ($q) use ($search) {
                $q->where('matricule', 'LIKE', "%{$search}%")
                    ->orWhere('nom', 'LIKE', "%{$search}%")
                    ->orWhere('prenom', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        $demandeconges = $query->orderBy('created_at', 'desc')->paginate(6);

        return view('pages.indexs.demandeconge_index', compact('demandeconges'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.forms.demandeconge_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DemandecongeFormRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::id();
        $demandeconge = Demandeconge::create($validatedData);
        NotificationService::notifyDemandeConge($demandeconge);
        return to_route('get_dash')->with('success', 'Votre demande a bien été envoyée!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Demandeconge $demandeconge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Demandeconge $demandeconge)
    {
        return view('pages.forms.demandeconge_form', ['demandeconge' => $demandeconge]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DemandecongeFormRequest $request, $id)
    {
        $demandeconge = Demandeconge::findOrFail($id);
        $demandeconge->update($request->validated());
        $id = $demandeconge->user_id;

        return redirect()->route('index_created_demandeconge_id', ['id' => $id])
            ->with('success', 'Votre demande de congés a bien été actualisée!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Demandeconge $demandeconge)
    {
        $demandeconge->delete();
        return to_route('index_created_demandeconge_id', ['id' => Auth::user()->id])->with('success', 'Votre demande de congés a bien été annulée!');
    }


    public function repondre(Request $request, DemandeConge $demandeConge)
    {
        if ((Auth::user()->role != 'Gestionnaire') || (Auth::user()->role != 'Admin')) {
            return back()->with('error', 'Vous n\'avez pas les permissions nécessaires pour répondre à cette demande.');
        }

        $action = $request->input('action');
        $justification = $request->input('justification');
        $user = $demandeConge->user;
        $dureeEnJours = $demandeConge->dureeEnJours();

        if ($action === 'Approuvée') {
            $demandeConge->statut_conge = 'Approuvée';
            $demandeConge->save();

            $user->total_conges = ($user->total_conges ?? 0) + $dureeEnJours;
            $user->save();
        } else if ($action === 'Rejetée') {
            $demandeConge->statut_conge = 'Rejetée';
            $demandeConge->save();
        }

        NotificationService::notifyDemandeCongeResponse($demandeConge->user_id, $demandeConge, $action . ' : ' . $justification);

        return back()->with('success', 'La réponse a été envoyée avec succès.');
    }
}
