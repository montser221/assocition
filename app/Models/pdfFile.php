<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pdfFile extends Model
{
    use HasFactory;


    protected $primaryKey  = 'fileId';
    protected $fillable = [
      'fileTitle',
      'imageFile',
      'pdfFile',
      'fileStatus'
    ];
}
