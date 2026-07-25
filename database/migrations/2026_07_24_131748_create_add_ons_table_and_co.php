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
        /*
        |--------------------------------------------------------------------------
        | Add-ons
        |--------------------------------------------------------------------------
        */
        Schema::create('add_ons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->enum('is_active', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | Facility Add-ons
        | (Many-to-Many: Facilities <-> Add-ons)
        |--------------------------------------------------------------------------
        */
        Schema::create('facility_add_ons', function (Blueprint $table) {

            $table->foreignId('facility_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('add_on_id')
                ->constrained()
                ->cascadeOnDelete();

            // Prevent duplicate assignments
            $table->primary(['facility_id', 'add_on_id']);
        });

        /*
        |--------------------------------------------------------------------------
        | Reservation Add-ons
        | Stores selected add-ons for each reservation
        |--------------------------------------------------------------------------
        */
        Schema::create('reservation_add_ons', function (Blueprint $table) {
            $table->id();

            $table->foreignId('reservation_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('add_on_id')
                ->constrained()
                ->cascadeOnDelete();

            // Quantity selected
            $table->unsignedInteger('quantity')->default(1);

            // Preserve historical pricing
            $table->decimal('unit_price', 10, 2);

            // Convenience field
            $table->decimal('subtotal', 10, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_add_ons');
        Schema::dropIfExists('facility_add_ons');
        Schema::dropIfExists('add_ons');
    }
};
