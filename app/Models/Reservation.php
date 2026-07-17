<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Override;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $table = "reservations";
    protected $fillable = [
        'reservation_code',
        'reservation_date',
        'start_time',
        'end_time',
        'total_fee',
        'created_at',
        'updated_at',
        'guest_count',
        'status',
        'event_type',
        'notes',
        'facility_id',
        'reserved_by',
        'facilitated_by'
    ];

    #[Override]
    protected static function booted()
    {
        static::creating(function($reservation){
            if(empty($reservation->reservation_code)){
                $reservation->reservation_code = "RES-" . strtoupper(Str::random(5));
            }

            if (empty($reservation->facilitated_by)){
                $reservation->facilitated_by = Auth::id();
            }
        });
    }

    public function facility() {
        return $this->belongsTo(Facility::class, 'facility_id');
    }

    public function resident() {
        return $this->belongsTo(Resident::class, 'reserved_by');
    }
}
