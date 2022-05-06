<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name','active'];
    public function getActiveStatusAttribute()
    {
       return $this->active ? 'Active' : 'InActive';
    }
    public function productsthrough(){
        return $this->hasManyThrough(Product::class , SupCategory:: class , 'category_id','product_id');
    }
    public function supcategories(){
        return $this->hasmany(SupCategory::class,'category_id','id');
    }
}
