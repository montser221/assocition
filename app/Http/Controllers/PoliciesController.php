<?php

namespace App\Http\Controllers;
use Response;
use Illuminate\Http\Request;
use App\Models\Policies;
class PoliciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    // return  Response::make(file_get_contents( "http://localhost/albr/public/storage/uploads/policies/") ,200 ,
      // ['Content-Disposition'=>'inline',
      // 'Content-Type'=>'application/pdf','filename'=>'1607431923794579655725.pdf']);
    // echo storage_path();
      $allpolicies = Policies::latest()->paginate(8);
        return view('dashboard.policies.index')->with(['allpolicies'=>$allpolicies]);
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
          'policyTitle'        => 'required|unique:policies|max:255',
          'policyLevel'        => 'required',
          'policyFile'         => 'required|mimes:pdf',

      ]);
      // create project instance
      $policy = new Policies;

      // check if policy status checked or not
      if($request->has('policyStatus')){
          $policy->policyStatus=1;
      }

      if($request->has('showInHome')){
          $policy->showInHome=1;
      }

      if($request->has('policyText')){
          $policy->policyText=$request->input('policyText');
      }

      if($request->file('policyImage')){
        // upload project icon and store it in database
          $image_name = time() . rand(1,1000000000000);
          $image_ext = $request->file('policyImage')->getClientOriginalExtension(); // example: png, jpg ... etc
          $image_full_name = $image_name . '.' . $image_ext;
          // dd($image_full_name);
          $uploads_folder =  getcwd() .'/uploads/policies';
          if (!file_exists($uploads_folder)) {
              mkdir($uploads_folder, 0777, true);
          }
          $request->file('policyImage')->move($uploads_folder,$image_full_name);
          $policy->policyImage=$image_full_name;
      }

      if($request->file('policyFile')){
        // upload project icon and store it in database
          $image_name = time() . rand(1,1000000000000);
          $image_ext = $request->file('policyFile')->getClientOriginalExtension(); // example: png, jpg ... etc
          $image_full_name = $image_name . '.' . $image_ext;
          // dd($image_full_name);
          $uploads_folder =  getcwd() .'/uploads/policies';
          if (!file_exists($uploads_folder)) {
              mkdir($uploads_folder, 0777, true);
          }
          $request->file('policyFile')->move($uploads_folder,$image_full_name);
          $policy->policyFile=$image_full_name;
      }

      $policy->policyLevel       = $request->input('policyLevel');
      $policy->policyTitle       = $request->input('policyTitle');
      $policy->save();
      return redirect()->route('policies.index')->with('success','تم أضافة السياسة بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data = Policies::find($id);
      return view('dashboard.policies.edit')->with(['data'=>$data]);
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

      // check if policyStatus   checked or not
      if($request->has('policyStatus') )
      {
        \DB::table('policies')
        ->where('policyId',$id)
        ->update([
          'policyStatus'=>1,
        ]);
      }
      else
      {
        \DB::table('policies')
        ->where('policyId',$id)
        ->update([
          'policyStatus'=>0,
        ]);
      }
      // check if showInHome   checked or not
      if($request->has('showInHome') )
      {
        \DB::table('policies')
        ->where('policyId',$id)
        ->update([
          'showInHome'=>1,
        ]);
      }
      else
      {
        \DB::table('policies')
        ->where('policyId',$id)
        ->update([
          'showInHome'=>0,
        ]);
      }

      if($request->file('policyFile')){
        // upload project icon and store it in database
          $image_name = time() . rand(1,1000000000000);
          $image_ext = $request->file('policyFile')->getClientOriginalExtension(); // example: png, jpg ... etc
          $image_full_name = $image_name . '.' . $image_ext;
          // dd($image_full_name);
          $uploads_folder =  getcwd() .'/uploads/policies';
          if (!file_exists($uploads_folder)) {
              mkdir($uploads_folder, 0777, true);
          }
          $request->file('policyFile')->move($uploads_folder,$image_full_name);
          \DB::table('policies')
          ->where('policyId',$id)
          ->update([
            'policyFile'=>$image_full_name,
          ]);

      }
      if($request->file('policyImage')){
        // upload project icon and store it in database
          $image_name = time() . rand(1,1000000000000);
          $image_ext = $request->file('policyImage')->getClientOriginalExtension(); // example: png, jpg ... etc
          $image_full_name = $image_name . '.' . $image_ext;
          // dd($image_full_name);
          $uploads_folder =  getcwd() .'/uploads/policies';
          if (!file_exists($uploads_folder)) {
              mkdir($uploads_folder, 0777, true);
          }
          $request->file('policyImage')->move($uploads_folder,$image_full_name);
          \DB::table('policies')
          ->where('policyId',$id)
          ->update([
            'policyImage'=>$image_full_name,
          ]);

      }
      //   'policyTitle','policyLevel','policyImage','policyFile','showInHome','policyStatus','policyText'

      \DB::table('policies')
      ->where('policyId',$id)
      ->update([
        'policyTitle'=>$request->input('policyTitle'),
        'policyLevel'=>$request->input('policyLevel'),
      ]);

      return redirect()->route('policies.index')->with('success','تم تحديث  السياسة بنجاح   ');
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
        \DB::table('policies')
        ->where('policyId',$id)
        ->delete();
      }
      return redirect()->route('policies.index')->with('success','تم حذف السياسة بنجاح ');
    }
}
