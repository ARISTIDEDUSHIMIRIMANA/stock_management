<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StockIn;
use App\Models\Product;
use Carbon\Carbon;

class StockInSeeder extends Seeder
{
    public function run()
    {
        $products = Product::all();
        
        foreach ($products as $product) {
            // Add multiple stock in entries for each product
            for ($i = 0; $i < 3; $i++) {
                $quantity = rand(50, 200);
                $unitPrice = rand(500, 5000);
                
                StockIn::create([
                    'Product_Id' => $product->ProductId,
                    'Quantity' => $quantity,
                    'Unit_Price' => $unitPrice,
                    'Total_Price' => $quantity * $unitPrice,
                    'Supplier' => 'Sainte Anne Supplier Ltd',
                    'Reference_Number' => 'REF-' . strtoupper(uniqid()),
                    'Date' => Carbon::now()->subDays(rand(1, 30))->format('Y-m-d H:i:s')
                ]);

                // Update product current stock
                $product->current_stock += $quantity;
                $product->save();
            }
        }
    }
} 