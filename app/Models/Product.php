<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'status' => StatusEnum::class,
    ];

    public function getTotalStockAttribute(): int
    {
        return $this->stocks()->sum('stock');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function thumbnail(): HasOne
    {
        return $this->hasOne(Image::class)->where('type', 'thumbnail');
    }

    public function productImages(): HasMany
    {
        return $this->hasMany(Image::class)->where('type', 'gallery');
    }
}
