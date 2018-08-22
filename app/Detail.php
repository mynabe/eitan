<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    public function vocabularies()
    {
    	return $this->belongsTo('App\vocabulary');
    }

    public function results()
    {
    	return $this->belongsTo('App\Result');
    }
}
