<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\usEer;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class AttendanceController extends Controller
{
    public function clockIn(Request $request)
    {
        $attendance = new Attendance();
        $attendance->user_id = $request->input('user_id');
        $attendance->clock_in = Carbon::now();
        $attendance->clock_in_date = Carbon::now()->toDateString();
        $attendance->clock_in_time = Carbon::now()->toTimeString();
        $attendance->save();
        // Envoyer une notification aux gestionnaires RH ( exemple : Jean a notifié sa présence ;user->prenom)
        return redirect()->back()->with('success', 'Votre présence a bien été marquée!');
    }

    public function clockOut(Request $request)
    {
        $user_id = $request->input('user_id');
        // Trouver le dernier enregistrement d'assiduité de l'utilisateur qui n'a pas encore d'heure de départ
        $attendance = Attendance::where('user_id', $user_id)
            ->whereNull('clock_out')
            ->orderBy('clock_in', 'desc')
            ->first();
        if ($attendance) {
            // Mettre à jour l'heure de départ
            $attendance->clock_out = Carbon::now();
            $attendance->clock_out_date = Carbon::now()->toDateString();
            $attendance->clock_out_time = Carbon::now()->toTimeString();
            $attendance->save();

            return redirect()->back()->with('success', 'Votre départ a bien été signalé!');
        } else {
            return redirect()->back()->with('error', "Vous n'avez pas enregistré votre présence aujourd'hui");
        }
    }

    public function pointage()
    {
        $today = Carbon::now()->toDateString();
        $users = User::orderBy('nom', 'asc')->whereDoesntHave('attendances', function ($query) use ($today) {
            $query->whereDate('clock_in', $today);
        })->paginate(10);
        return view('pages.admin.pointage', compact('users'));
    }
    public function search()
    {
        $entre = request()->input('search');

        $users = User::where('nom', 'like', "%$entre%")
            ->orwhere('prenom', 'like', "%$entre%")
            ->orWhere('service', 'like', "%$entre%")
            ->orWhere('role', 'like', "%$entre%")
            ->paginate(10);

        return view('pages.admin.pointage', compact('users'));
    }

    public function getAttendances(Request $request)
    {
        $date = $request->input('inputDate');

        // Récupérer les utilisateurs ayant un clock_in non null pour la date donnée
        $attendances = Attendance::where('clock_in_date', $date)
            ->whereNotNull('clock_in')
            ->with('user')
            ->paginate(10);

        return view('pages.admin.presence', compact('attendances', 'date'));
    }
}
