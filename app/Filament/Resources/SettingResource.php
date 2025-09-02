<?php

namespace App\Filament\Resources;

use App\Enums\SettingKeyEnum;
use App\Enums\SettingTypeEnum;
use App\Enums\StatusEnum;
use App\Filament\Resources\SettingResource\Pages\CreateSetting;
use App\Filament\Resources\SettingResource\Pages\EditSetting;
use App\Filament\Resources\SettingResource\Pages\ListSettings;
use App\Filament\Resources\SettingResource\Pages\ViewSetting;
use App\Filament\Table\Columns\StatusColumn;
use App\Models\Setting;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-8-tooth';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
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
                    ->live()
                    ->afterStateUpdated(function ($state, $set, $get) {}),

                TextInput::make('url')
                    ->nullable(),

                RichEditor::make('value.content')
                    ->label('Content')
                    ->visible(fn (Get $get) => $get('type') === SettingTypeEnum::Text)
                    ->required(fn (Get $get) => $get('type') === SettingTypeEnum::Text)
                    ->columnSpanFull(),

                FileUpload::make('value.images')
                    ->label('Images')
                    ->image()
                    ->multiple()
                    ->disk('public')
                    ->directory(fn (Get $get) => 'settings/'.$get('key'))
                    ->visible(fn (Get $get) => $get('type') === SettingTypeEnum::Image)
                    ->required(fn (Get $get) => $get('type') === SettingTypeEnum::Image)
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
            ->paginated([30, 'all'])
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('key')
                    ->searchable(),
                TextColumn::make('type'),
                StatusColumn::make(),
            ])
            ->filters([
                SelectFilter::make('key')
                    ->label('Name')
                    ->options(SettingKeyEnum::options()),
                Filter::make('search')
                    ->schema([
                        TextInput::make('q')
                            ->label('Search')
                            ->placeholder('Search...'),
                    ])
                    ->indicateUsing(fn (array $data) => ! empty($data['q']) ? ["Search: {$data['q']}"] : [])
                    ->query(function (Builder $query, array $data) {
                        $q = $data['q'] ?? null;
                        if (! $q) {
                            return;
                        }

                        $query->where(function (Builder $sub) use ($q) {
                            $sub->where('name', 'like', "%{$q}%")
                                ->orWhere('key', 'like', "%{$q}%");
                        });
                    }),
            ], layout: FiltersLayout::AboveContent)
            ->deferFilters(false)
            ->searchable(false)
            ->actions([
                ViewAction::make(),
                EditAction::make()
                    ->keyBindings(['command+s', 'ctrl+s']),
                DeleteAction::make(),
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
            'index' => ListSettings::route('/'),
            'create' => CreateSetting::route('/create'),
            'edit' => EditSetting::route('/{record}/edit'),
            'view' => ViewSetting::route('/{record}'),
        ];
    }
}
