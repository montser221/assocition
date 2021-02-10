<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DenoatePayDetail extends Model
{
    use HasFactory;
    protected $primaryKey  ='denoateId';
    protected $fillable = [
      'denoatePhone','projectTable',
      'paymentMethodTable','moneyValue',
      'kickbacks','denoateStatus','created_at','updated_at'
    ];

    protected $casts = [
      'created_at'=>'datetime:Y-m-d',
      'updated_at'=>'datetime:Y-m-d',
    ];
    // projects
    public function projects()
    {
    	return $this->belongsTo('App\Models\Projects','projectTable','projectId');
    }

    //pay methods
     public function pmethods()
    {
    	return $this->belongsTo('App\Models\PaymentMethod','paymentMethodTable','methodId');
    }
}
