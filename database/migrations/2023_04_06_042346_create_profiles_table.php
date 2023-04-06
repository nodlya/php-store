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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable(false);
            $table->string('title')->nullable(false); // название профиля
            $table->string('name')->nullable(false); // имя пользователя
            $table->string('email')->nullable(false); // почта пользователя
            $table->string('phone')->nullable(false); // телефон пользователя
            $table->string('address')->nullable(false); // адрес доставки заказа
            $table->string('comment')->nullable(); // комментарий к заказу
            $table->timestamps();

            // внешний ключ, ссылается на поле id таблицы users
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
