<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use App\Models\Setting;
use Filament\Actions;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditSetting extends EditRecord
{
    protected static string $resource = SettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    //    protected function getActions(): array
    //    {
    //        return [
    //            Actions\DeleteAction::make()
    //                ->after(function (Setting $record) {
    //                    if ($record->value) {
    //                        foreach ($record->value as $ph) Storage::disk('public')->delete($ph);
    //                    }
    //                }),
    //        ];
    //    }

}
