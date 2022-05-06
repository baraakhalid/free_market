<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name','active'];

    public function getActiveStatusAttribute()
    {
       return $this->active ? 'Active' : 'InActive';
    }
    public function category(){
        return $this->belongsto(Category::class ,'category_id','id');
    }
    public function products(){
        return $this->hasmany(Product::class ,'sup_category_id','id');
    }
}
