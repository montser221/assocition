<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pdfFile;
class pdfFileController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $allfiles = pdfFile::latest()->paginate(10);
      return view('dashboard.files.index')->with(['allfiles'=>$allfiles]);
  }

 //all files
    public function allFiles ()
    {
      $files = pdfFile::all()->where('fileStatus',1);
      return view('pages.allFiles')->with([
        'files'=>$files,
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

    $request->validate([
        'fileTitle'     => 'required|unique:pdf_files',
        'imageFile'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2028',
        'pdfFile'       => 'required|mimes:pdf|max:20480',
    ]);
    // // create project instance
    $files = new pdfFile;

    if ($request->has('fileStatus'))
    {
      $files->fileStatus = $request->input('fileStatus');
    }

    //pdf file
    if($request->file('pdfFile')){

        $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('pdfFile')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;

        $uploads_folder =  getcwd() .'/uploads/files/';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('pdfFile')->move($uploads_folder,    $image_full_name);
        $files->pdfFile=$image_full_name;
    }
    // img file
    if($request->file('imageFile')){

        $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('imageFile')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;

        $uploads_folder =  getcwd() .'/uploads/files/';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('imageFile')->move($uploads_folder,    $image_full_name);
        $files->imageFile=$image_full_name;
    }

    $files->fileTitle   = $request->input('fileTitle');
    $files->save();
    return redirect()->route('files.index')->with('success','تم أضافة  الملف بنجاح');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $data = pdfFile::find($id);
    return view('dashboard.files.edit')->with(['data'=>$data]);
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

    if($request->file('pdfFile')){
        $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('pdfFile')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;

        $uploads_folder =  getcwd() .'/uploads/files';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('pdfFile')->move($uploads_folder,    $image_full_name);

        \DB::table('pdf_files')
        ->where('fileId',$id)
        ->update([
          'pdfFile'=>$image_full_name,
        ]);
    }

    if($request->file('imageFile')){
        $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('imageFile')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;

        $uploads_folder =  getcwd() .'/uploads/files';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('imageFile')->move($uploads_folder,    $image_full_name);
        \DB::table('pdf_files')
        ->where('fileId',$id)
        ->update([
          'imageFile'=>$image_full_name,
        ]);
    }

    if ($request->has('fileStatus'))
    {
      \DB::table('pdf_files')
      ->where('fileId',$id)
      ->update([
        'fileStatus'=>$request->input('fileStatus'),
      ]);
    }
    \DB::table('pdf_files')
    ->where('fileId',$id)
    ->update([
      'fileTitle'=>$request->input('fileTitle'),
    ]);

    return redirect()->route('files.index')->with('success','تم تحديث  الملف بنجاح');
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
      \DB::table('pdf_files')
      ->where('fileId',$id)
      ->delete();
    }
    return redirect()->route('files.index')->with('success','تم حذف الملف بنجاح  ');
  }
}
