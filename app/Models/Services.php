<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
    /*
    $table->id('serviceId');
    $table->string('serviceTitle');
    $table->string('serviceImage')->;
    */
    protected $primaryKey  = 'serviceId';
    protected $fillable = [
      'serviceTitle',
      'serviceImage',
      'serviceText',
      'serviceStatus',
    ];
}
