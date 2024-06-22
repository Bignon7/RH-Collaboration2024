<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Demandeconge extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type_conge',
        'date_debut_conge',
        'duree_conge',
        'date_retour_conge',
        'motif_conge',
        'statut_conge',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function dureeEnJours()
    {
        $duree = $this->duree_conge;
        $jours = 0;

        if (preg_match_all('/(\d+)\s*(mois|semaine|jours?)/i', $duree, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $quantite = (int)$match[1];
                $unite = strtolower($match[2]);

                switch ($unite) {
                    case 'mois':
                        $jours += $quantite * 30;
                        break;
                    case 'semaine':
                    case 'semaines':
                        $jours += $quantite * 7;
                        break;
                    case 'jour':
                    case 'jours':
                        $jours += $quantite;
                        break;
                }
            }
        }

        return $jours;
    }

    public function isAcceptable()
    {
        $dureeEnJours = $this->dureeEnJours();
        $seuilConges = 20;
        $totalCongesUtilises = $this->user->total_conges ?? 0;

        return ($totalCongesUtilises + $dureeEnJours) <= $seuilConges;
    }
    public function getRandomColor()
    {
        $colors = [
            '#FF5733', '#33FF57', '#3357FF', '#FF33A1', '#33FFA5',
            '#FFA533', '#A533FF', '#33A5FF', '#A5FF33', '#FF5733',
            '#FFD700', '#FF6347', '#FF00FF', '#1E90FF', '#87CEEB',
            '#32CD32', '#FF8C00', '#8A2BE2', '#DC143C', '#4B0082'
        ];

        return $colors[array_rand($colors)];
    }
}
