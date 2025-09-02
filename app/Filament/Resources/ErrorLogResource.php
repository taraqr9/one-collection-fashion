<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ErrorLogs\Pages\ListErrorLogs;
use App\Filament\Resources\ErrorLogs\Schemas\ErrorLogForm;
use App\Filament\Resources\ErrorLogs\Schemas\ErrorLogInfolist;
use App\Filament\Resources\ErrorLogs\Tables\ErrorLogsTable;
use App\Models\ErrorLog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ErrorLogResource extends Resource
{
    protected static ?string $model = ErrorLog::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedExclamationCircle;

    protected static ?string $recordTitleAttribute = 'Error Logs';

    public static function form(Schema $schema): Schema
    {
        return ErrorLogForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ErrorLogInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ErrorLogsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListErrorLogs::route('/'),
        ];
    }
}
