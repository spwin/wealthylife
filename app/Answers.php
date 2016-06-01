<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    /*
    $table->increments('id');
            $table->integer('question_id')->nullable()->unsigned();
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->integer('consultant_id')->nullable()->unsigned();
            $table->foreign('consultant_id')->references('id')->on('users')->onDelete('set null');
            $table->text('answer');
            $table->string('ip');
    */
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
