<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendace extends Model
{
    use HasFactory;
    protected $primaryKey  = 'attendaceId';
    protected$fillable = [
      'day','startAt','endAt','attendaceStatus',
    ];
}
