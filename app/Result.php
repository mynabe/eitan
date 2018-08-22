<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    public function details()
    {
    	return $this->hasMany('App\Detail');
    }
}
