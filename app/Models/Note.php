<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
