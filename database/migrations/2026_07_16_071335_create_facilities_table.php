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
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('category', ['hall', 'pool', 'court', 'clubhouse']);
            $table->text('decription');
            $table->time('starting_hours');
            $table->time('closing_hours');
            $table->integer('max_capacity');
            $table->decimal('base_fee', 8, 2);
            $table->enum('reservation_type', ['hourly', 'block']);
            $table->integer('max_resservation_duration');
            $table->enum('facility_status', ['Open', 'Under Maintenance', 'Closed']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }
};
