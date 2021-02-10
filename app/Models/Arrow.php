<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arrow extends Model
{
    use HasFactory;
    protected $primaryKey  = 'arrowId';
    protected$fillable = [
      'arrowName','arrowValue','created_at','updated_at','projectTable'
    ];

    public function project()
    {
       return $this->belongsTo('App\Models\Projects','projectTable','projectId'); 
    }
}
