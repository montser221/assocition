<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageManagement extends Model
{
    use HasFactory;
    protected $primaryKey='imageId';
    protected $fillable =[
      'imageTitle','imageFile','imageStatus'
    ];
}
