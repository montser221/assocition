<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OurGoals;
use App\Models\AboutAssociation;
use App\Models\Services;
use App\Models\Member;
use App\Models\Attendace;
use App\Models\Settings;
use App\Models\Pages;
use App\Models\PagesViews;

class aboutController extends Controller
{

    public function aboutus()
    {
      $pageId   = 2;
    $vistorIp = request()->ip();
   $pageTotalViews = Pages::pageTotalViews($pageId);
    // dd($pageTotalViews);
    if(PagesViews::is_unique_view($vistorIp,$pageId) === true)
    {
      PagesViews::Create([
        'pagesTable'=>$pageId,
        'visitorIp'=>$vistorIp,
      ]);
      \DB::table('pages')
        ->where('pageId',$pageId)
        ->update([
          'totalViews'=> 1,
          'updated_at'=>now(),
        ]);
    
    }
    else
    {
      // dd('bad');
    }
      $goals = OurGoals::all()->where('goalStatus',1);
      $members = Member::all()->where('memberStatus',1);
      $attendce = Attendace::all()->where('attendaceStatus',1);
      $aboutassociation = AboutAssociation::find(1);
      $services = Services::all();
      $setting     = Settings::find(1);
      return view('pages.aboutus')->with([
        'goals'       =>$goals,
        'aboutassociation'=>$aboutassociation,
        'services'=>$services,
        'members'=>$members,
        'attendce'=>$attendce,
        'data'=>$setting,
      ]);
    }

    
}
