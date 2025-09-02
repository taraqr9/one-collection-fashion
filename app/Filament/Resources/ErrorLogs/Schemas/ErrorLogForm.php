<?php

namespace App\Filament\Resources\ErrorLogs\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ErrorLogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('message')
                    ->required(),
                Textarea::make('trace')
                    ->columnSpanFull(),
                TextInput::make('file'),
                TextInput::make('line')
                    ->numeric(),
                TextInput::make('user_id')
                    ->numeric(),
            ]);
    }
}
