<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistics;
class StatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $statistics  = Statistics::all()->where('sStatus',1);
      return view('dashboard.statistics.index')->with([
        'statistics'=>$statistics,
      ]);
    }

    public function statistics()
    {
         $statistics  = Statistics::all();
          return view('dashboard.statistics.stat')->with([
        'statistics'=>$statistics,
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  `sId`, `sName`, `sValue`, `created_at`, `updated_at`
        $request->validate([
            'sName'=>'required|unique:statistics|max:255',
            'sValue'=>'required|numeric',
        ]);
        $statistics = new Statistics;
        if($request->has('sStatus')){
          $statistics->sStatus = 1;
        }
        $statistics->sName=$request->sName;
        $statistics->sValue=$request->sValue;
        $statistics->save();
         return redirect()->route('stat')->with('success','  تم أضافة الاحصائية بنجاح ');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data  = Statistics::find($id);
          return view('dashboard.statistics.edit')->with([
        'data'=>$data,
      ]);
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
         if($request->has('sStatus'))
        {     
          if($request->input('sStatus')==1)
          {
            \DB::table('statistics')
            ->where('sId',$id)
            ->update([
              'sStatus'=>1,
            ]);
          }
          else
          {
            \DB::table('statistics')
            ->where('sId',$id)
            ->update([
              'sStatus'=>0,
            ]);
          }

        }
          \DB::table('statistics')
    ->where('sId',$id)
    ->update([
      'sName'=>$request->input('sName'),
      'sValue'=>$request->input('sValue'),
    ]);

    return redirect()->route('stat')->with('success','تم تحديث   الاحصائية ' );
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
      \DB::table('statistics')
      ->where('sId',$id)
      ->delete();
    }
    return redirect()->route('stat')->with('success','تم حذف   الاحصائية بنجاح ');
  
    }
}
