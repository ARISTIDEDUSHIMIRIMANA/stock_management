<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOut extends Model
{
    use HasFactory;

    protected $table = 'stock_out';
    
    protected $fillable = [
        'Product_Id',
        'Date',
        'Quantity',
    ];

    protected $casts = [
        'Date' => 'date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'Product_Id', 'ProductId');
    }
}
