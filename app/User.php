<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'email', 'password', 'super', 'points'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userData(){
        return $this->hasOne('App\UserData', 'user_id', 'id');
    }

    public function pointsHistory(){
        return $this->hasMany('App\Points', 'user_id', 'id');
    }

    public function questions(){
        switch($this->type){
            case 'user' :
                return $this->hasMany('App\Questions', 'user_id', 'id');
                break;
            case 'consultant' :
                return $this->hasMany('App\Questions', 'consultant_id', 'id');
                break;
            default :
                return null;
            break;
        }
    }

    public function answers(){
        if($this->type == 'consultant'){
            return $this->hasMany('App\Answers', 'consultant_id', 'id');
        } else {
            return null;
        }
    }
}
