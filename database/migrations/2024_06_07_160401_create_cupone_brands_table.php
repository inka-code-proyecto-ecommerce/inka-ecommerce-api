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
        Schema::create('cupone_brands', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('cupone_id');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('cupone_id')->references('id')->on('cupones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cupone_brands');
    }
};
