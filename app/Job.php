<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function company()
    {
    	return $this->belongsTo('App\Company', 'id');
    }

    public function companyName()
    {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }
}