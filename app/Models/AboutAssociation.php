<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutAssociation extends Model
{
    use HasFactory;
    protected $primaryKey ='associationId';
    protected $fillable = [
      'associationTitle','managerWord','showInHome','managerName','associationIcon'
    ];

}
