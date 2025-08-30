<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Customer Information')
                    ->schema([
                        Select::make('user_id')
                            ->label('User')
                            ->options(User::getAllActiveUsers())
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('user_name')
                            ->label('Customer Name')
                            ->required(),

                        TextInput::make('user_phone')
                            ->label('Phone Number')
                            ->tel()
                            ->required(),

                        Textarea::make('user_address')
                            ->label('Address')
                            ->rows(3)
                            ->required(),
                    ])->columns(2)
                    ->columnSpanFull(),

                Section::make('Order Items')
                    ->schema([
                        Repeater::make('items')
                            ->relationship('items')
                            ->schema([
                                Select::make('product_id')
                                    ->label('Product')
                                    ->relationship('product', 'name')
                                    ->reactive()
                                    ->preload()
                                    ->searchable()
                                    ->required()
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        if ($state) {
                                            $product = Product::find($state);
                                            if ($product) {
                                                $set('price', $product->price ?? $product->offer_price);
                                            }
                                        } else {
                                            $set('product_name', null);
                                        }
                                    }),

                                Select::make('stock_id')
                                    ->label('Stock / Variant')
                                    ->options(function (callable $get) {
                                        $productId = $get('product_id');
                                        if (! $productId) {
                                            return [];
                                        }

                                        return Stock::where('product_id', $productId)
                                            ->pluck('sku', 'id')
                                            ->toArray();
                                    })
                                    ->preload()
                                    ->searchable()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        if ($state) {
                                            $stock = Stock::find($state);
                                            if ($stock) {
                                                $set('quantity', 1);
                                                $set('total', $stock->price);
                                                $set('product_name', $stock->product->name);
                                            }
                                        }
                                    })
                                    ->nullable(),

                                TextInput::make('price')
                                    ->label('Price')
                                    ->numeric()
                                    ->disabled()
                                    ->required(),

                                TextInput::make('quantity')
                                    ->label('Quantity')
                                    ->numeric()
                                    ->minValue(1)
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set, $get) {
                                        $price = $get('price') ?? 0;
                                        $set('total', $price * $state);
                                    }),

                                TextInput::make('total')
                                    ->label('Total')
                                    ->numeric()
                                    ->disabled(),
                            ])
                            ->columns(3)
                            ->createItemButtonLabel('Add Item'),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
