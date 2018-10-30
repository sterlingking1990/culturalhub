<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tribe extends Model
{
    //

    public function users(){
    	return belongsToMany('users');
    }

    public function contents(){
    	return belongsToMany('topics');
    }
}

