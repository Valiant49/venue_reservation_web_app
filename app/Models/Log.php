<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'entity_id',
        'entity_type',
        'action',
        'old_values',
        'new_values',
        'user_id',
        'user_name'
    ];

    protected $casts = [
      'old_values' => 'array',
      'new_values' => 'array'
    ];
}
