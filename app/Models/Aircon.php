<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aircon extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $guarded = [];


    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

}
