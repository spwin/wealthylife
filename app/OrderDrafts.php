<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDrafts extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_drafts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'price', 'user_id', 'discount_id', 'question_id', 'points', 'to_pay', 'token', 'used'
    ];

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function discount(){
        return $this->hasOne('App\Discounts', 'id', 'discount_id');
    }

    public function question(){
        return $this->hasOne('App\Questions', 'id', 'discount_id');
    }
}
