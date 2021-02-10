<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherMember extends Model
{
    use HasFactory;
    protected $primaryKey  ='memId';
    protected $fillable = [
      'memName','memEmail','memPhone','memStatus'
    ];
}
