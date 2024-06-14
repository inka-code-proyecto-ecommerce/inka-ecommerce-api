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
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->tinyInteger('type_discount')->nullable()->comment('1 % y 2 fijo');
            $table->double('discount')->nullable();
            $table->tinyInteger('type_campaing')->nullable()->comment('1 = campaña normal -- 2=campaña-flash -- 3 = campaña banner');
            $table->string('code_cupon', 150)->nullable();
            $table->string('code_discount', 150)->nullable();
            $table->unsignedBigInteger('product_variation_id')->nullable();
            $table->double('quantity', 15, 2)->default(1);
            $table->double('price_unit', 15, 2);
            $table->double('subtotal', 15, 2);
            $table->double('total', 15, 2);
            $table->string('currency', 20)->default('PEN');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
