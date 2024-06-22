<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormationFormRequest;
use App\Models\Formation;
use App\Models\Inscription;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Formation::orderBy('created_at', 'desc');

        if ($request->has('search')) {
            $search = $request->input('search');

            $query->where(function ($query) use ($search) {
                $query->where('intitule_formation', 'LIKE', "%{$search}%")
                    ->orWhere('description_formation', 'LIKE', "%{$search}%")
                    ->orWhere('date_debut_formation', 'LIKE', "%{$search}%")
                    ->orWhere('duree_formation', 'LIKE', "%{$search}%")
                    ->orWhere('date_fin_formation', 'LIKE', "%{$search}%")
                    ->orWhere('lieu_formation', 'LIKE', "%{$search}%");
            });
        }

        $formations = $query->paginate(6);
        foreach ($formations as $formation) {
            $formation->formationCommencee = now()->gte($formation->date_debut_formation);
        }
        return view('pages.indexs.formation_index', compact('formations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.forms.formation_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormationFormRequest $request)
    {
        $formation = Formation::create($request->validated());
        NotificationService::notifyNewFormation(User::all()->pluck('id'), $formation);
        return to_route('index_created_formation')->with('success', 'Une nouvelle formation a bien été ajoutée');
    }

    /**
     * Display the specified resource.
     */
    public function show(Formation $formation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formation $formation)
    {
        return view('pages.forms.formation_form', ['formation' => $formation]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FormationFormRequest $request, $id)
    {
        $formation = Formation::findOrFail($id);
        $formation->update($request->validated());
        return to_route('index_created_formation')->with('success', 'La formation a bien été mise à jour!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formation $formation)
    {
        $formation->delete();
        return to_route('index_created_formation')->with('success', 'La formation a bien été annulée');
    }
    public function showInscrits($formationId, Request $request)
    {
        $formation = Formation::findOrFail($formationId);
        $query = $formation->users()->withPivot('date_inscription');

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                    ->orWhere('prenom', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('matricule', 'like', "%{$search}%")
                    ->orWhere('inscriptions.date_inscription', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(10);

        return view('pages.indexs.inscrits_formation', compact('formation', 'users'));
    }
}
