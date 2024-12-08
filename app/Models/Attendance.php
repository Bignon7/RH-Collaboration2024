<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'clock_in',
        'clock_out',
        'clock_in_date',
        'clock_in_time',
        'clock_out_date',
        'clock_out_time',
        'hours_worked'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Calculer les heures travaillées avant de sauvegarder l'enregistrement
    public static function boot()
    {
        parent::boot();

        static::saving(function ($attendance) {
            if ($attendance->clock_in && $attendance->clock_out) {
                $clockIn = Carbon::parse($attendance->clock_in);
                $clockOut = Carbon::parse($attendance->clock_out);
                $attendance->hours_worked = $clockIn->diffInHours($clockOut);
            }
        });
    }
}
