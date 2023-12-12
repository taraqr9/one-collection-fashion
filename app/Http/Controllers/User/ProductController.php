<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function list()
    {
        return view('user.product.list');
    }

    public function detail()
    {
        return view('user.product.detail');
    }

    public function checkout()
    {
        return view('user.product.checkout');
    }

    public function cart()
    {
        return view('user.product.cart');
    }
}
