<?php

namespace App\Filament\Resources;

use App\Enums\StatusEnum;
use App\Enums\StockTypeEnum;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Table\Columns\StatusColumn;
use App\Models\Category;
use App\Models\Product;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Product Details')
                    ->schema([
                        TextInput::make('name')
                            ->required(),

                        Select::make('parent_id')
                            ->label('Category')
                            ->relationship(
                                name: 'category',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn ($query) => $query->whereNull('parent_id')
                            )
                            ->live()
                            ->required(),

                        Select::make('category_id')
                            ->label('Sub Category')
                            ->options(fn (Get $get) => Category::where('parent_id', $get('parent_id'))
                                ->pluck('name', 'id')
                                ->toArray()
                            )
                            ->hidden(fn (Get $get) => empty($get('parent_id'))),

                        TextInput::make('price')
                            ->required(),

                        TextInput::make('offer_price')
                            ->default(0),

                        RichEditor::make('description')
                            ->required()
                            ->columnSpanFull(),

                        Radio::make('status')
                            ->options(StatusEnum::class)
                            ->default(StatusEnum::Active)
                            ->columns(3)
                            ->required(),
                    ])->columns(2),

                Fieldset::make('Stock Information')
                    ->schema([
                        Repeater::make('stocks')
                            ->relationship()
                            ->schema([
                                TextInput::make('sku')
                                    ->nullable(),

                                Select::make('type')
                                    ->options(StockTypeEnum::class)
                                    ->required(),

                                TextInput::make('value')
                                    ->placeholder('Red, XL, 500')
                                    ->required(),

                                TextInput::make('unit')
                                    ->placeholder('ML, KG, Pcs')
                                    ->label('Unit (optional)'),

                                TextInput::make('stock')
                                    ->numeric()
                                    ->default(0)
                                    ->required(),
                            ])
                            ->columnSpanFull()
                            ->columns(5),
                    ]),

                FileUpload::make('thumbnail_upload')
                    ->label('Thumbnail')
                    ->image()
                    ->disk('public')
                    ->directory('products/thumbnails')
                    ->hidden()
                    ->enableOpen()
                    ->dehydrated(false)
                    ->required(function (?Product $record, $state) {
                        return ! $record || empty($state);
                    })
                    ->afterStateHydrated(function (FileUpload $component, ?Product $record) {
                        if ($record && $record->thumbnail) {
                            $component->state($record->thumbnail->url);
                        }
                    }),

                FileUpload::make('product_images')
                    ->label('Product Images')
                    ->image()
                    ->disk('public')
                    ->directory('products/product_images')
                    ->hidden()
                    ->multiple()
                    ->columnSpanFull()
                    ->reorderable()
                    ->dehydrated(false)
                    ->required(fn (?Product $record, $state) => ! $record || empty($state))
                    ->afterStateHydrated(function (FileUpload $component, ?Product $record) {
                        if (! $record) {
                            return;
                        }

                        $paths = $record->productImages()
                            ->orderBy('order')
                            ->pluck('url')
                            ->all();

                        if (! empty($paths)) {
                            $component->state($paths);
                        }
                    }),

                Fieldset::make('Product Images')
                    ->schema([
                        FileUpload::make('thumbnail_upload')
                            ->label('Thumbnail')
                            ->image()
                            ->directory('products/thumbnails')
                            ->maxFiles(1)
                            ->required(function (?Product $record, $state) {
                                return ! $record || empty($state);
                            })
                            ->reactive()
                            ->dehydrated(false),

                        FileUpload::make('product_images')
                            ->label('Product Images')
                            ->image()
                            ->multiple()
                            ->required(fn (?Product $record, $state) => ! $record || empty($state))
                            ->directory('products/product_images')
                            ->reactive()
                            ->dehydrated(false),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('price'),
                TextColumn::make('offer_price'),
                TextColumn::make('parentCategory.name'),
                TextColumn::make('category.name'),
                TextColumn::make('total_stock')
                    ->label('Total Stock')
                    ->sortable(),
                StatusColumn::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
