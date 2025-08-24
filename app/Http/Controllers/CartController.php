<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View | RedirectResponse
    {
        $products = auth()->user()->carts()->get();

        if( $products->isEmpty()) {
            return redirect()->back()->with('error', 'Cart is empty');
        }

        return view('user.cart.index', compact('products'));
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();

        return redirect()->back()->with('success', 'Removed from cart successfully');
    }
}
