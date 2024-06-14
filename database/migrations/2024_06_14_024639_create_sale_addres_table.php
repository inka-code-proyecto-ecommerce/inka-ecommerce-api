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
        Schema::create('sale_addres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sale_id');
            $table->string('name', 250);
            $table->string('surname', 250);
            $table->string('company', 250)->nullable();
            $table->string('country_region', 250)->nullable();
            $table->string('address', 250);
            $table->string('street', 250)->nullable();
            $table->string('city', 250)->nullable();
            $table->string('postcode_zip', 50)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('email', 250)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            
            // Foreign key constraint
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_addres');
    }
};
