<?php

namespace App\Http\Controllers\User;

use App\Enums\StatusEnum;
use App\Filter\ProductFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\AddToCartRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('status', StatusEnum::Active)->get();

        $query = Product::query();

        $query = ProductFilter::applyFilters($query, $request);

        $products = $query
            ->with(['thumbnail', 'productImages'])
            ->paginate(12)
            ->appends($request->query())
            ->through(function ($product) {
                $product->thumbnail_url = $product->thumbnail
                    ? Storage::url($product->thumbnail->url)
                    : null;

                return $product;
            });

        return view('user.product.index', compact('categories', 'products'));
    }

    public function show($id)
    {
        $product = Product::with(['thumbnail', 'productImages'])->findOrFail($id);

        return view('user.product.show', compact('product'));
    }

    public function addToCart(AddToCartRequest $request)
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        auth()->user()->carts()->create($request->validated());

        return redirect()->back()->with('success', 'Added on cart successfully');
    }
}
