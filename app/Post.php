<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
/*
    protected $table = 'posts';
        protected $fillable=['title','body','user_id','created_at','updated_at'];
*/
public function user(){
    return $this->belongsTo('App\User','user_id','id');
}
}
