<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormationFormRequest;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.indexs.formation_index', [
            'formations' => Formation::orderBy('created_at', 'desc')->paginate(8),
        ]);
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
        Formation::create($request->validated());
        return to_route('get_dash')->with('success', 'Une nouvelle formation a bien été ajoutée');
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
        return view('pages.indexs.formation_index', ['formation' => $formation]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FormationFormRequest $request, Formation $formation)
    {
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
}
