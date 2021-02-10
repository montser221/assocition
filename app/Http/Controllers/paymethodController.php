<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\Settings;
use App\Models\Pages;
use App\Models\PagesViews;

class paymethodController extends Controller
{
  // Our paymethod page
  public function paymethod()
  {
    $pageId   = 11;
    $vistorIp = request()->ip();
   $pageTotalViews = Pages::pageTotalViews($pageId);
    // dd($pageTotalViews);
    if(PagesViews::is_unique_view($vistorIp,$pageId) === true)
    {
      // PagesViews::Create([
      //   'pagesTable'=>$pageId,
      //   'visitorIp'=>$vistorIp,
      // ]);
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
    $paymethod = PaymentMethod::all()->where('methodStatus',1);
    $setting     = Settings::find(1);

    return view('pages.paymethod')->with([
      'paymethod'=>$paymethod,
        'data'=>$setting,
    ]);
  }
}
