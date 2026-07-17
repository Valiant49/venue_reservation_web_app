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
        'code',
        'name',
        'category',
        'base_fee',
        'max_capacity',
        'description'
    ];
}
