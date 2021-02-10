<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendace;
class AttendaceController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $allattendace = Attendace::latest()->paginate(5);
      return view('dashboard.attendace.index')->with(['allattendace'=>$allattendace]);
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
        'day'         => 'required|numeric',
        'startAt'     => 'required|date_format:H:i',
        'endAt'      => 'required|date_format:H:i',
    ]);
    // // create project instance
    $attendace = new Attendace;

    if($request->has('attendaceStatus')){
      $attendace->attendaceStatus = $request->input('attendaceStatus');
    }

    $attendace->day       = $request->input('day');
    $attendace->startAt   = $request->input('startAt');
    $attendace->endAt     = $request->input('endAt');
    $attendace->save();
    return redirect()->route('attendace.index')->with('success','تم أضافة وقت الدوام بنجاح  ');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $data = \DB::table('attendaces')
    ->select('*')
    ->where('attendaceId',$id)
    ->get();

    // $data = Attendace::find($id);
    return view('dashboard.attendace.edit')->with(['data'=>$data]);
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

    if($request->has('attendaceStatus'))
    {
      if($request->input('attendaceStatus')==1)
      {
        \DB::table('attendaces')
        ->where('attendaceId',$id)
        ->update([
          'attendaceStatus'=>1,
        ]);
      }
      else
      {
        \DB::table('attendaces')
        ->where('attendaceId',$id)
        ->update([
          'attendaceStatus'=>0,
        ]);
      }

    }

    \DB::table('attendaces')
    ->where('attendaceId',$id)
    ->update([
      'day'=>$request->input('day'),
      'startAt'=>$request->input('startAt'),
      'endAt'=>$request->input('endAt'),
    ]);

    return redirect()->route('attendace.index')->with('success','تم تحديث  أوقات الدوام بنجاح');
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
      \DB::table('attendaces')
      ->where('attendaceId',$id)
      ->delete();
    }
    return redirect()->route('attendace.index')->with('success','تم حذف وقت الدوام بنجاح');
  }
}
