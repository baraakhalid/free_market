<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function orderproducts()
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, OrderProduct::class, 'order_id','product_id');
    }


    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
