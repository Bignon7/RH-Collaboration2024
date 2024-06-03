<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'formation_id',
        'date_inscription',
    ];

    /**
     * Get the employee that owns the inscription.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the formation that owns the inscription.
     */
    public function formation()
    {
        return $this->belongsTo(Formation::class, 'formation_id');
    }
}
