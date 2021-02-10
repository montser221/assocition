<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $primaryKey  = 'settingId';
    protected $fillable = [
      'foundationName',
      'foundationTitle',
      'email',
      'phone1',
      'phone2',
      'phone3',
      'phoneNumber',
      'fax',
      'foundationLogo',
      'siteStatus',
      'jobsStatus',
      'keywords',
    ];
}
