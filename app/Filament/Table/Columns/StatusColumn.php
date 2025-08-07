<?php

namespace App\Filament\Table\Columns;

use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Database\Eloquent\Model;

class StatusColumn extends IconColumn
{
    public static function make(?string $name = 'status'): static
    {
        return parent::make($name);
    }

    protected function setUp(): void
    {
        $this
            ->color(function (Model $record) {
                return $record->status->value === 'active'
                    ? 'success'
                    : 'danger';
            })
            ->icon(function (Model $record) {
                return $record->status->value === 'active'
                    ? 'heroicon-o-check-circle'
                    : 'heroicon-o-x-circle';
            })
            ->action(function (Model $record) {
                $record->update([
                    'status' => $record->status->value === 'active'
                        ? 'inactive'
                        : 'active',
                ]) && Notification::make('user-status-updated')
                    ->title(__('Status updated'))
                    ->success()->send();
            })
            ->alignCenter();
    }
}
