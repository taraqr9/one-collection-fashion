<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\OrderStoreRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->with(['items.product'])->get();

        return view('user.order.index', compact('orders'));
    }

    public function store(OrderStoreRequest $request)
    {
        $data = $request->validated();
        $user_id = auth()->id();
        $mode = $request->input('checkout_mode', 'cart'); // 'cart' or 'buy_now'

        DB::transaction(function () use ($data, $user_id, $mode) {
            $order = Order::create([
                'user_id' => $user_id,
                'user_name' => $data['user_name'],
                'user_phone' => $data['user_phone'],
                'user_address' => $data['user_address'],
                'order_number' => strtoupper(Str::random(8)),
                'total_amount' => 0,
                'final_amount' => 0,
            ]);

            $total = 0;
            $stock_ids = [];

            foreach ($data['products'] as $item) {
                $product = Product::findOrFail($item['product_id']);
                $unitPrice = ($product->offer_price ?? 0) > 0 ? $product->offer_price : $product->price;
                $qty = (int) $item['quantity'];
                $lineTotal = $unitPrice * $qty;

                $order->items()->create([
                    'product_id' => $product->id,
                    'stock_id' => $item['stock_id'],
                    'product_name' => $product->name,
                    'sku' => optional($product->stocks()->find($item['stock_id']))->sku,
                    'quantity' => $qty,
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

            if ($mode === 'cart') {
                if ($user_id) {
                    // Logged-in user → delete items from DB cart
                    Cart::where('user_id', $user_id)
                        ->whereIn('stock_id', $stock_ids)
                        ->delete();
                } else {
                    // Guest user → clear session cart
                    session()->forget('cart');
                }
            }

            // Always clear buy-now artifacts (harmless if absent)
            session()->forget(['buy_now_mode', 'buy_now_item']);
        });

        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }
}
