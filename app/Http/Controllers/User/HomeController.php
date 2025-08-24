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
        $settings = Setting::get();
        $recommended_products = Product::inRandomOrder()->limit(4)->get();
        $top_arrival = Product::inRandomOrder()->limit(4)->get();

        return view('user.home', compact('settings', 'recommended_products', 'top_arrival'));
    }
}
