<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;
use Intervention\Image\Facades\Image;
class AgentsController extends Controller
{
  /*
  agentId
  agentImage
  agentStatus
  */
  public function index()
  {
      $allagents = Agent::all();
      return view('dashboard.agents.index')->with(['allagents'=>$allagents]);
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
        'agentName'     => 'required|unique:agents',
        'agentImage'    => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2028',
    ]);
    // // create project instance
    $agents = new Agent;

    if($request->file('agentImage')){

        $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('agentImage')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;

        $uploads_folder =  getcwd() .'/uploads/agents/';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('agentImage')->move($uploads_folder,    $image_full_name);
        // $image = Image::make( public_path("uploads/agents/{$image_full_name}"))->fit(800,800);
        // $image->save();
        $agents->agentImage=$image_full_name;
    }

    if ($request->has('agentStatus')) {
      $agents->agentStatus   = $request->input('agentStatus');
    }
    $agents->agentName   = $request->input('agentName');
    $agents->save();
    return redirect()->route('agents.index')->with('success','تم أضافة  العميل بنجاح');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $data = Agent::find($id);
    return view('dashboard.agents.edit')->with(['data'=>$data]);
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

    if($request->file('agentImage')){
        $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('agentImage')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;

        $uploads_folder =  getcwd() .'/uploads/agents';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('agentImage')->move($uploads_folder,    $image_full_name);
        // $image = Image::make( public_path("uploads/agents/{$image_full_name}"))->fit(800,800);
        // $image->save();
        \DB::table('agents')
        ->where('agentId',$id)
        ->update([
          'agentImage'=>$image_full_name,
        ]);
    }
    if ($request->has('agentStatus'))
    {
      \DB::table('agents')
      ->where('agentId',$id)
      ->update([
        'agentStatus'=>$request->input('agentStatus'),
      ]);
    }
    \DB::table('agents')
    ->where('agentId',$id)
    ->update([
      'agentName'=>$request->input('agentName'),
    ]);

    return redirect()->route('agents.index')->with('success','تم تحديث  بيانات العميل بنجاح');
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
      \DB::table('agents')
      ->where('agentId',$id)
      ->delete();
    }
    return redirect()->route('agents.index')->with('success','تم حذف العميل بنجاح ');
  }
}
