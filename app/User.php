<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
    
    public function restaurants(){
        return $this->hasMany('App\Restaurant');
    }
        public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function ratings(){
        return $this->hasMany('App\Rating');
    }
    public function roles(){
        return $this->hasOne('App\UserRole');
    }


}
