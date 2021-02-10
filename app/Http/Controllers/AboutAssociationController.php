<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutAssociation;
use Intervention\Image\Facades\Image;
class AboutAssociationController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $allaboutassoiation = AboutAssociation::latest()->paginate(5);
      return view('dashboard.aboutassoiation.index')->with(['allaboutassoiation'=>$allaboutassoiation]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
// 'associationTitle','managerWord','showInHome','managerName','associationIcon'
    $request->validate([
        'associationTitle'     => 'required',
        'managerName'          => 'required',
        'managerWord'          => 'required',
        'vison'                => 'required',
        'message'              => 'required',
       'associationIcon'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2028',
       'visonIcon'             => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2028',
       'messageIcon'           => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2028',

    ]);
    // check if project status checked or not
    $AboutAssociation = new AboutAssociation;
    if($request->has('associationStatus'))
    {
         $AboutAssociation->associationStatus = $request->input('associationStatus');
    }

    if($request->has('showInHome'))
    {
         $AboutAssociation->showInHome =1;
    }

    // // create project instance
    //Store association Icon
    if($request->file('associationIcon')){

        $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('associationIcon')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;

        $uploads_folder =  getcwd() .'/uploads/aboutassoiation/';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('associationIcon')->move($uploads_folder,    $image_full_name);
        $image = Image::make( public_path("uploads/aboutassoiation/{$image_full_name}"))->fit(800,800);
        $image->save();
        $AboutAssociation->associationIcon=$image_full_name;
    }
    //store vison icon
    if($request->file('visonIcon')){

        $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('visonIcon')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;

        $uploads_folder =  getcwd() .'/uploads/aboutassoiation/';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('visonIcon')->move($uploads_folder,    $image_full_name);
        $image = Image::make( public_path("uploads/aboutassoiation/{$image_full_name}"))->fit(800,800);
        $image->save();
        $AboutAssociation->visonIcon=$image_full_name;
    }
    //Store message Icon
    if($request->file('messageIcon')){

        $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('messageIcon')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;

        $uploads_folder =  getcwd() .'/uploads/aboutassoiation/';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('messageIcon')->move($uploads_folder,    $image_full_name);
        $image = Image::make( public_path("uploads/aboutassoiation/{$image_full_name}"))->fit(800,800);
        $image->save();
        $AboutAssociation->messageIcon=$image_full_name;
    }


    $AboutAssociation->associationTitle = $request->input('associationTitle');
    $AboutAssociation->managerName      = $request->input('managerName');
    $AboutAssociation->managerWord      = $request->input('managerWord');
    $AboutAssociation->vison            = $request->input('vison');
    $AboutAssociation->message          = $request->input('message');
    $AboutAssociation->save();
    return redirect()->route('aboutassoiation.index')->with('success','تم أضافة بيانات الجمعية بنجاح');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $data = AboutAssociation::find($id);
    return view('dashboard.aboutassoiation.edit')->with(['data'=>$data]);
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
    if($request->has('associationStatus')){

        \DB::table('about_associations')
        ->where('associationId',$id)
        ->update([
          'associationStatus'=>$request->input('associationStatus'),
        ]);
    }

    if($request->has('showInHome') ){
      // if($request->input('showInHome')=)
      \DB::table('about_associations')
      ->where('associationId',$id)
      ->update([
        'showInHome'=>1,
      ]);
    }
    else
    {
      \DB::table('about_associations')
      ->where('associationId',$id)
      ->update([
        'showInHome'=>0,
      ]);
    }
    //update vison icon
    if($request->file('visonIcon')){
      \Storage::delete(AboutAssociation::find($id)->visonIcon);
        $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('visonIcon')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;

        $uploads_folder =  getcwd() .'/uploads/aboutassoiation';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('visonIcon')->move($uploads_folder,    $image_full_name);
        $image = Image::make( public_path("uploads/aboutassoiation/{$image_full_name}"))->fit(800,800);
        $image->save();
        \DB::table('about_associations')
        ->where('associationId',$id)
        ->update([
          'visonIcon'=>$image_full_name,
        ]);
    }
    //update message Icon
    if($request->file('messageIcon')){
      \Storage::delete(AboutAssociation::find($id)->messageIcon);
        $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('messageIcon')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;

        $uploads_folder =  getcwd() .'/uploads/aboutassoiation';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('messageIcon')->move($uploads_folder,    $image_full_name);
        $image = Image::make( public_path("uploads/aboutassoiation/{$image_full_name}"))->fit(800,800);
        $image->save();
        \DB::table('about_associations')
        ->where('associationId',$id)
        ->update([
          'messageIcon'=>$image_full_name,
        ]);
    }
    if($request->file('associationIcon')){
      \Storage::delete(AboutAssociation::find($id)->associationIcon);
        $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('associationIcon')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;

        $uploads_folder =  getcwd() .'/uploads/aboutassoiation';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('associationIcon')->move($uploads_folder,    $image_full_name);
        $image = Image::make( public_path("uploads/aboutassoiation/{$image_full_name}"))->fit(800,800);
        $image->save();
        \DB::table('about_associations')
        ->where('associationId',$id)
        ->update([
          'associationIcon'=>$image_full_name,
        ]);
    }

    \DB::table('about_associations')
    ->where('associationId',$id)
    ->update([
      'associationTitle'=>$request->input('associationTitle'),
      'managerName'=>$request->input('managerName'),
      'managerWord'=>$request->input('managerWord'),
      'vison'=>$request->input('vison'),
      'message'=>$request->input('message'),
    ]);

    return redirect()->route('aboutassoiation.index')->with('success','تم تحديث  بيانات طريقة الدفع بنجاح');
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
      \DB::table('about_associations')
      ->where('associationId',$id)
      ->delete();
    }
    return redirect()->route('aboutassoiation.index')->with('success','تم حذف طريقة الدفع بنجاح ');
  }
}
