<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Table(timestamps: false)]
class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'description',
        'reservation_type',
        'facility_status',
        'base_fee',
        'starting_hours',
        'closing_hours',
        'max_capacity',
        'max_reservation_duration',
    ];
}
