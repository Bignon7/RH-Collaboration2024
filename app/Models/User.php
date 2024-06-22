<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use InvalidArgumentException;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'email',
        'hire_date',
        'poste',
        'service',
        'phone',
        'adresse',
        'role',
        'comp_file',
        'photo_file',
        'password',
        'salaire',
        'duree_contrat',
        'lien_contrat',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function formations()
    {
        return $this->belongsToMany(Formation::class, 'inscriptions', 'user_id', 'formation_id')
            ->withPivot('date_inscription')
            ->withTimestamps();
    }
    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function fichepaies(): HasMany
    {
        return $this->hasMany(Fichepaie::class);
    }

    public function demandeconges(): HasMany
    {
        return $this->hasMany(Demandeconge::class);
    }


    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public static function generateComplexPassword($length = 12)
    {
        if ($length < 8) {
            throw new InvalidArgumentException('Password length must be at least 8 characters.');
        }

        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';
        $special = '!@#$%^&*-_=+|:.<>?';

        $randomPassword = $lowercase[random_int(0, strlen($lowercase) - 1)];
        $randomPassword .= $uppercase[random_int(0, strlen($uppercase) - 1)];
        $randomPassword .= $numbers[random_int(0, strlen($numbers) - 1)];
        $randomPassword .= $special[random_int(0, strlen($special) - 1)];

        $allCharacters = $lowercase . $uppercase . $numbers . $special;

        for ($i = 4; $i < $length; $i++) {
            $randomPassword .= $allCharacters[random_int(0, strlen($allCharacters) - 1)];
        }

        return str_shuffle($randomPassword);
    }
}
