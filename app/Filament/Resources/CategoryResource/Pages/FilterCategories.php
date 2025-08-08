<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use App\Models\Category;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Filters\SelectFilter;

class FilterCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    public static function filters(): array
    {
        return [
            SelectFilter::make('parent_id')
                ->label('Category')
                ->options(fn() => Category::whereNull('parent_id')->pluck('name', 'id'))
                ->searchable()
                ->preload(),

            SelectFilter::make('id')
                ->label('Sub Category')
                ->options(fn () => Category::whereNotNull('parent_id')->pluck('name', 'id'))
                ->searchable()
                ->preload(),

            SelectFilter::make('status'),
        ];
    }
}
