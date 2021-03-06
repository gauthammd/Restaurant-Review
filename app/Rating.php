<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function restaurant(){
        return $this->belongsTo('App\Restaurant');
    }

}
