<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discounts extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'discounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'used', 'used_at', 'name', 'type', 'percent', 'fixed'
    ];

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function orderDrafts(){
        return $this->hasMany('App\OrderDrafts', 'discount_id', 'id');
    }
}
