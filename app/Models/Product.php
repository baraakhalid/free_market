<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function vendor(){
        return $this->belongsto(Vendor::class ,'vendor_id','id');
    }
    public function supcategory(){
        return $this->belongsto(SupCategory::class ,'sup_category_id','id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, Favorite::class,'product_id','user_id');
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class ,'product_id','id');
    }
    public function getIsFavoriteAttribute(){
        if(auth('user')->check()){
            return $this->favorites()->where('user_id',auth('user')->id())->exists();
        }
        return false;
    }
    public function userscart()
    {
        return $this->belongsToMany(User::class, Cart::class, 'product_id', 'user_id');
    }
    public function carts()
    {
        return $this->hasMany(Cart::class, 'product_id', 'id');
    }
}
