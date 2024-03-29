<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function favorites()
    {
        return $this->hasMany(Favorite::class ,'user_id','id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, Favorite::class,'user_id','product_id');
    }
    public function carts()
    {
        return $this->hasMany(Cart::class, 'user_id', 'id');
    }
    public function productscart()
    {
        return $this->belongsToMany(Product::class, Cart::class, 'user_id','product_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }
    public function addresses()
    {
        return $this->hasMany(Address::class, 'user_id', 'id');
    }
}
