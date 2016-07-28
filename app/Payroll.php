<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payroll';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'starts_at', 'ends_at', 'paid_at', 'current'
    ];

    public function answers(){
        return $this->hasMany('App\Answers', 'payroll_id', 'id');
    }
}
