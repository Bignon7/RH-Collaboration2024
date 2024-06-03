<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_notification',
        'contenu_notification',
        'emission_notification',

    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
