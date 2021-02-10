<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    use HasFactory;
    protected $primaryKey  ='pageId';
    protected $fillable = [
        'pageName','totalViews ','created_at','updated_at'
    ];
    public static function totalViews()
    { 
        return Pages::sum('totalViews');
    }

    public static function pageTotalViews($pageid=null)
    {
        if($pageid==null)
            return 0;
        else
        {
            
            return Pages::select('totalViews')->where('pageId',$pageid)->get();
        }
    }
}
