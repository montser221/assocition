<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurGoals extends Model
{
    use HasFactory;
    protected $primaryKey  ='goalId';
    protected $fillable = [
      'goal','goalStatus'
    ];
}
