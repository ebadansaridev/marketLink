<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'username', 'password_hash', 'email',
        'contact_number', 'address', 'role',
        'is_active', 'is_approved',
    ];

    protected $hidden = ['password_hash', 'remember_token'];

    protected $casts = [
        'is_active' => 'boolean',
        'is_approved' => 'boolean',
    ];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    public function farmerProfile()
    {
        return $this->hasOne(FarmerProfile::class, 'user_id', 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'user_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'customer_id', 'user_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'customer_id', 'user_id');
    }
}