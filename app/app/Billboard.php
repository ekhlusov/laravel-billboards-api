<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billboard extends Model
{
    protected $fillable = ['city', 'address', 'description', 'coordinates'];
}
