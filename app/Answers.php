<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question_id', 'consultant_id', 'answer', 'seen', 'ip', 'payroll_id', 'rated', 'rating', 'feedback'
    ];

    public function question(){
        return $this->hasOne('App\Questions', 'id', 'question_id');
    }

    public function consultant(){
        return $this->belongsTo('App\User', 'id', 'consultant_id');
    }

    public function payroll(){
        return $this->hasOne('App\Payroll', 'id', 'payroll_id');
    }
}
