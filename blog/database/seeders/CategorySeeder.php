<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $categories=[
        ['name'=>'sports'],
        ['name'=>'news'],
        ['name'=>'movies'],
        ['name'=>'music'],
    ];
    public function run(): void
    {
        foreach ($this->categories as $category) {
            Category::create($category);
        }
    }
}
