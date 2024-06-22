<?php

namespace App\Models;

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
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}