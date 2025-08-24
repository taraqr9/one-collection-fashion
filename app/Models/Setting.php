<?php

namespace App\Models;

use App\Enums\SettingKeyEnum;
use App\Enums\SettingTypeEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        });
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
