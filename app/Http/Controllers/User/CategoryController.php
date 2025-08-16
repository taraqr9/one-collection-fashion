<?php

namespace App\Http\Controllers\User;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function subcategories(Category $category)
    {
        $subcategories = $category->children()->where('status', StatusEnum::Active)->get();

        return response()->json($subcategories);
    }
}
