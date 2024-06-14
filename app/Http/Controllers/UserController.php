<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Notification;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.indexs.user_index', [
            'users' => User::where('role', 'Employé')->orderBy('created_at', 'desc')->paginate(2),
        ]);
    }

    public function admin_attendance_index()
    {
        return view('pages.indexs.attendance_user_index', [
            'users' => User::orderBy('nom', 'asc')->paginate(2),
        ]);
    }

    public function admin_index_manager()
    {
        return view('pages.indexs.user_index', [
            'users' => User::where('role', 'Gestionnaire')->orderBy('created_at', 'desc')->paginate(2),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('pages.show_user', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('pages.user_profile_update', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        var_dump($request);
        //$data = $request->validated();
        $id = $user->id;
        Storage::disk('public')->delete($user->photo_file);
        Storage::disk('public')->delete($user->comp_file);

        if ($user->lien_contrat) {
            Storage::disk('public')->delete($user->lien_contrat);
        }
        $data['lien_contrat'] = $request->file('lien_contrat')->store('user_contrat', 'public');

        $user->update($data);
        if ($id != Auth::user()->id) {
            NotificationService::notifyUserProfileUpdate($id);
        } else {
            NotificationService::notifySelfProfileUpdate($user);
        }

        return back()->with('success', 'Les informations ont bien été mis à jour !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    { //Envoyer un mail
        //var_dump($user);
        //var_dump(Storage::url('photo_files/236ca612-d17b-442b-8175-2a4498daf263_p...'));
        Storage::disk('public')->delete($user->photo_file);
        Storage::disk('public')->delete($user->comp_file);
        if ($user->lien_contrat) {
            Storage::disk('public')->delete($user->lien_contrat);
        }
        $user->delete();
        return back()->with('success', 'L\'utilisateur a bien été supprimé!');
    }


    public function show_pass_form()
    {
        return view('pages.password_change');
    }

    public function notification_index()
    {
        return view('pages.indexs.notification_index', [
            'notifications' => Notification::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(2),
        ]);
    }
}
