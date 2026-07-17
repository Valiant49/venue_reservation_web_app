<?php

namespace Tests\Feature;

use App\Models\Resident;
use App\Models\Facility;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ReservationControllerTest extends TestCase
{
    // DatabaseTransactions wraps every test in a transaction and rolls it back
    // after — so your live MariaDB data is never permanently altered.
    use DatabaseTransactions;

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    /** Returns a logged-in staff user. */
    private function actingAsStaff(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        return $user;
    }

    /** Base valid payload for store/update. */
    private function validPayload(array $overrides = []): array
    {
        $facility = Facility::factory()->create(['capacity' => 50]);
        $resident   = Resident::factory()->create();
        $staff    = User::factory()->create();

        return array_merge([
            'facility_id'      => $facility->id,
            'reserved_by'      => $resident->id,
            'facilitated_by'   => $staff->id,
            'reservation_date' => now()->addDays(3)->format('Y-m-d'),
            'start_time'       => '09:00',
            'end_time'         => '12:00',
            'total_fee'        => '500.00',
            'guest_count'      => 20,
            'status'           => 'Pending',
            'event_type'       => 'Meeting',
            'notes'            => null,
        ], $overrides);
    }

    // =========================================================================
    // AUTH GUARD
    // =========================================================================

    public function test_unauthenticated_user_cannot_access_reservations(): void
    {
        $this->get('/reservation')->assertRedirect('/login');
    }

    // =========================================================================
    // INDEX
    // =========================================================================

    public function test_index_loads_successfully(): void
    {
        $this->actingAsStaff();
        $this->get('/reservation')->assertOk();
    }

    // =========================================================================
    // STORE — happy path
    // =========================================================================

    public function test_store_creates_reservation_with_valid_data(): void
    {
        $this->actingAsStaff();

        $this->post('/reservation', $this->validPayload())
             ->assertRedirect('/reservation')
             ->assertSessionHas('success');
    }

    public function test_store_allows_reservation_with_null_notes(): void
    {
        $this->actingAsStaff();

        $this->post('/reservation', $this->validPayload(['notes' => null]))
             ->assertRedirect('/reservation');
    }

    public function test_store_allows_reservation_with_notes(): void
    {
        $this->actingAsStaff();

        $this->post('/reservation', $this->validPayload(['notes' => 'Extra chairs needed']))
             ->assertRedirect('/reservation');
    }

    // =========================================================================
    // STORE — date validation
    // =========================================================================

    public function test_store_rejects_past_reservation_date(): void
    {
        $this->actingAsStaff();

        $this->post('/reservation', $this->validPayload([
            'reservation_date' => now()->subDay()->format('Y-m-d'),
        ]))->assertSessionHasErrors('reservation_date');
    }

    public function test_store_accepts_todays_date(): void
    {
        $this->actingAsStaff();

        $this->post('/reservation', $this->validPayload([
            'reservation_date' => now()->format('Y-m-d'),
        ]))->assertRedirect('/reservation');
    }

    // =========================================================================
    // STORE — time validation
    // =========================================================================

    public function test_store_rejects_end_time_before_start_time(): void
    {
        $this->actingAsStaff();

        $this->post('/reservation', $this->validPayload([
            'start_time' => '14:00',
            'end_time'   => '10:00',
        ]))->assertSessionHasErrors('end_time');
    }

    public function test_store_rejects_end_time_equal_to_start_time(): void
    {
        $this->actingAsStaff();

        $this->post('/reservation', $this->validPayload([
            'start_time' => '10:00',
            'end_time'   => '10:00',
        ]))->assertSessionHasErrors('end_time');
    }

    // =========================================================================
    // STORE — conflict detection (all 3 overlap cases)
    // =========================================================================

    /**
     * Case 1: new reservation's start_time falls inside an existing block.
     * Existing: 09:00–12:00   New: 10:00–13:00
     */
    public function test_store_rejects_reservation_when_start_time_overlaps_existing(): void
    {
        $this->actingAsStaff();
        $payload = $this->validPayload();

        Reservation::factory()->create([
            'facility_id'      => $payload['facility_id'],
            'reservation_date' => $payload['reservation_date'],
            'start_time'       => '09:00',
            'end_time'         => '12:00',
        ]);

        $this->post('/reservation', array_merge($payload, [
            'start_time' => '10:00',
            'end_time'   => '13:00',
        ]))->assertSessionHasErrors('end_time');
    }

    /**
     * Case 2: new reservation's end_time falls inside an existing block.
     * Existing: 09:00–12:00   New: 08:00–10:00
     */
    public function test_store_rejects_reservation_when_end_time_overlaps_existing(): void
    {
        $this->actingAsStaff();
        $payload = $this->validPayload();

        Reservation::factory()->create([
            'facility_id'      => $payload['facility_id'],
            'reservation_date' => $payload['reservation_date'],
            'start_time'       => '09:00',
            'end_time'         => '12:00',
        ]);

        $this->post('/reservation', array_merge($payload, [
            'start_time' => '08:00',
            'end_time'   => '10:00',
        ]))->assertSessionHasErrors('end_time');
    }

    /**
     * Case 3: new reservation completely wraps an existing block.
     * Existing: 09:00–12:00   New: 08:00–13:00
     */
    public function test_store_rejects_reservation_that_wraps_existing_block(): void
    {
        $this->actingAsStaff();
        $payload = $this->validPayload();

        Reservation::factory()->create([
            'facility_id'      => $payload['facility_id'],
            'reservation_date' => $payload['reservation_date'],
            'start_time'       => '09:00',
            'end_time'         => '12:00',
        ]);

        $this->post('/reservation', array_merge($payload, [
            'start_time' => '08:00',
            'end_time'   => '13:00',
        ]))->assertSessionHasErrors('end_time');
    }

    /**
     * Back-to-back reservations (end == next start) should NOT conflict.
     * Existing: 09:00–12:00   New: 12:00–14:00
     */
    public function test_store_allows_back_to_back_reservations(): void
    {
        $this->actingAsStaff();
        $payload = $this->validPayload();

        Reservation::factory()->create([
            'facility_id'      => $payload['facility_id'],
            'reservation_date' => $payload['reservation_date'],
            'start_time'       => '09:00',
            'end_time'         => '12:00',
        ]);

        $this->post('/reservation', array_merge($payload, [
            'start_time' => '12:00',
            'end_time'   => '14:00',
        ]))->assertRedirect('/reservation');
    }

    /**
     * Same time block on a DIFFERENT facility should be allowed.
     */
    public function test_store_allows_same_time_block_on_different_facility(): void
    {
        $this->actingAsStaff();
        $payload       = $this->validPayload();
        $otherFacility = Facility::factory()->create(['capacity' => 50]);

        Reservation::factory()->create([
            'facility_id'      => $payload['facility_id'],
            'reservation_date' => $payload['reservation_date'],
            'start_time'       => '09:00',
            'end_time'         => '12:00',
        ]);

        $this->post('/reservation', array_merge($payload, [
            'facility_id' => $otherFacility->id,
            'start_time'  => '09:00',
            'end_time'    => '12:00',
        ]))->assertRedirect('/reservation');
    }

    // =========================================================================
    // STORE — guest count vs capacity
    // =========================================================================

    public function test_store_rejects_guest_count_exceeding_capacity(): void
    {
        $this->actingAsStaff();
        $facility = Facility::factory()->create(['capacity' => 10]);
        $payload  = $this->validPayload(['facility_id' => $facility->id]);

        $this->post('/reservation', array_merge($payload, ['guest_count' => 11]))
             ->assertSessionHasErrors('guest_count');
    }

    public function test_store_accepts_guest_count_equal_to_capacity(): void
    {
        $this->actingAsStaff();
        $facility = Facility::factory()->create(['capacity' => 10]);
        $payload  = $this->validPayload(['facility_id' => $facility->id]);

        $this->post('/reservation', array_merge($payload, ['guest_count' => 10]))
             ->assertRedirect('/reservation');
    }

    // =========================================================================
    // STORE — status validation
    // =========================================================================

    public function test_store_rejects_invalid_status(): void
    {
        $this->actingAsStaff();

        $this->post('/reservation', $this->validPayload(['status' => 'Ghosted']))
             ->assertSessionHasErrors('status');
    }

    // =========================================================================
    // UPDATE — only notes changed (the original bug)
    // =========================================================================

    public function test_update_only_notes_does_not_trigger_conflict_error(): void
    {
        $this->actingAsStaff();

        $reservation = Reservation::factory()->create([
            'reservation_date' => now()->addDays(3)->format('Y-m-d'),
            'start_time'       => '09:00',
            'end_time'         => '12:00',
            'notes'            => null,
        ]);

        $this->put("/reservation/{$reservation->id}", array_merge($reservation->toArray(), [
            'notes' => 'Added a note now',
        ]))
             ->assertRedirect('/reservation')
             ->assertSessionHas('success');
    }

    public function test_update_does_not_conflict_with_itself(): void
    {
        $this->actingAsStaff();

        $reservation = Reservation::factory()->create([
            'reservation_date' => now()->addDays(3)->format('Y-m-d'),
            'start_time'       => '09:00',
            'end_time'         => '12:00',
        ]);

        $this->put("/reservation/{$reservation->id}", $reservation->toArray())
             ->assertRedirect('/reservation');
    }

    // =========================================================================
    // UPDATE — conflict detection still works for actual conflicts
    // =========================================================================

    public function test_update_rejects_time_change_that_conflicts_with_another_reservation(): void
    {
        $this->actingAsStaff();

        $facility = Facility::factory()->create(['capacity' => 50]);
        $date     = now()->addDays(3)->format('Y-m-d');

        Reservation::factory()->create([
            'facility_id'      => $facility->id,
            'reservation_date' => $date,
            'start_time'       => '13:00',
            'end_time'         => '16:00',
        ]);

        $reservation = Reservation::factory()->create([
            'facility_id'      => $facility->id,
            'reservation_date' => $date,
            'start_time'       => '09:00',
            'end_time'         => '12:00',
        ]);

        $this->put("/reservation/{$reservation->id}", array_merge($reservation->toArray(), [
            'start_time' => '14:00',
            'end_time'   => '17:00',
        ]))->assertSessionHasErrors('end_time');
    }

    // =========================================================================
    // UPDATE — date validation
    // =========================================================================

    public function test_update_allows_editing_reservation_without_changing_its_date(): void
    {
        $this->actingAsStaff();

        $reservation = Reservation::factory()->create([
            'reservation_date' => now()->addDays(1)->format('Y-m-d'),
            'start_time'       => '09:00',
            'end_time'         => '12:00',
        ]);

        $this->put("/reservation/{$reservation->id}", array_merge($reservation->toArray(), [
            'event_type' => 'Updated Event',
        ]))->assertRedirect('/reservation');
    }

    public function test_update_rejects_changing_date_to_the_past(): void
    {
        $this->actingAsStaff();

        $reservation = Reservation::factory()->create([
            'reservation_date' => now()->addDays(3)->format('Y-m-d'),
        ]);

        $this->put("/reservation/{$reservation->id}", array_merge($reservation->toArray(), [
            'reservation_date' => now()->subDay()->format('Y-m-d'),
        ]))->assertSessionHasErrors('reservation_date');
    }

    // =========================================================================
    // EDIT — view loads
    // =========================================================================

    public function test_edit_view_loads_for_valid_reservation(): void
    {
        $this->actingAsStaff();

        $reservation = Reservation::factory()->create();

        $this->get("/reservation/{$reservation->id}/edit")->assertOk();
    }
}
