<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    use HasFactory;
    protected $primaryKey  ='jobId';
    protected $fillable = [
      'fullname','age',
      'email','gender',
      'birthDate','job','cv','phone'
    ];
}
