<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Employee extends Authenticatable
{
    use HasApiTokens, HasRoles;

    protected $fillable = [
        'login',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $guard_name = 'web';

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
