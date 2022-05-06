<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;



class Vendor extends Authenticatable
{
    use HasFactory, HasRoles;
     
    public function products(){
        return $this ->hasmany(Product::class ,'vendor_id','id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    
}

