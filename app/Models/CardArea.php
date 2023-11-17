<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CardArea extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function division(): BelongsTo
    {
        return $this->belongsTo(CardDivision::class, 'card_division_id');
    }

    public function counters(): HasMany
    {
        return $this->hasMany(CardCounter::class, 'card_area_id');
    }
}
