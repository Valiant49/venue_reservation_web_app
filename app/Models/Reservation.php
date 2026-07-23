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

    const UPDATED_AT = null;

    protected $table = "reservations";
    protected $fillable = [
        'code',
        'date',
        'start_time',
        'end_time',
        'total_fee',
        'guest_count',
        'event_type',
        'status',
        'notes',
        'created_at',
        'last_updated',
        'facility_id',
        'reserved_by',
        'facilitated_by'
    ];

    #[Override]
    protected static function booted()
    {
        static::creating(function($reservation){
            if(empty($reservation->code)){
                $reservation->code = "RES-" . strtoupper(Str::random(5));
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
