<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Enums\OrderStatusEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Ordered By')
                    ->searchable(),
                TextColumn::make('order_number'),
                TextColumn::make('total_amount'),
                TextColumn::make('items_count')
                    ->counts('items')
                    ->label('Total Items'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($state) => match ($state->value) {
                        OrderStatusEnum::Pending->value => 'warning',
                        OrderStatusEnum::Approved->value => 'info',
                        OrderStatusEnum::Completed->value => 'success',
                        OrderStatusEnum::Canceled->value => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => $state->label()),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('UpdateStatus')
                    ->label('')
                    ->icon('heroicon-o-arrow-path')
                    ->modalHeading('Update Order Status')
                    ->fillForm(fn ($record) => [
                        'status' => $record->status,
                        'items' => $record->items->map(fn ($item) => [
                            'product_name' => $item->product_name,
                            'product_sku' => $item->product?->sku,
                            'variant_sku' => $item->stock?->sku,
                            'variant_type' => $item->stock?->type,
                            'variant_value' => $item->stock?->value,
                            'variant_unit' => $item->stock?->unit,
                            'ordered_qty' => $item->quantity,
                            'price' => $item->price,
                            'total' => $item->total,
                            'available_stock' => $item->stock?->stock ?? 0,
                        ])->toArray(),
                    ])
                    ->schema([
                        Section::make('Order Items')
                            ->schema([
                                Repeater::make('items')
                                    ->schema([
                                        TextInput::make('product_name')
                                            ->label('Product')
                                            ->disabled(),

                                        TextInput::make('product_sku')
                                            ->label('Product SKU')
                                            ->disabled(),

                                        TextInput::make('variant_sku')
                                            ->label('Variant SKU')
                                            ->disabled(),

                                        TextInput::make('variant_type')
                                            ->label('Type')
                                            ->disabled(),

                                        TextInput::make('variant_value')
                                            ->label('Value')
                                            ->disabled(),

                                        TextInput::make('variant_unit')
                                            ->label('Unit')
                                            ->disabled(),

                                        TextInput::make('ordered_qty')
                                            ->label('Ordered Qty')
                                            ->disabled(),

                                        TextInput::make('price')
                                            ->label('Price')
                                            ->disabled(),

                                        TextInput::make('total')
                                            ->label('Total')
                                            ->disabled(),

                                        TextInput::make('available_stock')
                                            ->label('Available Stock')
                                            ->disabled(),
                                    ])
                                    ->columns(5)
                                    ->disableItemCreation()
                                    ->disableItemDeletion()
                                    ->disableItemMovement(),
                            ]),

                        Section::make('Update')
                            ->schema([
                                Select::make('status')
                                    ->label('Update Status')
                                    ->options(OrderStatusEnum::options())
                                    ->required()
                                    ->columnSpan(1),
                            ])
                            ->columns(3),

                    ])
                    ->modalWidth('6xl')
                    ->action(function ($data, $record) {
                        $record->update(['status' => $data['status']]);
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
