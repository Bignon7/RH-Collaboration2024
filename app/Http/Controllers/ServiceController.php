<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceFormRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.indexs.service_index', [
            'services' => Service::orderBy('created_at', 'desc')->paginate(6),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.forms.service_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceFormRequest $request)
    {
        Service::create($request->validated());
        return to_route('get_dash')->with('success', 'Le nouveau service a bien été enregistré');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('pages.forms.service_form', ['service' => $service]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceFormRequest $request, Service $service)
    {
        $service->update($request->validated());
        return to_route('index_created_service')->with('success', 'Le service a bien été mis à jour !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return to_route('index_created_service')->with('success', 'Le service a bien été supprimé!');
    }
}
