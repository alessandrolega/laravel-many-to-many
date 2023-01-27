<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'body',
        'category_id'
    ];

    public function Category(){
        return $this->belongsTo('App\Category');
    }
}
