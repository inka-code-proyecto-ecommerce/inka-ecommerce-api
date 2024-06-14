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
        Schema::create('user_addres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
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
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addres');
    }
};
