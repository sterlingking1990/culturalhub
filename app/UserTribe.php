<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTribe extends Model
{
    //
      protected $casts = [
        'tribes' => 'array'
    ];
}
