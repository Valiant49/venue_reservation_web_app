<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Staff extends User
{
    protected $table = 'users';

    protected static function booted(): void
    {
        static::scopeToRoles(['staff', 'admin'], 'staff');
    }

    public function isAdmin():bool {
        return $this->role === 'admin';
    }
}
