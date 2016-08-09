<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceSchemes extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'price_schemes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order', 'credits', 'price', 'questions', 'type', 'comment'
    ];

    public function orders(){
        return $this->hasMany('App\Orders', 'price_scheme_id', 'id');
    }

}
