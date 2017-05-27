<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $fillable = [

        'website','facebook','twitter','linkedin',

    ];
    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
