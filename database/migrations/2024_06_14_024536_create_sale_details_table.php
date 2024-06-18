<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sale_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sale_id');
            $table->unsignedBigInteger('product_id');
            $table->tinyInteger('type_discount')->nullable();
            $table->double('discount')->nullable()->default(0);
            $table->tinyInteger('type_campaing')->unsigned()->nullable();
            $table->string('code_cupon', 250)->nullable();
            $table->string('code_discount', 50)->nullable();
            $table->unsignedBigInteger('product_variation_id')->nullable();
            $table->double('quantity')->default(1);
            $table->double('price_unit');
            $table->double('subtotal');
            $table->double('total');
            $table->string('currency', 20)->default('PEN');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            
            // Foreign key constraints
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_variation_id')->references('id')->on('product_variations')->onDelete('cascade');

            // Indexes
            $table->index(['sale_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_details');
    }
};
