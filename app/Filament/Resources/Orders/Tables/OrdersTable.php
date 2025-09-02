<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Enums\OrderStatusEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

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
                SelectFilter::make('status')
                    ->options(OrderStatusEnum::options())
                    ->default(OrderStatusEnum::Pending->value),
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
                            $sub->where('user_name', 'like', "%{$q}%")
                                ->orWhere('order_number', 'like', "%{$q}%");
                        });
                    }),
            ], layout: FiltersLayout::AboveContent)
            ->deferFilters(false)
            ->searchable(false)
            ->recordActions([
                Action::make('UpdateStatus')
                    ->label('')
                    ->icon('heroicon-o-check-circle')
                    ->modalHeading('Update Order Status')
                    ->fillForm(fn ($record) => [
                        'status' => $record->status,
                        'products' => $record->items
                            ->groupBy('product_id')
                            ->map(function ($items, $productId) {
                                $product = $items->first()->product;

                                return [
                                    'image' => $product?->thumbnail?->url,
                                    'product_name' => $product?->name,
                                    'product_sku' => $product?->sku,
                                    'variants' => $items->map(fn ($item) => [
                                        'variant_sku' => $item->stock?->sku,
                                        'variant_type' => $item->stock?->type,
                                        'variant_value' => $item->stock?->value,
                                        'variant_unit' => $item->stock?->unit,
                                        'ordered_qty' => $item->quantity,
                                        'price' => $item->price,
                                        'total' => $item->total,
                                        'available_stock' => $item->stock?->stock ?? 0,
                                    ])->toArray(),
                                ];
                            })->values()->toArray(),
                    ])
                    ->schema([
                        Section::make('Order Items')
                            ->schema([
                                Repeater::make('products')
                                    ->schema([
                                        // product-level info
                                        FileUpload::make('image')
                                            ->label('Product Image')
                                            ->disabled()
                                            ->columnSpanFull(),

                                        TextInput::make('product_name')
                                            ->label('Product')
                                            ->disabled(),

                                        TextInput::make('product_sku')
                                            ->label('Product SKU')
                                            ->disabled(),

                                        // nested repeater for variants
                                        Repeater::make('variants')
                                            ->schema([
                                                TextInput::make('variant_sku')->label('SKU')->disabled(),
                                                TextInput::make('variant_type')->label('Type')->disabled(),
                                                TextInput::make('variant_value')->label('Value')->disabled(),
                                                TextInput::make('variant_unit')->label('Unit')->disabled(),
                                                TextInput::make('ordered_qty')->label('Ordered QTY')->disabled(),
                                                TextInput::make('price')->label('Price')->disabled(),
                                                TextInput::make('total')->label('Total')->disabled(),
                                                TextInput::make('available_stock')->label('Available Stock')->disabled(),
                                            ])
                                            ->columns(4)
                                            ->disableItemCreation()
                                            ->disableItemDeletion()
                                            ->disableItemMovement(),
                                    ])
                                    ->disableItemCreation()
                                    ->disableItemDeletion()
                                    ->disableItemMovement(),
                            ]),

                        Section::make('Update')
                            ->schema([
                                Select::make('status')
                                    ->label('Update Status')
                                    ->options(OrderStatusEnum::options())
                                    ->required(),
                            ])
                            ->columns(3),
                    ])
                    ->modalWidth('6xl')
                    ->action(function ($data, $record) {
                        $oldStatus = $record->status->value;
                        $newStatus = $data['status'];

                        // If moving from Pending -> Approved => reduce stock
                        if ($oldStatus === OrderStatusEnum::Pending->value && $newStatus === OrderStatusEnum::Approved->value) {
                            foreach ($record->items as $item) {
                                if ($item->stock) {
                                    $item->stock->decrement('stock', $item->quantity);
                                }
                            }
                        }

                        // If moving from Approved -> Pending or Approved -> Canceled => restore stock
                        if ($oldStatus === OrderStatusEnum::Approved->value || $oldStatus === OrderStatusEnum::Completed->value && in_array($newStatus, [OrderStatusEnum::Pending->value, OrderStatusEnum::Canceled->value])) {
                            foreach ($record->items as $item) {
                                if ($item->stock) {
                                    $item->stock->increment('stock', $item->quantity);
                                }
                            }
                        }

                        $record->update(['status' => $newStatus]);
                        $record->recalcTotals(); // keep totals correct
                    }),
                EditAction::make()->keyBindings(['command+s', 'ctrl+s']),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
