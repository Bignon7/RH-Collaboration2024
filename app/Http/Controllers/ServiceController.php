<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceFormRequest;
use App\Models\Service;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Service::orderBy('created_at', 'desc');

        // Récupérer les paramètres de la requête
        if ($request->has('search')) {
            $search = $request->input('search');

            // Ajouter les conditions de filtre
            $query->where(function ($query) use ($search) {
                $query->where('nom_service', 'LIKE', "%{$search}%")
                    ->orWhere('chef_service', 'LIKE', "%{$search}%")
                    ->orWhere('effectif_service', 'LIKE', "%{$search}%")
                    ->orWhere('detail_service', 'LIKE', "%{$search}%");
            });
        }

        // Exécuter la requête et obtenir les résultats
        $services = $query->paginate(6);

        return view('pages.indexs.service_index', compact('services'));
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
        $service = Service::create($request->validated());
        NotificationService::notifyService($service);
        return to_route('index_created_service')->with('success', 'Le nouveau service a bien été enregistré');
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
    public function update(ServiceFormRequest $request, $id)
    {
        $service = Service::findOrFail($id);
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
