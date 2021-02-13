<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainningSubscriber extends Model
{
    use HasFactory;
    protected $primaryKey ='subscriberId';
    protected $fillable = [
        'subscriberName',
        'subscriberEmail',
        'subscriberPhone',
        'subscriberBirthOfDate',
        'subscriberFamilyCard',
        'trainningCourseId'
    ];
}
