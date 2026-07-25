<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddOn extends Model
{
    protected $table = "add_ons";
    protected $fillable = [
        'name',
        'description',
        'price',
        'is_active'
    ];

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'facility_add_ons');
    }

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'reservation_add_ons')
                    ->withPivot('quantity', 'unit_price')
                    ->withTimestamps();
    }
}
