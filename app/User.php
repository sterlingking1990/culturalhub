<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tribes_following(){
        return belongsToMany('tribes');
    }

    public function contents_created(){
        return hasMany('content_users');
    }

    public function comments(){
        return $this->hasMany('comment_discussions');
    }

    public function follows(){
        return $this->hasMany('App\UserFollow');
    }


}
