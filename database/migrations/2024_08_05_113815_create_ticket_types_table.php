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
        Schema::create('ticket_types', function (Blueprint $table) {
            $table->increments('ticket_type_id', 11)->unique();;
            $table->integer('ticket_type_event_id', 11);
            $table->string('ticket_type_name', 50);
            $table->string('ticket_type_price', 10);
            $table->integer('ticket_type_quantity', 11);
            $table->integer('ticket_type_real_quantity', 11);
            $table->integer('ticket_type_total_quantity', 11);
            $table->mediumText('ticket_type_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_types');
    }
};
