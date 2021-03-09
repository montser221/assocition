<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use \Image;
class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $allSettings = Settings::all();
      $data = Settings::find(1);
      // dd($data);
      return view('dashboard.settings.index')->with(['allSettings'=>$allSettings,'data'=>$data]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
// return $request->all();
      $request->validate([
          'foundationName'         => 'required|max:255',
          'foundationTitle'         => 'required|max:255',
          'phoneNumber'            => 'required|numeric',
           'email'                   => 'required|unique:settings',
          'foundationLogo'          => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',

      ]);
      // // create project instance
      $setting = new Settings;
      if($request->has('siteStatus')){
          $setting->siteStatus = $request->input('siteStatus');
      }

      if($request->has('jobsStatus'))
      {
         $setting->jobsStatus = $request->input('jobsStatus');

      }
      if($request->has('phone1'))
      {
          $setting->phone1 = $request->input('phone1');
      }
      if($request->has('phone2'))
      {
          $setting->phone2 = $request->input('phone2');
      }
      if($request->has('phone3'))
      {
          $setting->phone3 = $request->input('phone3');
      }
      if($request->has('fax'))
      {
          $setting->fax = $request->input('fax');
      }

      if($request->has('keywords'))
      {
          $setting->keywords = $request->input('keywords');
      }

      if($request->file('foundationLogo')){
          $image_name = time() . rand(1,1000000000000);
          $image_ext = $request->file('foundationLogo')->getClientOriginalExtension(); // example: png, jpg ... etc
          $image_full_name = $image_name . '.' . $image_ext;

          $uploads_folder =  getcwd() .'/uploads/settings';
          if (!file_exists($uploads_folder)) {
              mkdir($uploads_folder, 0777, true);
          }
          $request->file('foundationLogo')->move($uploads_folder,    $image_full_name);
          // $image = Image::make( public_path("uploads/settings/{$image_full_name}"))->fit(1200,1200);
          // $image->save();
          $setting->foundationLogo=$image_full_name;
      }

      $setting->foundationName       = $request->input('foundationName');
      $setting->foundationTitle      = $request->input('foundationTitle');
      $setting->phoneNumber          =   $request->input('phoneNumber');
      $setting->email                = $request->input('email');
      $setting->save();
      return redirect()->route('settings.index')->with('success','تم أضافة   بيانات الموقع بنجاح ');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data = Settings::find($id);
      return view('dashboard.settings.edit')->with(['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      $request->validate([
          'foundationName'         => 'required|max:255',
          'foundationTitle'         => 'required|max:255',
          'phoneNumber'            => 'required|numeric',
           'email'                   => 'required',
          // 'foundationLogo'          => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',

      ]);
        if($request->has('siteStatus'))
        {
          if($request->input('siteStatus')==1)
          {
            \DB::table('settings')
            ->where('settingId',$id)
            ->update([
              'siteStatus'=>1,
            ]);
          }
          else
          {
            \DB::table('settings')
            ->where('settingId',$id)
            ->update([
              'siteStatus'=>0,
            ]);
          }

        }
        //jobs status
        if($request->has('jobsStatus'))
        {
          if($request->input('jobsStatus')==1)
          {
            \DB::table('settings')
            ->where('settingId',$id)
            ->update([
              'jobsStatus'=>1,
            ]);
          }
          else
          {
            \DB::table('settings')
            ->where('settingId',$id)
            ->update([
              'jobsStatus'=>0,
            ]);
          }

        }

      if($request->has('phone1'))
      {
          \DB::table('settings')
          ->where('settingId',$id)
          ->update([
            'phone1'=>$request->input('phone1'),
          ]);
      }

      if($request->has('phone2'))
      {
          \DB::table('settings')
          ->where('settingId',$id)
          ->update([
            'phone2'=>$request->input('phone2'),
          ]);
      }

      if($request->has('phone3'))
      {
          \DB::table('settings')
          ->where('settingId',$id)
          ->update([
            'phone3'=>$request->input('phone3'),
          ]);
      }

      if($request->has('fax'))
      {
          \DB::table('settings')
          ->where('settingId',$id)
          ->update([
            'fax'=>$request->input('fax'),
          ]);
      }

      if($request->has('keywords'))
      {
          \DB::table('settings')
          ->where('settingId',$id)
          ->update([
            'keywords'=>$request->input('keywords'),
          ]);
      }
        // upload project wrapper and store it in database
      if($request->file('foundationLogo'))
      {
          $image_name = time() . rand(1,1000000000000);
          $image_ext = $request->file('foundationLogo')->getClientOriginalExtension(); // example: png, jpg ... etc
          $image_full_name = $image_name . '.' . $image_ext;

          $uploads_folder =  getcwd() .'/uploads/settings';
          if (!file_exists($uploads_folder)) {
              mkdir($uploads_folder, 0777, true);
          }
          $request->file('foundationLogo')->move($uploads_folder,    $image_full_name);
          $image = Image::make( public_path("uploads/settings/{$image_full_name}"))->fit(1200,1200);
          $image->save();
          \DB::table('settings')
          ->where('settingId',$id)
          ->update([
            'foundationLogo'=>$image_full_name,
          ]);
      }


      \DB::table('settings')
      ->where('settingId',$id)
      ->update([
        'foundationName'  =>$request->input('foundationName'),
        'foundationTitle' =>$request->input('foundationTitle'),
        'phoneNumber'     =>$request->input('phoneNumber'),
        'email'           =>$request->input('email'),
      ]);

      return redirect()->route('settings.index')->with('success','تم تحديث  الاعدادات بنجاح   ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // delete project by id
      if(intval($id)){
        \DB::table('settings')
        ->where('settingId',$id)
        ->delete();
      }

      return redirect()->route('users.index')->with('success','تم حذف الاعدادات بنجاح  ');
    }
}
