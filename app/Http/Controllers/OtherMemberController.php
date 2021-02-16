<?php

namespace App\Http\Controllers;
use App\Models\OtherMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class OtherMemberController extends Controller
{

    public function index()
    {
      $allfiles = OtherMember::latest()->paginate(10);
        return view('dashboard.otherfiles.index')->with(['allfiles'=>$allfiles]);
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
          'memName'        => 'required|unique:other_members',
          'memFile'        => 'required|mimes:pdf|max:14946',
      ]);
      // // create project instance
      $otherfiles = new OtherMember;
  
      if ($request->has('memStatus'))
      {
        $otherfiles->memStatus = $request->input('memStatus');
      }
  
      //pdf file
      if($request->file('memFile')){
        $path = Storage::putFile('otherfile', $request->file('memFile'));
          $otherfiles->memFile=$path;
      }

  
      $otherfiles->memName   = $request->input('memName');
      // $otherfiles->memEmail   = $request->input('memEmail');
      // $otherfiles->memPhone   = $request->input('memPhone');
      $otherfiles->save();
      return redirect()->route('otherfiles.index')->with('success','تم أضافة  الملف بنجاح');
    }
  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data = OtherMember::find($id);
      return view('dashboard.otherfiles.edit')->with(['data'=>$data]);
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
    
      if($request->file('memFile')){
        Storage::delete(OtherMember::find($id)->memFile);
        $path = Storage::putFile('otherfile', $request->file('memFile'));
          \DB::table('other_members')
          ->where('memId',$id)
          ->update([
            'memFile'=> $path ,
            ]);
      }
  
       
      if ($request->has('memStatus'))
      {
        \DB::table('other_members')
        ->where('memId',$id)
        ->update([
          'memStatus'=>$request->input('memStatus'),
        ]);
      }
      \DB::table('other_members')
      ->where('memId',$id)
      ->update([
        'memName'=>$request->input('memName'),
        // 'memEmail'=>$request->input('memEmail'),
        // 'memPhone'=>$request->input('memPhone'),
      ]);
  
      return redirect()->route('otherfiles.index')->with('success','تم تحديث  الملف بنجاح');
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
        Storage::delete(OtherMember::find($id)->memFile);
        \DB::table('other_members')
        ->where('memId',$id)
        ->delete();
      }
      return redirect()->route('otherfiles.index')->with('success','تم حذف الملف بنجاح  ');
    }
}
