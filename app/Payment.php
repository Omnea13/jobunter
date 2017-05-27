<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function company()
    {
    	return $this->belongsTo('App\User');
    }
}
