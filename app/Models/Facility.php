<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Table(timestamps: false)]
class Facility extends Model
{
    use HasFactory;

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
