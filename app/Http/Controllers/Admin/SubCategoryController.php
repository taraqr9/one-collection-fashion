<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\StoreSubCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Http\Requests\Admin\UpdateSubCategoryRequest;
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

    public function edit(Category $sub_category): View|RedirectResponse
    {
        view()->share('page', config('app.nav.sub_category'));

        if ($sub_category->parent_id == null) {
            return redirect()->back()->with('error', 'Sorry, you can not update category from sub category!');
        }

        $categories = Category::query()->whereNull('parent_id')->get();

        return view('admin.product.sub_category.edit', compact('sub_category', 'categories'));
    }

    public function update(UpdateSubCategoryRequest $request, Category $sub_category): View|RedirectResponse
    {
        view()->share('page', config('app.nav.sub_category'));

        if ($sub_category->parent_id == null) {
            return redirect()->back()->with('error', 'Sorry, you can not update category from sub category!');
        }

        if(!$sub_category->update($request->validated()))
        {
            return redirect()->back()->with('error', 'Sub category update failed!');
        }

        return redirect()->back()->with('success', 'Sub category updated successfully');
    }

    public function delete(Category $sub_category): View|RedirectResponse
    {
        view()->share('page', config('app.nav.sub_category'));

        if(!$sub_category->delete())
        {
            return redirect()->back()->with('error', 'Sub category delete failed!');
        }

        return redirect()->back()->with('success', 'Sub category deleted successfully');
    }
}
