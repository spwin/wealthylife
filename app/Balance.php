<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'balance';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'credits', 'before', 'after'
    ];

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
