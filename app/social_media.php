<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class social_media extends Model
{
    public function user()
    {
    	return $this->belongsTo("App\User");
    }
}