<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fact extends Model
{
    //
    protected $casts = [
        'places' => 'array'
    ];
}
