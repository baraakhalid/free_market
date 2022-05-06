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
}
