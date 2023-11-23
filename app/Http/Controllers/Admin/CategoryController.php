<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        view()->share('page', config('app.nav.category'));

        $categories = Category::query()->whereNull('parent_id')->orderByDesc('id')->get();

        return view('admin.product.category.index', compact('categories'));
    }

    public function create(): View
    {
        view()->share('page', config('app.nav.category'));

        return view('admin.product.category.create');
    }

    public function store(StoreCategoryRequest $request): View|RedirectResponse
    {
        view()->share('page', config('app.nav.category'));

        $category = Category::create($request->validated());

        if(!$category)
        {
            return redirect()->back()->with('error', 'Category create failed!');
        }

        return redirect()->back()->with('success', 'Category created successfully!');
    }

    public function edit(Category $category): View|RedirectResponse
    {
        view()->share('page', config('app.nav.category'));

        return view('admin.product.category.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category): View|RedirectResponse
    {
        view()->share('page', config('app.nav.category'));

        if(!$category->update($request->validated()))
        {
            return redirect()->back()->with('error', 'Category update failed!');
        }

        return redirect()->back()->with('success', 'Category updated successfully');
    }

    public function delete(Category $category): View|RedirectResponse
    {
        view()->share('page', config('app.nav.category'));

        if(!$category->delete())
        {
            return redirect()->back()->with('error', 'Category delete failed!');
        }

        return redirect()->back()->with('success', 'Category deleted successfully');
    }

}
