<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OtpToken extends Model
{
    protected $fillable = [
        'user_id',
        'token',
        'expira_en',
        'usado',
    ];

    protected function casts(): array
    {
        return [
            'expira_en' => 'datetime',
            'usado' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isValid(): bool
    {
        return !$this->usado && $this->expira_en->isFuture();
    }
} 