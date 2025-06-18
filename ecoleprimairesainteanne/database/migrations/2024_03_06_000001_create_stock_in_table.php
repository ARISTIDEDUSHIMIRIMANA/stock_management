<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stock_in', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Product_Id')->references('ProductId')->on('products')->onDelete('restrict');
            $table->date('Date');
            $table->integer('Quantity');
            $table->decimal('Unit_Price', 10, 2);
            $table->decimal('Total_Price', 12, 2);
            $table->string('Supplier');
            $table->string('Reference_Number')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stock_in');
    }
}; 