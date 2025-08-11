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

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            if ($model->isDirty('value') && ($model->getOriginal('value') !== null)) {
//                foreach ($model->getOriginal('value') as $ph) Storage::disk('public')->delete($ph);
//                Storage::disk('public')->delete($model->getOriginal('value'));
            }
        });
    }
}
