<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'article';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'image_id', 'title', 'url', 'content', 'published_at', 'status', 'visits', 'hide_email', 'hide_name', 'disable_comments', 'reviewed'
    ];

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function image(){
        return $this->hasOne('App\Images', 'id', 'image_id');
    }
}
