<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'type',
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Admin()
    {
        return $this->hasMany('App\Admin');
    }
    
    public function company()
    {
        return $this->hasOne('App\Company');
    }

    public function socialmedia()
    {
        return $this->hasOne("App\social_media");
    }

    public function jobseeker()
    {
        return $this->hasOne('App\JobSeeker');
    }

    public function jobs()
    {
        return $this->hasMany('App\Job', 'user_id')->orderBy('created_at', 'DESC');
    }

    public function education()
    {
        return $this->hasMany('App\Education');
    }

    public function experience()
    {
        return $this->hasMany('App\Experience');
    }

    public function certificate()
    {
        return $this->hasMany('App\Certificate');
    }

    public function exams()
    {
        return $this->hasMany('App\Exam');
    }

    public function skills()
    {
        return $this->hasMany('App\Skill');
    }

    public function companyPayments()
    {
        return $this->hasMany('App\Payment');
    }
}