<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    use HasFactory;
    use \Illuminate\Auth\Authenticatable;

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
