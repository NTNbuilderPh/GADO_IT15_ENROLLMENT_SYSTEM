<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Student extends Authenticatable {
    protected $fillable = ['student_number', 'first_name', 'last_name', 'email', 'password'];
    protected $hidden = ['password'];

    public function courses() {
    return $this->belongsToMany(Course::class, 'course_student')->withTimestamps();
    }   
}
