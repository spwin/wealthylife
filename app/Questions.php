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
        'user_id', 'consultant_id', 'question', 'status', 'ip', 'asked_at', 'answered_at', 'rejection', 'timer'
    ];

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function consultant(){
        return $this->hasOne('App\User', 'id', 'consultant_id');
    }

    public function images(){
        return $this->belongsToMany('App\Images', 'image_question', 'question_id', 'image_id')
            ->withPivot('sort')
            ->withTimestamps();
    }

    public function orders(){
        return $this->hasMany('App\Orders', 'question_id', 'id');
    }

    public function answer(){
        return $this->hasOne('App\Answers', 'question_id', 'id');
    }

    public function orderDrafts(){
        return $this->hasMany('App\OrderDrafts', 'question_id', 'id');
    }
}
