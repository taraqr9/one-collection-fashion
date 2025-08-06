<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();

        return view('user.product.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('user.product.show', compact('product'));
    }
    public function list()
    {
        return view('user.product-design.list');
    }

    public function detail()
    {
        return view('user.product-design.detail');
    }

    public function checkout()
    {
        return view('user.product-design.checkout');
    }

    public function cart()
    {
        return view('user.product-design.cart');
    }
}
