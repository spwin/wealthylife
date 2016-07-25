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
        'question_id', 'consultant_id', 'answer', 'seen', 'ip'
    ];

    public function question(){
        return $this->hasOne('App\Questions', 'id', 'question_id');
    }

    public function consultant(){
        return $this->belongsTo('App\User', 'id', 'consultant_id');
    }
}
