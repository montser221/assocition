<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OurGoals;
class OurGoalController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $allgoals = OurGoals::latest()->paginate(8);

    return view('dashboard.goals.index')->with(['allgoals'=>$allgoals]);
  }
// goal
// goalStatus

  public function store(Request $request)
  {

    $request->validate([
        'goal'         => 'required|unique:our_goals',
    ]);
    // // create project instance
    $goals = new OurGoals;
    //

    // check if project status checked or not
    if($request->has('goalStatus')){
        $goals->goalStatus = $request->input('goalStatus');
    }


    $goals->goal       = $request->input('goal');

    $goals->save();
    return redirect()->route('goals.index')->with('success','تم أضافة  اهدف بنجاح   ');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $data = OurGoals::find($id);
    return view('dashboard.goals.edit')->with(['data'=>$data]);
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
    // return $request->input('goalStatus');
      if($request->has('goalStatus'))
      {
        if($request->input('goalStatus')==1)
        {
          \DB::table('our_goals')
          ->where('goalId',$id)
          ->update([
            'goalStatus'=>1,
          ]);
        }
        else
        {
          \DB::table('our_goals')
          ->where('goalId',$id)
          ->update([
            'goalStatus'=>0,
          ]);
        }

      }


    \DB::table('our_goals')
    ->where('goalId',$id)
    ->update([
      'goal'=>$request->input('goal'),
    ]);

    return redirect()->route('goals.index')->with('success','تم تحديث  الاهداف بنجاح     ');
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
      \DB::table('our_goals')
      ->where('goalId',$id)
      ->delete();
    }
    return redirect()->route('goals.index')->with('success','تم حذف    الهدف بنجاح ');
  }
}
