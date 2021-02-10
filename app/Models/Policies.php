<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policies extends Model
{
    use HasFactory;
    protected $primaryKey ='policyId';
    protected $fillable = [
      'policyTitle','policyLevel','policyImage','policyFile','showInHome','policyStatus','policyText'
    ];

}
