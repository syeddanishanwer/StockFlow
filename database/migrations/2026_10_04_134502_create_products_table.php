<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_name');
            $table->decimal('price');
            $table->integer('quantity');
            $table->string('status')->default('active');
            $table->timestamps();
            $table->unsignedBigInteger('category_id')->index('products_category_id_foreign');
            $table->unsignedBigInteger('supplier_id')->index('products_supplier_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
