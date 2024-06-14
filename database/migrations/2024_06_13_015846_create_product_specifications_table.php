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
        Schema::create('product_specifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('attribute_id');
            $table->unsignedBigInteger('propertie_id')->nullable();
            $table->text('value_add')->nullable();
            $table->unsignedTinyInteger('state')->default(1)->comment('1 es activo y 2 inactivo');
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraints (if needed)
            // $table->foreign('product_id')->references('id')->on('products');
            // $table->foreign('attribute_id')->references('id')->on('attributes');
            // $table->foreign('propertie_id')->references('id')->on('properties');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_specifications');
    }
};
