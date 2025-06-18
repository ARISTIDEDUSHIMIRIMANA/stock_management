<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Stationery',
                'description' => 'School supplies like pens, pencils, notebooks, etc.'
            ],
            [
                'name' => 'Books',
                'description' => 'Textbooks and reference materials'
            ],
            [
                'name' => 'Cleaning Supplies',
                'description' => 'Cleaning materials and sanitation products'
            ],
            [
                'name' => 'Sports Equipment',
                'description' => 'Sports and physical education materials'
            ],
            [
                'name' => 'Office Supplies',
                'description' => 'Administrative and office materials'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
} 