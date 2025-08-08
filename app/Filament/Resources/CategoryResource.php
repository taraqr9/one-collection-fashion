<?php

namespace App\Filament\Resources;

use App\Enums\StatusEnum;
use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\Pages\FilterCategories;
use App\Filament\Table\Columns\StatusColumn;
use App\Models\Category;
use Filament\Actions\Action;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Category Name')
                    ->required()
                    ->maxLength(255),

                Select::make('parent_id')
                    ->label('Parent Category')
                    ->options(fn() => Category::whereNull('parent_id')->pluck('name', 'id'))
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
                    ->options(fn() => Category::whereNull('parent_id')->pluck('name', 'id')),


                SelectFilter::make('id')
                    ->label('Sub Category')
                    ->options(fn() => Category::whereNotNull('parent_id')->pluck('name', 'id')),

                SelectFilter::make('status'),
            ], layout: FiltersLayout::AboveContent)

            ->actions([
                EditAction::make()->modalWidth('lg'),
                DeleteAction::make(),
            ])
            ->headerActions([
                CreateAction::make()->modalWidth('lg')
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
            'index' => Pages\ListCategories::route('/'),
        ];
    }
}
