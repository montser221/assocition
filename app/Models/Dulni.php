<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dulni extends Model
{
    use HasFactory;
    /*
    name
    phone
    address
    details
    */
    protected $primaryKey  ='dulniId';
    protected $fillable = [
      'name','phone',
      'address','needy',
      'details'
    ];
}
