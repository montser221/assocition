<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
    use HasFactory;
    protected $primaryKey ='sId';
    protected $fillable = [
      'sName','sValue','sStatus','created_at','updated_at',
    ];
}
