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
        Schema::create('discounts', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('code', 250)
                  ->charset('utf8mb4')
                  ->collation('utf8mb4_0900_ai_ci')
                  ->notNullable();
            $table->tinyInteger('type_discount')
                  ->unsigned()
                  ->default(1)
                  ->comment('1 es porcentaje y 2 es por monto fijo')
                  ->notNullable();
            $table->double('discount')
                  ->default(0)
                  ->notNullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->tinyInteger('discount_type')
                  ->unsigned()
                  ->default(1)
                  ->comment('1 es por curso y 2 es por categoria')
                  ->notNullable();
            $table->tinyInteger('type_campaing')
                  ->unsigned()
                  ->default(1)
                  ->comment('1 es normal, 2 es flash y 3 es banner.')
                  ->notNullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->tinyInteger('state')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
