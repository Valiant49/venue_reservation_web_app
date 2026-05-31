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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('reservation_code');
            $table->date('reservation_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->decimal('total_fee');
            $table->date('created_at');
            $table->date('last_updated');
            $table->integer('guest_count');
            $table->enum('status', ['Pending', 'Confirmed', 'Cancelled']);
            $table->text('event_type');
            $table->text('notes');
            $table->foreignId('facility_id')->constrained('facility');
            $table->foreignId('reserved_by')->constrained('clients');
            $table->foreignId('facilitated_by')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
