<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vouchers extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vouchers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'receiver_email', 'code', 'url_key', 'price', 'credits', 'message', 'anonymous', 'status'
    ];

    public function user(){
        return $this->belongsTo('App\User', 'id', 'user_id');
    }

    public function orders(){
        return $this->hasMany('App\Orders', 'voucher_id', 'id');
    }
}
