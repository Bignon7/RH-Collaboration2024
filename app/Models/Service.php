<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_service',
        'chef_service',
        'effectif_service',
        'detail_service',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public static function getAllServiceNames()
    {
        return self::pluck('nom_service');
    }
}
