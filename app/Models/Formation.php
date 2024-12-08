<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = [
        'intitule_formation',
        'description_formation',
        'date_debut_formation',
        'duree_formation',
        'date_fin_formation',
        'lieu_formation',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'inscriptions', 'formation_id', 'user_id')
            ->withPivot('date_inscription')
            ->withTimestamps();
    }
}
