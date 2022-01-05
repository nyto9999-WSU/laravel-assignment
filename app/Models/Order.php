<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function aircons()
    {
        return $this->belongsToMany(Aircon::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function technicians()
    // {
    //     return $this->belongsToMany(User::class);
    // }
    public function job()
    {
        return $this->hasOne(Job::class);
    }

    public function getTechnician()
    {
       $tech_id = optional($this->job)->user_id;
       return User::find($tech_id);
    }


}
