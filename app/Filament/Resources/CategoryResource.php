<?php

namespace App\Filament\Resources;

use App\Enums\StatusEnum;
use App\Filament\Resources\CategoryResource\Pages\ListCategories;
use App\Filament\Table\Columns\StatusColumn;
use App\Models\Category;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-list-bullet';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Category Name')
                    ->required()
                    ->maxLength(255),

                Select::make('parent_id')
                    ->label('Parent Category')
                    ->options(fn () => Category::whereNull('parent_id')->pluck('name', 'id'))
                    ->searchable()
                    ->nullable()
                    ->helperText('Leave empty if this is a main category'),

                Radio::make('status')
                    ->options(StatusEnum::class)
                    ->default(StatusEnum::Active)
                    ->columns(3)
                    ->required(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Category Name'),
                TextColumn::make('parent.name')->label('Parent Category'),
                StatusColumn::make(),
            ])
            ->filters([
                SelectFilter::make('parent_id')
                    ->label('Category')
                    ->options(fn () => Category::whereNull('parent_id')->pluck('name', 'id')),

                SelectFilter::make('id')
                    ->label('Sub Category')
                    ->options(fn () => Category::whereNotNull('parent_id')->pluck('name', 'id')),

                SelectFilter::make('status'),
            ], layout: FiltersLayout::AboveContent)

            ->recordActions([
                EditAction::make()
                    ->modalWidth('lg')
                    ->keyBindings(['command+s', 'ctrl+s']),
                DeleteAction::make(),
            ])
            ->headerActions([
                CreateAction::make()->modalWidth('lg'),
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
            'index' => ListCategories::route('/'),
        ];
    }
}
