<?php

namespace App\Models;

use App\Enums\SettingKeyEnum;
use App\Enums\SettingTypeEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'key' => SettingKeyEnum::class,
        'type' => SettingTypeEnum::class,
        'value' => 'array',
        'status' => StatusEnum::class,
    ];

    protected static function boot(): void
    {
        parent::boot();

        // Handle file cleanup on update
        static::updated(function ($model) {
            $old = $model->getOriginal('value');
            $new = $model->value;

            $oldPaths = collect($model->extractPaths($old));
            $newPaths = collect($model->extractPaths($new));

            $removed = $oldPaths->diff($newPaths)->filter();

            foreach ($removed as $path) {
                if ($path && Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }

            // refresh cache
            self::refreshCache();
        });

        // Bust cache when a new setting is created
        static::created(function ($model) {
            self::refreshCache();
        });

        // Bust cache when a setting is deleted
        static::deleted(function ($model) {
            self::refreshCache();
        });
    }

    /**
     * Clear and refresh settings cache.
     */
    protected static function refreshCache(): void
    {
        Cache::forget('settings.all');
        Cache::rememberForever('settings.all', fn () => self::all());
    }

    private function extractPaths($val): array
    {
        if (is_string($val)) {
            return [$val];
        }

        if (is_array($val)) {
            if (array_is_list($val)) {
                return $val;
            }

            if (isset($val['images'])) {
                return is_array($val['images']) ? $val['images'] : [];
            }

            if (isset($val['path'])) {
                return [$val['path']];
            }
        }

        return [];
    }
}
