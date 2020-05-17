<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Used to hold the data of a qoute
 */
class Qoute extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'qoute', 'author_name'
    ];
   
}
