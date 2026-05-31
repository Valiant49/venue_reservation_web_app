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
        Schema::create('facility', function (Blueprint $table) {
            $table->id();
            $table->string('facility_code');
            $table->string('facility_name');
            $table->enum('facility_type', ['clubhouse', 'pool', 'basketball', 'volleyball', 'badminton']);
            $table->decimal('base_fee', 10, 2);
            $table->string('capacity');
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facility');
    }
};
