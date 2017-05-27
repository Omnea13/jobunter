<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobSeeker extends Model
{
    public $table = 'jobseeker';

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function skills()
    {
    	 return $this->hasMany('App\Skill');
    }
}
