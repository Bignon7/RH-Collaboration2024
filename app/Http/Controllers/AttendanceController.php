<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\usEer;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;

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
            $clockOut = Carbon::now();
            $clockIn = Carbon::parse($attendance->clock_in);

            $hoursWorked = $clockIn->diffInHours($clockOut);

            // Mettre à jour les champs nécessaires
            $attendance->clock_out = $clockOut;
            $attendance->clock_out_date = $clockOut->toDateString();
            $attendance->clock_out_time = $clockOut->toTimeString();
            $attendance->hours_worked = $hoursWorked;
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
        })->paginate(6);
        $usersClockedIn = User::whereHas('attendances', function ($query) use ($today) {
            $query->whereDate('clock_in', $today)->whereNull('clock_out');
        })->get();
        return view('pages.admin.pointage', compact('users', 'usersClockedIn'));
    }
    public function search()
    {
        $entre = request()->input('search');

        $users = User::where('nom', 'like', "%$entre%")
            ->orwhere('prenom', 'like', "%$entre%")
            ->orWhere('service', 'like', "%$entre%")
            ->orWhere('role', 'like', "%$entre%")
            ->paginate(6);

        return view('pages.admin.pointage', compact('users'));
    }

    public function getAttendances(Request $request)
    {
        $date = $request->input('inputDate');

        // Récupérer les utilisateurs ayant un clock_in non null pour la date donnée
        $attendances = Attendance::where('clock_in_date', $date)
            ->whereNotNull('clock_in')
            ->with('user')
            ->paginate(8);

        return view('pages.admin.presence', compact('attendances', 'date'));
    }

    public function autoFillClockOut()
    {
        $today = Carbon::now()->toDateString();
        $now = Carbon::now();
        $clockOutTime = Carbon::create($today)->setTime(19, 0, 0);

        if ($now->greaterThanOrEqualTo($clockOutTime)) {
            Attendance::whereDate('clock_in_date', $today)
                ->whereNull('clock_out')
                ->update([
                    'clock_out' => $clockOutTime,
                    'clock_out_date' => $today,
                    'clock_out_time' => $clockOutTime->toTimeString(),
                ]);
            session(['session_closed_date' => $today]);
            session()->flash('status', "Les heures de sortie des employés restants ont été autocomplétées");
        }
        //return redirect()->route('attendance.clockin');
        return redirect()->back()->with('status', "Les heures de sortie des employés restants ont été autocomplétées");
    }


    public function getPageOfWorkedHours($id)
    {
        return view('pages.update.worked_hours', compact('id'));
    }


    public function showHoursWorkedTable(Request $request, $id)
    {
        $user_id = $id;
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $query = Attendance::where('user_id', $user_id);

        if ($start_date && $end_date) {
            $query->whereBetween('clock_in_date', [$start_date, $end_date]);
        }

        $attendances = $query->get()->map(function ($attendance) {
            $clockIn = Carbon::parse($attendance->clock_in);
            $clockOut = $attendance->clock_out ? Carbon::parse($attendance->clock_out) : null;
            $hoursWorked = $clockOut ? $clockIn->diffInHours($clockOut) : 0;

            return [
                'date' => $attendance->clock_in_date,
                'clock_in' => $attendance->clock_in_time,
                'clock_out' => $attendance->clock_out_time,
                'hours_worked' => $hoursWorked,
            ];
        });

        $totalHoursWorked = $attendances->sum('hours_worked');

        return view('pages.update.worked_hours', [
            'attendances' => $attendances,
            'totalHoursWorked' => $totalHoursWorked,
            'id' => $id
        ]);
    }


    public function hoursWorkedForChart(Request $request, $id)
    {
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        // Remplacer par votre logique pour récupérer les heures travaillées
        $hoursWorked = Attendance::where('user_id', $id)->whereBetween('clock_in_date', [$startDate, $endDate])
            ->selectRaw('DATE(clock_in_date) as date, SUM(TIMESTAMPDIFF(HOUR, clock_in, clock_out)) as hours_worked')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json($hoursWorked);
    }

    public function getWorkedHours(Request $request)
    {
        $user_id = Auth::id(); // Assuming you're using Laravel's authentication system
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $attendances = Attendance::where('user_id', $user_id)
            ->whereBetween('clock_in', [$startDate, $endDate])
            ->get();

        $totalHoursWorked = 0;

        //dd($totalHoursWorked);
        foreach ($attendances as $attendance) {
            if ($attendance->clock_out) {
                $clockIn = Carbon::parse($attendance->clock_in);
                $clockOut = Carbon::parse($attendance->clock_out);
                $totalHoursWorked += $clockIn->diffInHours($clockOut);
            }
        }
        return response()->json($totalHoursWorked);
    }
}
