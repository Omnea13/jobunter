<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function user()
    {
    	return $this->belongsTo("App\User");
    }

    public function jobs()
    {
    	return $this->hasMany('App\Job', 'user_id')->orderBy('created_at', 'DESC');
    }
}
