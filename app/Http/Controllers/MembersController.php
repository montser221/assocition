<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Member;
class MembersController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $allmembers = Member::all();
    return view('dashboard.members.index')->with(['allmembers'=>$allmembers]);
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
        'memberName'         => 'required|max:255',
        'shortText'         => 'required|max:255',
        'memberImage'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:14096',
    ]);
    // // create project instance
    $member = new Member;

    if($request->has('memberEmail'))
    {
        $member->memberEmail = $request->input('memberEmail');
    }
    if($request->has('memberPhone'))
    {
        $member->memberPhone = $request->input('memberPhone');
    }
    if($request->has('memberStatus'))
    {
        $member->memberStatus = $request->input('memberStatus');
    }


    if($request->file('memberImage')){
        $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('memberImage')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;

        $uploads_folder =  getcwd() .'/uploads/members/';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('memberImage')->move($uploads_folder,    $image_full_name);
        $image = Image::make( public_path("uploads/members/{$image_full_name}"))->fit(1200,1200);
        $image->save();
        $member->memberImage=$image_full_name;
    }

    $member->memberName      = $request->input('memberName');
    $member->shortText       = $request->input('shortText');
    $member->save();
    return redirect()->route('members.index')->with('success','تم أضافة   بيانات العضوء بنجاح ');

  }

 
  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $data = Member::find($id);
    return view('dashboard.members.edit')->with(['data'=>$data]);
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
        'memberName'         => 'required|max:255',
        'shortText'         => 'required|max:255',
     ]);

     if($request->has('memberStatus'))
     {
       if($request->input('memberStatus')==1)
       {
         \DB::table('members')
         ->where('memberId',$id)
         ->update([
           'memberStatus'=>1,
         ]);
       }
       else
       {
         \DB::table('members')
         ->where('memberId',$id)
         ->update([
           'memberStatus'=>0,
         ]);
       }

     }

      // upload project wrapper and store it in database
    if($request->file('memberImage'))
    {
        $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('memberImage')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;

        $uploads_folder =  getcwd() .'/uploads/members/';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('memberImage')->move($uploads_folder,    $image_full_name);
        $image = Image::make( public_path("uploads/members/{$image_full_name}"))->fit(1200,1200);
        $image->save();
        \DB::table('members')
        ->where('memberId',$id)
        ->update([
          'memberImage'=>$image_full_name,
        ]);
    }
    if($request->has('memberEmail'))
    {
      \DB::table('members')
    ->where('memberId',$id)
    ->update([
      'memberEmail'  =>$request->input('memberEmail'),
    ]);
         
    }
    if($request->has('memberPhone'))
    {
      \DB::table('members')
    ->where('memberId',$id)
    ->update([
      'memberPhone'  =>$request->input('memberPhone'),
    ]);
        
    }

    \DB::table('members')
    ->where('memberId',$id)
    ->update([
      'memberName'  =>$request->input('memberName'),
      'shortText' =>$request->input('shortText'),
    ]);

    return redirect()->route('members.index')->with('success','تم تحديث  بيانات العضوء بنجاح   ');
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
      \DB::table('members')
      ->where('memberId',$id)
      ->delete();
    }

    return redirect()->route('members.index')->with('success','تم حذف العضوء بنجاح  ');
  }
}
