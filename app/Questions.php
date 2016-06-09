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
        return $this->belongsTo('App\User', 'id', 'user_id');
    }

    public function consultant(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function image(){
        return $this->hasOne('App\Images', 'id', 'image_id');
    }
}
