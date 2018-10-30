<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopicDiscussion extends Model
{
    //

     protected $casts = [
        'tribes' => 'array'
    ];
}
