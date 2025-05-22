<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('baskets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('product_articul'); // артикул товара
            $table->integer('quantity')->default(1);
            $table->decimal('price_per_item', 10, 2); // цена за единицу на момент добавления
            $table->decimal('total_price', 10, 2); // общая стоимость (quantity * price_per_item)
            $table->timestamps();
            
            // Связь с таблицей продуктов по артикулу
            $table->foreign('product_articul')
                  ->references('articul')
                  ->on('products')
                  ->onDelete('cascade');
                  
            // Уникальный ключ, чтобы у пользователя не было дубликатов товаров в корзине
            $table->unique(['user_id', 'product_articul']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('baskets');
    }
};