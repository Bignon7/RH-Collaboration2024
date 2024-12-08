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

    public function scopeSearch($query, $term)
    {
        $term = "%{$term}%";

        return $query->whereHas('formation', function ($query) use ($term) {
            $query->where('intitule_formation', 'like', $term)
                ->orWhere('description_formation', 'like', $term)
                ->orWhere('date_debut_formation', 'like', $term);
        })
            ->where(function ($query) use ($term) {
                $query->where('date_inscription', 'like', $term)
                    ->orWhere('created_at', 'like', $term);
            });
    }
}
