<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function exams()
    {
    	return $this->hasMany('App\Exam');
    }

    public function courses()
    {
        return $this->hasMany('App\Course');
    }

    public function skill()
    {
    	return $this->hasMany('App\Skill', 'category_id', 'id');
    }
}
