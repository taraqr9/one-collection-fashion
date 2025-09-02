<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $recommended_products = Product::inRandomOrder()->limit(4)->get();
        $top_arrival = Product::inRandomOrder()->limit(4)->get();

        return view('user.home', compact('recommended_products', 'top_arrival'));
    }
}
