<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Table(timestamps: false)]
class Facility extends Model
{
    protected $table = 'facility';
    protected $fillable = [
        'facility_code',
        'facility_name',
        'facility_type',
        'base_fee',
        'capacity',
        'description'
    ];



}
