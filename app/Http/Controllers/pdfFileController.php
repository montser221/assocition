<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\pdfFile;
use Storage;
use Image;
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
        'imageFile'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        'pdfFile'       => 'required|mimes:pdf|max:20480',
    ]);
    // // create files instance
    $files = new pdfFile;

    if ($request->has('fileStatus'))
    {
      $files->fileStatus = $request->input('fileStatus');
    }

    //pdf file
    if($request->file('pdfFile')){
        $path = Storage::disk('public_path')->putFile('uploads/files', $request->file('pdfFile'));
        $files->pdfFile=$path;
    }
    // img file
    if($request->file('imageFile')){
        $path = Storage::disk('public_path')->putFile('uploads/files', $request->file('imageFile'));
        $files->imageFile=$path;
        $image = Image::make(Storage::path($path))->fit(1200,700);
        $image->save();
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
        $path = Storage::disk('public_path')->putFile('uploads/files', $request->file('pdfFile'));
        \DB::table('pdf_files')
        ->where('fileId',$id)
        ->update([
          'pdfFile'=>$path,
        ]);
    }

    if($request->file('imageFile')){
        $path = Storage::disk('public_path')->putFile('uploads/files', $request->file('imageFile'));
        // $files->imageFile=$path;
        $image = Image::make(Storage::path($path))->fit(1200,700);
        $image->save();
        \DB::table('pdf_files')
        ->where('fileId',$id)
        ->update([
          'imageFile'=>$path,
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
    // delete files by id
    if(intval($id)){
      Storage::delete(pdfFile::find($id)->pdfImage);
      Storage::delete(pdfFile::find($id)->pdfFile);
      \DB::table('pdf_files')
      ->where('fileId',$id)
      ->delete();
    }
    return redirect()->route('files.index')->with('success','تم حذف الملف بنجاح  ');
  }
}
