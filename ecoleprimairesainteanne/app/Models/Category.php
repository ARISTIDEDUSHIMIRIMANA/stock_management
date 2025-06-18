<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * Get the products for the category.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Get total stock value for this category
    public function getTotalStockValueAttribute()
    {
        return $this->products()
            ->join('stock_in', 'products.ProductId', '=', 'stock_in.Product_Id')
            ->sum('stock_in.Total_Price');
    }

    // Get total products count in this category
    public function getProductsCountAttribute()
    {
        return $this->products()->count();
    }

    // Get total stock quantity for this category
    public function getTotalStockQuantityAttribute()
    {
        return $this->products()->sum('current_stock');
    }
} 