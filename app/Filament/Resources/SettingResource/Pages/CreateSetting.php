<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use App\Models\Setting;
use Filament\Resources\Pages\CreateRecord;

class CreateSetting extends CreateRecord
{
    protected static string $resource = SettingResource::class;

    public static function afterSave($record): void
    {
        cache()->forget('settings.all');
        cache()->rememberForever('settings.all', fn () => Setting::all());
    }
}
