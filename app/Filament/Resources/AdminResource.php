<?php

namespace App\Filament\Resources;

use App\Enums\StatusEnum;
use App\Filament\Resources\AdminResource\Pages;
use App\Filament\Table\Columns\StatusColumn;
use App\Models\Admin;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use STS\FilamentImpersonate\Tables\Actions\Impersonate;

class AdminResource extends Resource
{
    protected static ?string $model = Admin::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
                ])->columns(2),
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
                ])->columns(2),
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
            ->actions([
                Impersonate::make()
                    ->color('info')
                    ->redirectTo('/admin'),
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
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
            'index' => Pages\ListAdmin::route('/'),
            'create' => Pages\CreateAdmin::route('/create'),
            'edit' => Pages\EditAdmin::route('/{record}/edit'),
            'view' => Pages\ViewAdmin::route('/{record}'),
        ];
    }
}
