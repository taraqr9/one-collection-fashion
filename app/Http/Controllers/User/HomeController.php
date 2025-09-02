<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Setting;
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
