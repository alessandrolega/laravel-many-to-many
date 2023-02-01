<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'body',
        'category_id',
        'cover'
    ];

    public function Category(){
        return $this->belongsTo('App\Category');
    }

    public function Tags(){
        return $this->belongsToMany('App\Tag');
    }
}
