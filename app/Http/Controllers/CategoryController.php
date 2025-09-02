<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\Category;

class CategoryController extends Controller
{
    public function subcategories(Category $category)
    {
        $subcategories = $category->children()->where('status', StatusEnum::Active)->get();

        return response()->json($subcategories);
    }
}
