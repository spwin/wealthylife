<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'question_id', 'status', 'braintree_id'
    ];

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function question(){
        return $this->hasOne('App\Questions', 'id', 'question_id');
    }
}
