<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'image_id', 'first_name', 'last_name', 'weight', 'height', 'about', 'birth_date', 'gender'
    ];

    public function user(){
        return $this->belongsTo('App\User', 'id', 'user_id');
    }

    public function image(){
        return $this->hasOne('App\Images', 'id', 'image_id');
    }
}
