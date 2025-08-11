<?php

namespace App\Filament\Resources;

use App\Enums\SettingKeyEnum;
use App\Enums\SettingTypeEnum;
use App\Enums\StatusEnum;
use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
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
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),

                Select::make('key')
                    ->required()
                    ->options(SettingKeyEnum::options()),

                Select::make('type')
                    ->required()
                    ->options(SettingTypeEnum::class)
                    ->live(),

                TextInput::make('url')
                    ->nullable(),

                RichEditor::make('value')
                    ->label('Content')
                    ->hidden(fn(Get $get) => SettingTypeEnum::Text->value !== $get('type'))
                    ->required(fn(Get $get) => SettingTypeEnum::Text->value !== $get('type'))
                    ->columnSpanFull(),

                FileUpload::make('value')
                    ->image()
                    ->multiple()
                    ->disk('public')
                    ->directory(fn (Get $get) => 'settings/'.$get('key'))
                    ->hidden(fn(Get $get) => SettingTypeEnum::Image->value !== $get('type'))
                    ->required(fn(Get $get) => SettingTypeEnum::Image->value !== $get('type'))
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
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('type'),
                StatusColumn::make()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
