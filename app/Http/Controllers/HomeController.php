<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $products = Product::with('thumbnail')->inRandomOrder()->limit(8)->get();
        $recommended_products = $products->take(4);
        $top_arrival = $products->skip(4)->take(4);

        return view('user.home', compact('recommended_products', 'top_arrival'));
    }
}
