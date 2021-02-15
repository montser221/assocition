<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payee;
use App\Models\Pages;
use App\Models\PagesViews;

class BenfitController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $pageId   = 9;
    $vistorIp = request()->ip();
    $pageTotalViews = Pages::pageTotalViews($pageId);
    $total = 0;
   foreach($pageTotalViews as $to)
   {
     $total= $to->totalViews;
   }

    if(PagesViews::is_unique_view($vistorIp,$pageId) === true)
    {
      // PagesViews::Create([
      //   'pagesTable'=>$pageId,
      //   'visitorIp'=>$vistorIp,
      // ]);
      \DB::table('pages')
        ->where('pageId',$pageId)
        ->update([
          'totalViews'=> $total + 1,
          'updated_at'=>now(),
        ]);
    
    }
    else
    {
      // dd('bad');
    }
      return view('pages.benfit');
  }

  public function store(Request $request)
  {
   
    // return $request->all();
    $request->validate([
        'moneyNotify'     =>'required|image|mimes:jpeg,png,jpg|max:10000',
        'memberType'      =>'required|string',
        'firstName'       => 'required|string',
        'fatherName'      => 'required|string',
        'grandFatherName' => 'required|string',
        'lastName'        => 'required|string',
        'socialState'     => 'required',
        'natonality'     => 'required|string',
        'email'           => 'required|email|unique:payees',
        'ssnNumber'       => 'required|numeric',
        'bestContactTime' => 'required|string',
        'gender'          => 'required',
        'birthDate'       => 'required|date',
        'jobTitle'        => 'required|string',
        'jobEmployer'     => 'required|string',
        'address'         => 'required|string',
        'phone'           => 'required|numeric',
    ]);
    $payees = new Payee;

    if($request->file('moneyNotify'))
    {
      $path = \Storage::disk('public_path')->putFile('storage', $request->file('moneyNotify'));
      $payees->moneyNotify=$path;
      // $image = Image::make(Storage::path($path))->fit(1200,700);
      // $image->save();
    }

    $payees->firstName = $request->input('firstName');
    $payees->fatherName = $request->input('fatherName');
    $payees->grandFatherName = $request->input('grandFatherName');
    $payees->lastName = $request->input('lastName');
    $payees->socialState = $request->input('socialState');
    $payees->natonality = $request->input('natonality');
    $payees->email    = $request->input('email');
    $payees->ssnNumber = $request->input('ssnNumber');
    $payees->bestContactTime = $request->input('bestContactTime');
    $payees->birthDate = $request->input('birthDate');
    $payees->jobTitle      = $request->input('jobTitle');
    $payees->gender   = $request->input('gender');
    $payees->jobEmployer      = $request->input('jobEmployer');
    $payees->address      = $request->input('address');
    $payees->phone    = $request->input('phone');
    $payees->memberType    = $request->input('memberType');
    $payees->save();
    return redirect()->route('benfit.index')->with('success','تم    تقديم الطلب  بنجاح   ');
  }


}
