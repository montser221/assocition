<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagesViews extends Model
{
    use HasFactory;
    /***    
     * pageViewsId
       visitorIp
       pagesTable
     */
    protected $primaryKey = 'pageViewsId';
    protected $fillable = [
        'visitorIp','pagesTable','created_at','updated_at'
    ];

    public static function is_unique_view ($visitorIp , $pageId)
    {
        $is_unique =  PagesViews::select('totalViews')->where([
            'visitorIp'  => $visitorIp,
            'pagesTable' => $pageId,
        ]);
        if($is_unique->count() > 0 )
            return false;
        else
        return true;
    }

}
