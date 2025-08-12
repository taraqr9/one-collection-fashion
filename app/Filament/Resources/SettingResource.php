<?php

namespace App\Filament\Resources;

use App\Enums\SettingKeyEnum;
use App\Enums\SettingTypeEnum;
use App\Enums\StatusEnum;
use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Table\Columns\StatusColumn;
use App\Models\Setting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-8-tooth';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('key')
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->options(SettingKeyEnum::options())
                    ->live()
                    ->afterStateUpdated(function ($state, $set, $get) {
                        $label = ucwords(str_replace('_', ' ', $state));
                        $set('name', $label);
                    }),

                TextInput::make('name')
                    ->required(),

                Select::make('type')
                    ->required()
                    ->options(SettingTypeEnum::class)
                    ->live(),

                TextInput::make('url')
                    ->nullable(),

                RichEditor::make('value.content')
                    ->label('Content')
                    ->visible(fn (Get $get) => SettingTypeEnum::Text->value === $get('type'))
                    ->required(fn (Get $get) => SettingTypeEnum::Text->value === $get('type'))
                    ->columnSpanFull(),

                FileUpload::make('value.images')
                    ->label('Images')
                    ->image()
                    ->multiple()
                    ->disk('public')
                    ->directory(fn (Get $get) => 'settings/'.$get('key'))
                    ->visible(fn (Get $get) => SettingTypeEnum::Image->value === $get('type'))
                    ->required(fn (Get $get) => SettingTypeEnum::Image->value === $get('type'))
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
        //        Lang::addLines([
        //            'table.filters.heading' => 'Test',
        //        ], app()->getLocale(), 'filament-tables');

        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('type'),
                StatusColumn::make(),
            ])
            ->filters([
                SelectFilter::make('key')
                    ->label('Name')
                    ->options(SettingKeyEnum::options()),
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                EditAction::make()
                    ->keyBindings(['command+s', 'ctrl+s']),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
