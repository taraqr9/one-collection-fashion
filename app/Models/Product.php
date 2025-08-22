<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

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

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'sub_category_id');
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function thumbnail(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable')->where('type', 'thumbnail');
    }

    public function productImages(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable')->where('type', 'product_image');
    }

    public function discountPercentage(): int
    {
        if ($this->offer_price > 0 && $this->offer_price < $this->price) {
            return round((($this->price - $this->offer_price) / $this->price) * 100);
        }

        return 0;
    }
}
