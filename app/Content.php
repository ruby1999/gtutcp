<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    public function Category()
    {
    	return $this->belongsTo('App\Category','id');
    }
}