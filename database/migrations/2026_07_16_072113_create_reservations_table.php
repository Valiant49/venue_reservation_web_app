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
            $table->timestamps();
            $table->id();
            $table->string('code');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->decimal('total_fee');
            $table->integer('guest_count');
            $table->string('event_type');
            $table->enum('status', ['Pending','Rejected','Under Review','Confirmed', 'Completed', 'Cancelled']);
            $table->text('notes')->nullable();
            $table->foreignId('facility_id')->constrained('facilities');
            $table->foreignId('reserved_by')->constrained('users');
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
