<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Stock;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View|RedirectResponse
    {
        if (! auth()->check()) {
            return redirect()->route('products.index')->with('error', 'Please add some product first!');
        }
        if (session('buy_now_mode') && session()->has('buy_now_item')) {
            $item = session('buy_now_item');

            $products = collect([
                (object) [
                    'id' => $item['product']->id,
                    'product' => $item['product'],
                    'stock' => $item['stock'],
                    'stock_id' => $item['stock']->id,
                    'quantity' => (int) $item['quantity'],
                ],
            ]);

            return view('user.cart.index', [
                'products' => $products,
                'checkoutMode' => 'buy_now',
            ]);
        }

        session()->forget(['buy_now_mode', 'buy_now_item']);

        $products = auth()->user()->carts()->with(['product.thumbnail', 'stock', 'product'])->get();
        if ($products->isEmpty()) {
            return redirect()->back()->with('error', 'Cart is empty');
        }

        return view('user.cart.index', [
            'products' => $products,
            'checkoutMode' => 'cart',
        ]);
    }

    public function buyNow(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'stock_id' => ['required', 'integer', 'exists:stocks,id'],
            'quantity' => ['required', 'integer', 'min:1', 'max:999'],
        ]);

        $stock = Stock::with('product')->findOrFail($data['stock_id']);
        if ((int) $stock->product_id !== (int) $data['product_id']) {
            return back()->withErrors(['stock_id' => 'Invalid variant chosen.']);
        }

        // Flash = persists for the NEXT request only (the cart page render), then disappears.
        session()->flash('buy_now_mode', true);
        session()->flash('buy_now_item', [
            'product' => $stock->product,
            'stock' => $stock,
            'quantity' => (int) $data['quantity'],
        ]);

        return redirect()->route('carts.index');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();

        return redirect()->back()->with('success', 'Removed from cart successfully');
    }
}
