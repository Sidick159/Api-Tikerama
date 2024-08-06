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
        Schema::create('orders_intents', function (Blueprint $table) {
            $table->increments('order_intent_id', 11)->unique();;
            $table->mediumInt('order_intent_price', 10);
            $table->string('order_intent_type', 50);
            $table->string('user_email', 100);
            $table->string('user_phone', 20);
            $table->dateTime('expiration_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_intents');
    }
};
