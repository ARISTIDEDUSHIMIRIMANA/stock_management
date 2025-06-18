<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StockOut;
use App\Models\Product;
use Carbon\Carbon;

class StockOutSeeder extends Seeder
{
    public function run()
    {
        $departments = ['Primary 1', 'Primary 2', 'Primary 3', 'Primary 4', 'Primary 5', 'Primary 6', 'Administration', 'Library'];
        $products = Product::all();
        
        foreach ($products as $product) {
            // Add multiple stock out entries for each product
            for ($i = 0; $i < 2; $i++) {
                $quantity = rand(10, 50);
                
                // Only create stock out if there's enough stock
                if ($product->current_stock >= $quantity) {
                    StockOut::create([
                        'Product_Id' => $product->ProductId,
                        'Quantity' => $quantity,
                        'Department' => $departments[array_rand($departments)],
                        'Issued_By' => 'Store Manager',
                        'Received_By' => 'Department Head',
                        'Reference_Number' => 'OUT-' . strtoupper(uniqid()),
                        'Date' => Carbon::now()->subDays(rand(1, 15))->format('Y-m-d H:i:s')
                    ]);

                    // Update product current stock
                    $product->current_stock -= $quantity;
                    $product->save();
                }
            }
        }
    }
} 