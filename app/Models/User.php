<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
        'role',
        'account_status'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->middle_name} {$this->last_name}");
    }

    protected static function scopeToRoles(array $roles, string $defaultRole): void
    {
        static::addGlobalScope('role', function (Builder $builder) use ($roles) {
            $builder->whereIn('role', $roles);
        });

        static::creating(function ($model) use ($defaultRole) {
            $model->role = $model->role ?: $defaultRole;
        });
    }


}
