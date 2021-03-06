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
        'user_id', 'question_id', 'status', 'braintree_id', 'price_scheme_id', 'voucher_id', 'type'
    ];

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function question(){
        return $this->hasOne('App\Questions', 'id', 'question_id');
    }

    public function priceScheme(){
        return $this->hasOne('App\PriceSchemes', 'id', 'price_scheme_id');
    }

    public function voucher(){
        return $this->hasOne('App\Voucheres', 'id', 'voucher_id');
    }
}
