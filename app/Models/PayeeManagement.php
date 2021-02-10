<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayeeManagement extends Model
{
    use HasFactory;
    /*
    pId
    pName
    healthState
    ssnNumber
    gender
    pStatus
    */
    protected $primaryKey = 'pId';
    protected $fillable   = [
      'pName','healthState','ssnNumber','gender','pStatus',
    ];
}
