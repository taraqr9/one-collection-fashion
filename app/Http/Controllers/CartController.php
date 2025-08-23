<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $products = auth()->user()->carts()->get();

        ds($products->first());

        return view('user.cart.index', compact('products'));
    }
}
