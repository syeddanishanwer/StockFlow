<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('quantity');
            $table->decimal('unit_price');
            $table->decimal('total_price');
            $table->unsignedBigInteger('sale_id')->index('sales_sale_id_foreign');
            $table->unsignedBigInteger('product_id')->index('sales_product_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
