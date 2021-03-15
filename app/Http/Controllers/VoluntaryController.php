<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voluntary;
use App\Models\Pages;
use App\Models\PagesViews;
class VoluntaryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $pageId   = 4;
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
      return view('pages.voluntary');
  }

  public function store(Request $request)
  {
    // return $request->all();
    $request->validate([
      'firstName'       => 'required|string',
      'fatherName'      => 'required|string',
      'grandFatherName' => 'required|string',
      'lastName'        => 'required|string',
      'socialState'     => 'required',
       'natonality'     => 'required|string',
      'email'           => 'required|email|unique:voluntaries',
      'ssnNumber'       => 'required|numeric',
      'bestContactTime' => 'required|string',
      'gender'          => 'required',
      'birthDate'       => 'required|date',
      'jobTitle'        => 'required|string',
      'jobEmployer'     => 'required|string',
      'address'         => 'required|string',
      'phone'           => 'required|numeric',
      'personalPhoto'   => 'required|image|mimes:png,jpg,jpeg,svg,gif',
      'cv'              => 'required|mimes:pdf,dox,docx',
      'typeOfService'  => 'required|max:100',
      
  ]);

    $payees = new Voluntary;
    if($request->file('personalPhoto'))
    {
      $path = \Storage::disk('public_path')->putFile('volnt', $request->file('personalPhoto'));
      $payees->personalPhoto=$path;
    }
    if($request->file('cv'))
    {
      $path = \Storage::disk('public_path')->putFile('volnt', $request->file('cv'));
      $payees->cv=$path;
    }
    if($request->has('typeOfService'))
    {
      $payees->typeOfService=$request->typeOfService;
    }
    $payees->firstName      = $request->input('firstName');
    $payees->fatherName     = $request->input('fatherName');
    $payees->grandFatherName = $request->input('grandFatherName');
    $payees->lastName       = $request->input('lastName');
    $payees->socialState      = $request->input('socialState');
    $payees->natonality      = $request->input('natonality');
    $payees->email           = $request->input('email');
    $payees->ssnNumber       = $request->input('ssnNumber');
    $payees->bestContactTime = $request->input('bestContactTime');
    $payees->birthDate       = $request->input('birthDate');
    $payees->jobTitle        = $request->input('jobTitle');
    $payees->gender          = $request->input('gender');
    $payees->jobEmployer     = $request->input('jobEmployer');
    $payees->address         = $request->input('address');
    $payees->phone           = $request->input('phone');
    $payees->save();
    return redirect()->route('voluntary.index')->with('success','تم   تسجيل  المتطوع بنجاح      ');
  }
}
