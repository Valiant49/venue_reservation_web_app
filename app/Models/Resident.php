<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

#[Table(timestamps: false)]
class Resident extends User
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
        'block_num',
        'lot_num',
        'street_num',
        'contact_num',
        'account_status',
        'role',
    ];

    protected static function booted()
    {
        static::creating(function ($resident) {
            $resident->role = 'resident';
        });

        static::scopeToRoles(['resident'], 'resident');
    }
}
