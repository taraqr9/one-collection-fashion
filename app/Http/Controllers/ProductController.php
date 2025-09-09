<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Filter\ProductFilter;
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
        // If user is logged in → save directly to DB
        if (auth()->check()) {
            $user = auth()->user();

            // If product+stock already exists in DB cart, update quantity
            $existing = $user->carts()
                ->where('product_id', $request->product_id)
                ->where('stock_id', $request->stock_id)
                ->first();

            if ($existing) {
                $existing->increment('quantity', $request->quantity);
            } else {
                $user->carts()->create($request->validated());
            }

            return redirect()->back()->with('success', 'Added to cart successfully');
        }

        // Guest user → save to session
        $cart = session()->get('cart', []);

        $found = false;

        foreach ($cart as &$item) {
            if ($item['product_id'] == $request->product_id && $item['stock_id'] == $request->stock_id) {
                $item['quantity'] += $request->quantity;
                $found = true;
                break;
            }
        }
        unset($item);

        if (! $found) {
            $cart[] = [
                'product_id' => $request->product_id,
                'stock_id' => $request->stock_id,
                'quantity' => $request->quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Added to cart successfully');
    }
}
