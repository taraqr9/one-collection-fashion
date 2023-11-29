<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSubCategoryRequest;
use App\Http\Requests\Admin\UpdateSubCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        view()->share('page', config('app.nav.product'));

        $products = Product::query()->orderByDesc('id')->paginate(10);

        return view('admin.product.product.index', compact('products'));
    }

    public function create(): View
    {
        view()->share('page', config('app.nav.product'));

        $categories = Category::query()->whereNull('parent_id')->get();

        return view('admin.product.product.create', compact('categories'));
    }

    public function store(StoreSubCategoryRequest $request): View|RedirectResponse
    {
        view()->share('page', config('app.nav.product'));

        $category = Category::create($request->validated());

        if(!$category)
        {
            return redirect()->back()->with('error', 'Sub category create failed!');
        }

        return redirect()->back()->with('success', 'Sub category created successfully!');
    }

    public function edit(Category $sub_category): View|RedirectResponse
    {
        view()->share('page', config('app.nav.product'));

        $categories = Category::query()->whereNull('parent_id')->get();

        return view('admin.product.product.edit', compact('categories', 'sub_category'));
    }

    public function update(UpdateSubCategoryRequest $request, Category $sub_category): View|RedirectResponse
    {
        view()->share('page', config('app.nav.product'));

        if(!$sub_category->update($request->validated()))
        {
            return redirect()->back()->with('error', 'Sub category update failed!');
        }

        return redirect()->back()->with('success', 'Sub category updated successfully');
    }

    public function delete(Category $sub_category): View|RedirectResponse
    {
        view()->share('page', config('app.nav.product'));

        if(!$sub_category->delete())
        {
            return redirect()->back()->with('error', 'Sub category delete failed!');
        }

        return redirect()->back()->with('success', 'Sub category deleted successfully');
    }
}
