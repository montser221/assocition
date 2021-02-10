<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services;
class ServicesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $allservices = Services::all();
      return view('dashboard.services.index',)->with(['allservices'=>$allservices]);
  }

  public function get_project_data()
  {
    $serviceData = Services::all();
    return response()->json(['projectData'=>$serviceData]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $request->validate([
        'serviceTitle'        => 'required|unique:services|max:255',
        'serviceText'          => 'required',
        'serviceImage'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
    // create project instance
    $service = new Services;

    // check if project status checked or not
    if($request->has('serviceStatus')){
        $service->serviceStatus=1;
    }

    if($request->file('serviceImage')){
      // upload project icon and store it in database
        $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('serviceImage')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;
        // dd($image_full_name);
        $uploads_folder =  getcwd() .'/uploads/services';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('serviceImage')->move($uploads_folder,$image_full_name);
        $service->serviceImage=$image_full_name;
    }

    $service->serviceTitle       = $request->input('serviceTitle');
    $service->serviceText       = $request->input('serviceText');
    $service->save();
    return redirect()->route('services.index')->with('success','تم أضافة الخدمة بنجاح');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $data = Services::find($id);
    return view('dashboard.services.edit')->with(['data'=>$data]);
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
    // check if project status checked or not
    if($request->has('serviceStatus') )
    {
      \DB::table('services')
      ->where('serviceId',$id)
      ->update([
        'serviceStatus'=>1,
      ]);
    }
    else
    {
      \DB::table('services')
      ->where('serviceId',$id)
      ->update([
        'serviceStatus'=>0,
      ]);
    }

    if($request->file('serviceImage')){
      // upload project icon and store it in database
        $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('serviceImage')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;
        // dd($image_full_name);
        $uploads_folder =  getcwd() .'/uploads/services';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('serviceImage')->move($uploads_folder,$image_full_name);
        \DB::table('services')
        ->where('serviceId',$id)
        ->update([
          'serviceImage'=>$image_full_name,
        ]);

    }

    \DB::table('services')
    ->where('serviceId',$id)
    ->update([
      'serviceTitle'=>$request->input('serviceTitle'),
      'serviceText'=>$request->input('serviceText'),
    ]);

    return redirect()->route('services.index')->with('success','تم تحديث  الخدمة بنجاح   ');
        // return $request->all();
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
      \DB::table('services')
      ->where('serviceId',$id)
      ->delete();
    }
    return redirect()->route('services.index')->with('success','تم حذف الخدمة بنجاح ');
  }
}
