<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'seen', 'body', 'importance', 'type', 'subject', 'email'
    ];

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
