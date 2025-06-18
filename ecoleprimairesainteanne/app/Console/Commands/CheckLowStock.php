<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckLowStock extends Command
{
    protected $signature = 'stock:check-low';
    protected $description = 'Check for products with low stock levels';

    public function handle()
    {
        $lowStockProducts = Product::with('category')
            ->whereRaw('current_stock <= minimum_stock')
            ->get();

        if ($lowStockProducts->isEmpty()) {
            $this->info('No products with low stock found.');
            return 0;
        }

        $this->warn('Found ' . $lowStockProducts->count() . ' products with low stock:');
        
        $headers = ['Product', 'Category', 'Current Stock', 'Minimum Stock'];
        $rows = [];

        foreach ($lowStockProducts as $product) {
            $rows[] = [
                $product->Product_Name,
                $product->category ? $product->category->name : 'Uncategorized',
                $product->current_stock,
                $product->minimum_stock
            ];

            // Log the low stock alert
            Log::warning("Low stock alert for {$product->Product_Name}: Current stock {$product->current_stock} is at or below minimum {$product->minimum_stock}");
        }

        $this->table($headers, $rows);
        return 0;
    }
} 