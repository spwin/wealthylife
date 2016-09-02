<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phrases extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'phrases';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text', 'author', 'style', 'enabled'
    ];
}
