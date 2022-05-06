<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;


use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasFactory ,HasRoles;
    public function getActiveStatusAttribute()
    {
        return $this->active ? 'Active' : 'Disabled';
    }
}

