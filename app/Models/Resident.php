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
        'block_num',
        'lot_num',
        'street_num',
        'contact_num',
        'account_status'
    ];

    protected static function booted()
    {
        static::addGlobalScope('role', function (Builder $builder) {
            $builder->where('role', 'resident');
        });

        // ensures new Resident::create() records save as resident role automatically
        static::creating(function ($model) {
            $model->role = 'resident';
        });
    }
}
