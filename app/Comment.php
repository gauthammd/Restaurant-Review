<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    public function restaurant(){
        return $this->belongsTo('App\Restaurant');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
