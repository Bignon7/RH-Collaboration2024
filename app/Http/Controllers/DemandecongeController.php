<?php

namespace App\Http\Controllers;

use App\Http\Requests\DemandecongeFormRequest;
use App\Models\Demandeconge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DemandecongeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.indexs.demandeconge_index', [
            'demandeconges' => Demandeconge::orderBy('created_at', 'desc')->paginate(6),
        ]);
    }

    public function indexById($id)
    {
        return view('pages.indexs.demandeconge_index', [
            'demandeconges' => Demandeconge::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(6),
        ]);
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
        Demandeconge::create($validatedData);
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
    public function update(Request $request, Demandeconge $demandeconge)
    {
        $demandeconge->update($request->validated());
        return to_route('index_created_demandeconge')->with('success', 'Votre demande de congés a bien été actualisée!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Demandeconge $demandeconge)
    {
        $demandeconge->delete();
        return to_route('index_created_demandeconge')->with('success', 'Votre demande de congés a bien été annulée!');
    }
}
