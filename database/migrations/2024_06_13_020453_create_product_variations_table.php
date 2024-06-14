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
        Schema::create('product_variations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('attribute_id');
            $table->unsignedBigInteger('propertie_id')->nullable();
            $table->text('value_add')->nullable();
            $table->double('add_price', 15, 2)->default(0);
            $table->double('stock', 15, 2)->default(0);
            $table->unsignedTinyInteger('state')->default(1)->comment('1 es activo y 2 inactivo');
            $table->unsignedBigInteger('product_variation_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraints (if needed)
            // $table->foreign('product_id')->references('id')->on('products');
            // $table->foreign('attribute_id')->references('id')->on('attributes');
            // $table->foreign('propertie_id')->references('id')->on('properties');
            // $table->foreign('product_variation_id')->references('id')->on('product_variations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variations');
    }
};
