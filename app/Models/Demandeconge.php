<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Demandeconge extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_conge',
        'date_debut_conge',
        'duree_conge',
        'motif_conge',
        'statut_conge',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
