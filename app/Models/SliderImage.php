<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderImage extends Model
{
    use HasFactory;
    protected $primaryKey = 'sliderId';
    protected $fillable = [
        'sliderTitle',
        'sliderImage',
        'sliderText',
        'sliderLink',
        'sliderBtnText',
        'sliderStatus'
    ];
}
