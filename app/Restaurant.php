<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    //
    
    public function user(){
        return $this->belongsTo('App\User');
    }
        public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function rating(){
        return $this->hasMany('App\Rating');
    }


}
