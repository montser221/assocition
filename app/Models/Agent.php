<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;
    protected $primaryKey = 'agentId';
    protected $fillable = [
      'agentName','agentImage','agentStatus',
    ];
}
