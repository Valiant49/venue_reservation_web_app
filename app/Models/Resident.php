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

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->fillable = array_merge($this->fillable, [
            'block_num',
            'lot_num',
            'street_num',
            'contact_num',
            'account_status'
            ]);
    }

    protected static function booted()
    {
        static::scopeToRoles(['resident'], 'resident');
    }
}
