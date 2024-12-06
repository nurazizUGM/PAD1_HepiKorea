<?php

namespace App\Models;

use App\Enums\Role;
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
        'role',
        'is_verified',
        'google_id',
        'gender',
        'date_of_birth',
    ];

    protected $hidden = ['password'];

    protected $casts = ['password' => 'hashed', 'role' => Role::class];

    public static $guestEmail = 'guest@guest.com';

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function isAdmin()
    {
        return $this->role == Role::ADMIN;
    }

    public function isCustomer()
    {
        return $this->role == Role::USER;
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
