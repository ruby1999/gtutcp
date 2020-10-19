<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    // public function Category()
    // {
    // 	return $this->belongsTo('App\Category','id');
    // }
    public $table = 'content';  

    public function Category()
    {
    	return $this->belongsToMany('App\Category');
    }

    public function tags()
    {
    	return $this->belongsToMany('App\Tag');
    }
}
