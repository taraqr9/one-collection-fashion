<?php

namespace App\Http\Controllers\User;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', StatusEnum::Active)->get();

        $products = Product::where('status', StatusEnum::Active)
            ->with(['thumbnail', 'productImages'])
            ->get()
            ->map(function ($product) {
                $product->thumbnail_url = $product->thumbnail ? Storage::url($product->thumbnail->url) : null;

                return $product;
            });

        return view('user.product.index', compact('categories', 'products'));
    }
}
