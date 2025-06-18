<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('ProductId');
            $table->string('Product_Name');
            $table->text('description')->nullable();
            $table->string('Unit')->nullable();
            $table->integer('minimum_stock')->default(0);
            $table->integer('current_stock')->default(0);
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}; 