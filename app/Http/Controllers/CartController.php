<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $products = auth()->user()->carts()->get();

        return view('user.cart.index', compact('products'));
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();

        return redirect()->back()->with('success', 'Removed from cart successfully');
    }
}
