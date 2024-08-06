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
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('ticket_id', 11)->unique();;
            $table->integer('ticket_event_id', 11);
            $table->string('ticket_email', 255);
            $table->string('ticket_phone', 20);
            $table->integer('ticket_price', 10);
            $table->integer('ticket_order_id', 11);
            $table->string('ticket_key', 100)->unique();
            $table->integer('ticket_ticket_type_id', 11);
            $table->enum('ticket_status', ['active', 'validated', 'expired', 'cancelled']);
            $table->timestamp('ticket_created_on');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
