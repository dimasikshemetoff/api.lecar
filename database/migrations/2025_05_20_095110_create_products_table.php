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
            $table->id(); // Автоинкрементный ID (скрытый первичный ключ)
            $table->string('articul', 6)->unique(); // 6-значный артикул как уникальное поле
            $table->string('title');
            $table->string('category');
            $table->string('image')->nullable();
            $table->string('manufactured');
            $table->text('description');
            $table->decimal('newprice', 10);
            $table->boolean('isfavorite')->default(false);
            $table->boolean('prescription_required')->default(false); // Новое поле
            $table->decimal('oldprice', 10)->nullable();
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