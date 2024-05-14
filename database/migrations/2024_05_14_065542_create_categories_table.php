<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('categories', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('second_id')->nullable();
      $table->unsignedBigInteger('third_id')->nullable();
      $table->string('name');
      $table->text('icon')->nullable();
      $table->string('imagen')->nullable();
      $table->tinyInteger('position')->default(1);
      $table->tinyInteger('type')->default(1)->unsigned();
      $table->tinyInteger('state')->default(1)->unsigned();
      $table->foreign('second_id')->references('id')->on('categories')->onDelete('set null');
      $table->foreign('third_id')->references('id')->on('categories')->onDelete('set null');
      $table->timestamps();
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
