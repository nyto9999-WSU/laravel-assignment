<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
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



    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function getTechnician()
    {
       $tech_name = optional($this->job)->tech_name;
       return  User::where('name', '=', $tech_name);
    }


}
