<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $stationery = Category::where('name', 'Stationery')->first();
        $books = Category::where('name', 'Books')->first();
        $cleaning = Category::where('name', 'Cleaning Supplies')->first();
        $sports = Category::where('name', 'Sports Equipment')->first();
        $office = Category::where('name', 'Office Supplies')->first();

        $products = [
            // Stationery Products
            [
                'Product_Name' => 'Notebooks',
                'description' => 'A5 size, 200 pages',
                'category_id' => $stationery->id,
                'Unit' => 'Piece',
                'minimum_stock' => 50,
                'current_stock' => 0
            ],
            [
                'Product_Name' => 'Pencils',
                'description' => 'HB grade pencils',
                'category_id' => $stationery->id,
                'Unit' => 'Box',
                'minimum_stock' => 20,
                'current_stock' => 0
            ],
            // Books
            [
                'Product_Name' => 'Mathematics Textbook',
                'description' => 'Primary level mathematics book',
                'category_id' => $books->id,
                'Unit' => 'Piece',
                'minimum_stock' => 30,
                'current_stock' => 0
            ],
            [
                'Product_Name' => 'English Reader',
                'description' => 'Primary level English reading book',
                'category_id' => $books->id,
                'Unit' => 'Piece',
                'minimum_stock' => 30,
                'current_stock' => 0
            ],
            // Cleaning Supplies
            [
                'Product_Name' => 'Broom',
                'description' => 'Standard cleaning broom',
                'category_id' => $cleaning->id,
                'Unit' => 'Piece',
                'minimum_stock' => 10,
                'current_stock' => 0
            ],
            [
                'Product_Name' => 'Soap',
                'description' => 'Hand washing soap',
                'category_id' => $cleaning->id,
                'Unit' => 'Box',
                'minimum_stock' => 15,
                'current_stock' => 0
            ],
            // Sports Equipment
            [
                'Product_Name' => 'Football',
                'description' => 'Standard size football',
                'category_id' => $sports->id,
                'Unit' => 'Piece',
                'minimum_stock' => 5,
                'current_stock' => 0
            ],
            [
                'Product_Name' => 'Jump Rope',
                'description' => 'Exercise jump rope',
                'category_id' => $sports->id,
                'Unit' => 'Piece',
                'minimum_stock' => 10,
                'current_stock' => 0
            ],
            // Office Supplies
            [
                'Product_Name' => 'Printer Paper',
                'description' => 'A4 size printer paper',
                'category_id' => $office->id,
                'Unit' => 'Ream',
                'minimum_stock' => 20,
                'current_stock' => 0
            ],
            [
                'Product_Name' => 'Stapler',
                'description' => 'Standard office stapler',
                'category_id' => $office->id,
                'Unit' => 'Piece',
                'minimum_stock' => 5,
                'current_stock' => 0
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
} 