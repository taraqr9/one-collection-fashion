<?php

namespace App\Http\Controllers\User;

use App\Enums\StatusEnum;
use App\Filter\ProductFilter;
use App\Http\Controllers\Controller;
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
        //        // Add thumbnail URL
        //        $product->thumbnail_url = $product->thumbnail
        //            ? Storage::url($product->thumbnail->url)
        //            : null;
        //
        //        // Add product images URLs
        //        $product->images_urls = $product->images->map(function ($img) {
        //            return Storage::url($img->url);
        //        });

        return view('user.product.show', compact('product'));
    }
}
