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
        Schema::create('events', function (Blueprint $table) {
            $table->increments('event_id', 11)->unique();;
            $table->enum('event_category', ['Autre', 'Concert-Spectable', 'Diner Gala', 'Festival', 'Formation']);
            $table->string('event_title', 30);
            $table->text('event_description');
            $table->dateTime('event_date');
            $table->string('event_image', 200);
            $table->string('event_city', 100);
            $table->string('event_address', 200);
            $table->enum('event_status', ['Upcoming', 'Completed', 'Cancelled']);
            $table->timestamp('event_created_on');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
