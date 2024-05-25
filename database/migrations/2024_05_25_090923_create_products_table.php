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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('slug');
            $table->string('sku');
            $table->double('price_pen');
            $table->double('price_usd');
            $table->longText('descripcion');
            $table->longText('resumen');
            $table->string('imagen');
            $table->tinyInteger('state')->default(1)->unsigned();
            $table->longText('tags')->nullable();
            $table->unsignedBigInteger('brand_id')->unsigned();
            $table->unsignedBigInteger('category_first_id')->unsigned();
            $table->unsignedBigInteger('category_second_id')->nullable();
            $table->unsignedBigInteger('category_third_id')->nullable();
            $table->double('stock');
            $table->timestamps();
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
