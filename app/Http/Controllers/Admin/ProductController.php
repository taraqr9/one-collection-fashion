<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FilterProductRequest;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(FilterProductRequest $request): View
    {
        view()->share('page', config('app.nav.product'));

        $products = Product::query();

        if (isset($request->name)) {
            $products->where('name', 'like', '%'.$request->name.'%');
        }

        if (isset($request->category_id)) {
            $products->where('category_id', $request->category_id);
        }

        if (isset($request->parent_id)) {
            $products->where('parent_id', $request->parent_id);
        }

        if (isset($request->status)) {
            $products->where('status', $request->status);
        }

        $products = $products->with('category')
            ->with('subCategory')
            ->orderByDesc('id')
            ->paginate(10);

        $categories = Category::query()->where('parent_id', null)->get();

        return view('admin.product.product.index', compact('products', 'categories'));
    }

    public function create(): View
    {
        view()->share('page', config('app.nav.product'));

        $categories = Category::query()->get();

        return view('admin.product.product.create', compact('categories'));
    }

    public function store(StoreProductRequest $request): View|RedirectResponse
    {
        view()->share('page', config('app.nav.product'));

        $validatedData = $request->validated();

        if ($request->hasFile('color')) {
            $colorImages = [];
            foreach ($request->file('color') as $colorImage) {
                $colorImages[] = $colorImage->store('/product_colors', 'public');
            }

            $validatedData['color'] = json_encode($colorImages);
        }

        if ($request->hasFile('image')) {
            $productImages = [];
            foreach ($request->file('image') as $productImage) {
                $productImages[] = $productImage->store('product_images', 'public');
            }

            $validatedData['image'] = json_encode($productImages);
        }

        if ($request->hasFile('thumbnail')) {
            $validatedData['thumbnail'] = $request->file('thumbnail')->store('product_thumbnails', 'public');
        }

        $product = Product::create($validatedData);

        if (! $product) {
            return redirect()->back()->with('error', 'Product create failed!');
        }

        return redirect()->back()->with('success', 'Product created successfully!');
    }

    public function edit(Product $product): View|RedirectResponse
    {
        view()->share('page', config('app.nav.product'));

        $categories = Category::query()
            ->where('parent_id', null)
            ->get();

        return view('admin.product.product.edit', compact('product', 'categories'));
    }

    public function update(Product $product, UpdateProductRequest $request): View|RedirectResponse
    {
        $validatedData = $request->validated();

        if ($request->hasFile('color')) {
            $colorImages = [];

            if (isset($product->color)) {
                $colorImages = json_decode($product->color);
            }
            foreach ($request->file('color') as $colorImage) {
                $colorImages[] = $colorImage->store('/product_colors', 'public');
            }

            $validatedData['color'] = json_encode($colorImages);
        }

        if ($request->hasFile('image')) {
            $images = [];

            if (isset($product->image)) {
                $images = json_decode($product->color);
            }
            foreach ($request->file('image') as $colorImage) {
                $images[] = $colorImage->store('/product_colors', 'public');
            }

            $validatedData['image'] = json_encode($images);
        }

        if ($request->hasFile('thumbnail')) {
            $validatedData['thumbnail'] = $request->file('thumbnail')->store('product_thumbnails', 'public');
        }

        if (! $product->update($validatedData)) {
            return redirect()->back()->with('error', 'Product update failed!');
        }

        return redirect()->back()->with('success', 'Product updated successfully!');
    }

    public function delete(Product $product): View|RedirectResponse
    {
        view()->share('page', config('app.nav.product'));

        if (! $product->delete()) {
            return redirect()->back()->with('error', 'Product delete failed!');
        }

        return redirect()->back()->with('success', 'Product deleted successfully');
    }

    public function colorDelete(Product $product, $type, $index): RedirectResponse
    {
        $colors = json_decode($product[$type]);
        array_splice($colors, $index, 1);

        $product[$type] = count($colors) > 0 ? json_encode($colors) : null;

        if (! $product->update()) {
            return redirect()->back()->with('error', 'product '.$type.' delete failed!');
        }

        return redirect()->back()->with('success', 'product '.$type.' delete successfully');
    }
}
