<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stock_out', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Product_Id')->references('ProductId')->on('products')->onDelete('restrict');
            $table->date('Date');
            $table->integer('Quantity');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stock_out');
    }
}; 