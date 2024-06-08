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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categorie_second_id')->nullable();
            $table->unsignedBigInteger('categorie_third_id')->nullable();
            $table->string('name', 250);
            $table->text('icon')->nullable();
            $table->string('imagen', 250)->nullable();
            $table->double('position')->unsigned()->default(1);
            $table->tinyInteger('type_categorie')->unsigned()->default(1)->comment('1 es departamento, 2 categoria y 3 subcategoria');
            $table->tinyInteger('state')->unsigned()->default(1)->comment('1 es activo y 2 es inactivo');
            $table->timestamps();
            $table->softDeletes();
        
            $table->foreign('categorie_second_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('categorie_third_id')->references('id')->on('categories')->onDelete('set null');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
