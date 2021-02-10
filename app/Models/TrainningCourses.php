<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainningCourses extends Model
{
    use HasFactory;
 
    protected $primaryKey = 'courseId';
    protected $fillable =[
        'courseName','courseDescription','courseContent',
        'courseImage','courseDate','courseLocation',
        'seatCount','courseStatus','created_at','updated_at'
    ];
}
