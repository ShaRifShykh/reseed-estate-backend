<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'role_name', 'role',
        'password'
    ];

    protected $hidden = [
        'password',
    ];
}
