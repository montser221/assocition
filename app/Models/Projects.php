<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Arrow;
use App\Models\DenoatePayDetail;
use App\Models\ProjectsCategories;
class Projects extends Model
{
    use HasFactory;
    protected $primaryKey  = 'projectId';
    protected $fillable = [
      'projectId',
      'projectName',
      'projectLocation',
      'projectCategoryId',
      'projectDesc',
      'projectIcon',
      'projectImage',
      'projectText',
      'projectStatus'
    ];
 
    public function denoate()
    {
      return $this->hasMany( DenoatePayDetail::class,'projectTable','projectId');
    } 

    public function pcategory()
    {
      return $this->hasMany(ProjectsCategories::class,'projectCategoryId','categoryId');
    }
    
    public function arrow()
    {
        return $this->hasMany(Arrow::class,'projectTable','projectId');  
    }

}
