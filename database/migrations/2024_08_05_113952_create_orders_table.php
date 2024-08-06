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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('order_id', 11)->unique();
            $table->string('order_number', 50);
            $table->integer('order_event_id', 11);
            $table->string('order_price', 10);
            $table->string('order_type', 50);
            $table->string('order_payment', 100);
            $table->text('order_info');
            $table->timestamp('order_created_on');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
