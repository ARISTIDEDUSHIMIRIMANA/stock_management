<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'ProductId';
    
    protected $fillable = [
        'Product_Name',
        'Description',
        'Unit',
        'minimum_stock',
        'current_stock',
        'category_id'
    ];

    protected $casts = [
        'current_stock' => 'integer',
        'minimum_stock' => 'integer'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function stockIns()
    {
        return $this->hasMany(StockIn::class, 'Product_Id');
    }

    public function stockOuts()
    {
        return $this->hasMany(StockOut::class, 'Product_Id');
    }

    public function isLowStock()
    {
        return $this->current_stock <= $this->minimum_stock;
    }

    public function getAvailableStockAttribute()
    {
        $totalStockIn = $this->stockIns()->sum('Quantity');
        $totalStockOut = $this->stockOuts()->sum('Quantity');
        return $totalStockIn - $totalStockOut;
    }
}
