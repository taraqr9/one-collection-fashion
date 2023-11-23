<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\StoreSubCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubCategoryController extends Controller
{
    public function index(): View
    {
        view()->share('page', config('app.nav.sub_category'));

        $sub_categories = Category::query()->whereNotNull('parent_id')->get();

        return view('admin.product.sub_category.index', compact('sub_categories'));
    }

    public function create(): View
    {
        view()->share('page', config('app.nav.sub_category'));

        $categories = Category::query()->whereNull('parent_id')->get();

        return view('admin.product.sub_category.create', compact('categories'));
    }

    public function store(StoreSubCategoryRequest $request): View|RedirectResponse
    {
        view()->share('page', config('app.nav.sub_category'));

        $category = Category::create($request->validated());

        if(!$category)
        {
            return redirect()->back()->with('error', 'Sub category create failed!');
        }

        return redirect()->back()->with('success', 'Sub category created successfully!');
    }

    public function edit(Category $category): View|RedirectResponse
    {
        view()->share('page', config('app.nav.sub_category'));

        return view('admin.product.sub_category.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category): View|RedirectResponse
    {
        view()->share('page', config('app.nav.sub_category'));

        if(!$category->update($request->validated()))
        {
            return redirect()->back()->with('error', 'Category update failed!');
        }

        return redirect()->back()->with('success', 'Category updated successfully');
    }

    public function delete(Category $category): View|RedirectResponse
    {
        view()->share('page', config('app.nav.sub_category'));

        if(!$category->delete())
        {
            return redirect()->back()->with('error', 'Category delete failed!');
        }

        return redirect()->back()->with('success', 'Category deleted successfully');
    }
}
