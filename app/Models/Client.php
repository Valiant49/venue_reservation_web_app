<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Table(timestamps: false)]
class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';
    protected $fillable = [
        'block_num',
        'lot_num',
        'street_num',
        'first_name',
        'middle_name',
        'last_name',
        'contact_num',
        'email'
    ];
}
