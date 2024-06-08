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
        Schema::create('cupones', function (Blueprint $table) {
            $table->id();
            $table->string('code', 250);
            $table->tinyInteger('type_discount')->unsigned()->default(1)->comment('1 es porcentaje y 2 es monto fijo');
            $table->double('discount');
            $table->tinyInteger('type_count')->unsigned()->default(1)->comment('1 es ilimitado y 2 limitado');
            $table->double('num_use')->default(0);
            $table->tinyInteger('type_cupone')->unsigned()->default(1)->comment('1 es product , 2 categorias y 3 marcas');
            $table->tinyInteger('state')->unsigned()->default(1)->comment('1 es activo y 2 inactivo');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cupones');
    }
};
