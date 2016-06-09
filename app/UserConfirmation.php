<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserConfirmation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_confirmation_links';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'key'
    ];

    public function user(){
        return $this->belongsTo('App\User', 'id', 'user_id');
    }
}
