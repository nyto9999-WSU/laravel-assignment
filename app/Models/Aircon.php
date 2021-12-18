<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aircon extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_aircons');
    }


}
