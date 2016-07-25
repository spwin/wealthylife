<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'consultant_id', 'question', 'status', 'ip', 'image_id'
    ];

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function consultant(){
        return $this->hasOne('App\User', 'consultant_id', 'id');
    }

    public function image(){
        return $this->hasOne('App\Images', 'id', 'image_id');
    }

    public function orders(){
        return $this->hasMany('App\Orders', 'question_id', 'id');
    }

    public function answer(){
        return $this->hasOne('App\Answers', 'question_id', 'id');
    }
}
