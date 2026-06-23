<?php
namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'children' => ['Phones', 'Laptops', 'Tablets', 'Accessories']],
            ['name' => 'Fashion',     'children' => ['Men', 'Women', 'Kids', 'Shoes']],
            ['name' => 'Home & Garden','children' => ['Furniture', 'Kitchen', 'Decor']],
            ['name' => 'Sports',      'children' => ['Fitness', 'Outdoor', 'Team Sports']],
            ['name' => 'Books',       'children' => ['Fiction', 'Non-Fiction', 'Educational']],
            ['name' => 'Beauty',      'children' => ['Skincare', 'Makeup', 'Hair Care']],
        ];

        foreach ($categories as $cat) {
            $parent = Category::firstOrCreate(
                ['slug' => Str::slug($cat['name'])],
                ['name' => $cat['name'], 'status' => 'active']
            );

            foreach ($cat['children'] as $child) {
                Category::firstOrCreate(
                    ['slug' => Str::slug($cat['name'] . '-' . $child)],
                    ['name' => $child, 'parent_id' => $parent->id, 'status' => 'active']
                );
            }
        }
    }
}
