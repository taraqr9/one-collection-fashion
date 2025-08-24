<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\OrderStoreRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function store(OrderStoreRequest $request)
    {
        $data = $request->validated();
        $user_id = auth()->id();

        DB::transaction(function () use ($data, $user_id) {
            $order = Order::create([
                'user_id' => $user_id,
                'user_name' => $data['user_name'],
                'user_phone' => $data['user_phone'],
                'user_address' => $data['user_address'],
                'order_number' => strtoupper(Str::random(8)),
                'total_amount' => 0, // will update after items
                'final_amount' => 0,
            ]);

            $total = 0;
            $stock_ids = [];

            foreach ($data['products'] as $item) {
                $product = Product::findOrFail($item['product_id']);
                $unitPrice = $product->offer_price ?? $product->price;
                $lineTotal = $unitPrice * $item['quantity'];

                $order->items()->create([
                    'product_id' => $product->id,
                    'stock_id' => $item['stock_id'],
                    'product_name' => $product->name,
                    'sku' => optional($product->stocks()->find($item['stock_id']))->sku,
                    'quantity' => $item['quantity'],
                    'price' => $unitPrice,
                    'total' => $lineTotal,
                ]);

                $total += $lineTotal;
                $stock_ids[] = $item['stock_id'];
            }

            $order->update([
                'total_amount' => $total,
                'final_amount' => $total,
            ]);

            Cart::where('user_id', $user_id)
                ->whereIn('stock_id', $stock_ids)
                ->delete();
        });

        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }

}
