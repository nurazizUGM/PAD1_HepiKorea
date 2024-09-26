<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'email',
        'password',
        'phone',
        'photo',
        'province',
        'city',
        'address',
        'postal_code',
        'role',
        'is_verified',
    ];

    protected $hidden = ['password'];

    protected $casts = ['password' => 'hashed'];
}
