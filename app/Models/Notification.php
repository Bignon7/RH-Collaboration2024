<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type_notification',
        'title_notification',
        'contenu_notification',
        'read_at',
        'data',

    ];
    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function markAsRead()
    {
        $this->update(['read_at' => now()]);
    }

    public function markAsUnread()
    {
        $this->update(['read_at' => null]);
    }

    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    public function getFormattedDateAttribute()
    {
        $createdAt = Carbon::parse($this->created_at);
        $now = Carbon::now();

        Carbon::setLocale('fr');

        if ($createdAt->isSameYear($now)) {
            return $createdAt->diffInDays() > 1
                ? $createdAt->translatedFormat('d F')
                : $createdAt->diffForHumans();
        } else {
            return $createdAt->translatedFormat('d F Y');
        }
    }
}
