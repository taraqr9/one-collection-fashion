<?php

namespace App\Filament\Resources;

use App\Enums\StatusEnum;
use App\Filament\Resources\AdminResource\Pages\CreateAdmin;
use App\Filament\Resources\AdminResource\Pages\EditAdmin;
use App\Filament\Resources\AdminResource\Pages\ListAdmin;
use App\Filament\Resources\AdminResource\Pages\ViewAdmin;
use App\Filament\Table\Columns\StatusColumn;
use App\Models\Admin;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use STS\FilamentImpersonate\Actions\Impersonate;

class AdminResource extends Resource
{
    protected static ?string $model = Admin::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    TextInput::make('name')
                        ->required(),
                    TextInput::make('email')
                        ->email()->unique(ignoreRecord: true)->required(),
                    TextInput::make('phone')
                        ->tel(),
                    Select::make('roles')
                        ->relationship('roles', 'name')
                        ->multiple()
                        ->preload()
                        ->searchable()
                        ->required(),
                ])
                    ->columns(2)
                    ->columnSpanFull(),
                Section::make([
                    TextInput::make('password')
                        ->required(fn (?Admin $record) => ! $record?->exists)
                        ->dehydrated(fn ($state) => ! empty($state))
                        ->password()->confirmed(),
                    TextInput::make('password_confirmation')
                        ->label('Confirm Password')
                        ->dehydrated(false)
                        ->same('password')
                        ->required(fn (?Admin $record) => ! $record?->exists)->password(),
                ])
                    ->columns(2)
                    ->columnSpanFull(),
                Radio::make('status')
                    ->options(StatusEnum::class)
                    ->default(StatusEnum::Active)
                    ->columns(3)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('roles.name'),
                StatusColumn::make()
                    ->visible(fn () => auth()->user()?->hasRole('super-admin')),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Impersonate::make()
                    ->color('info')
                    ->redirectTo('/admin'),
                ViewAction::make(),
                EditAction::make()
                    ->keyBindings(['command+s', 'ctrl+s']),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => ListAdmin::route('/'),
            'create' => CreateAdmin::route('/create'),
            'edit' => EditAdmin::route('/{record}/edit'),
            'view' => ViewAdmin::route('/{record}'),
        ];
    }
}
