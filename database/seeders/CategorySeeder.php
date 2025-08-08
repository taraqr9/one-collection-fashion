<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $men = Category::create([
            'name' => 'Men',
            'status' => 'active',
        ]);

        $women = Category::create([
            'name' => 'Women',
            'status' => 'active',
        ]);

        $kids = Category::create([
            'name' => 'Kids',
            'status' => 'active',
        ]);

        // Subcategories for Men
        Category::create([
            'name' => 'Shirts',
            'parent_id' => $men->id,
            'status' => 'active',
        ]);

        Category::create([
            'name' => 'Pants',
            'parent_id' => $men->id,
            'status' => 'active',
        ]);

        Category::create([
            'name' => 'Shoes',
            'parent_id' => $men->id,
            'status' => 'active',
        ]);

        // Subcategories for Women
        Category::create([
            'name' => 'Dresses',
            'parent_id' => $women->id,
            'status' => 'active',
        ]);

        Category::create([
            'name' => 'Pants',
            'parent_id' => $women->id,
            'status' => 'active',
        ]);

        Category::create([
            'name' => 'Shoes',
            'parent_id' => $women->id,
            'status' => 'active',
        ]);

        // Subcategories for Kids
        Category::create([
            'name' => 'Toys',
            'parent_id' => $kids->id,
            'status' => 'active',
        ]);

        Category::create([
            'name' => 'Clothes',
            'parent_id' => $kids->id,
            'status' => 'active',
        ]);
    }
}
