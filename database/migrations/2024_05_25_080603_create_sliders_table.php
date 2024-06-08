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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title', 250);
            $table->string('label', 250)->nullable();
            $table->tinyInteger('type_slider')->default(1)->unsigned()->comment('1 principal, 2 banners y 3 productos');
            $table->longText('subtitle')->nullable();
            $table->string('imagen', 250);
            $table->text('link')->nullable();
            $table->string('color', 50)->nullable();
            $table->double('price_original')->nullable();
            $table->double('price_campaing')->nullable();
            $table->tinyInteger('state')->default(1)->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
