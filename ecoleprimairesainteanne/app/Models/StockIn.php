<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
    use HasFactory;

    protected $table = 'stock_in';
    
    protected $fillable = [
        'Product_Id',
        'Date',
        'Quantity',
        'Unit_Price',
        'Total_Price',
        'Supplier',
        'Reference_Number'
    ];

    protected $casts = [
        'Date' => 'date',
        'Unit_Price' => 'decimal:2',
        'Total_Price' => 'decimal:2',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'Product_Id', 'ProductId');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
