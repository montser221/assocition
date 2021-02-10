<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Money;
class ManageMoneyReportController extends Controller
{
    /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $allreportFiles = Money::latest()->paginate(10);
      return view('dashboard.reportFiles.index')->with(['allreportFiles'=>$allreportFiles]);
  }

 //all reportFiles
    public function allReportFiles ()
    {
      $reportFiles = Money::all()->where('reportStatus',1);
      return view('pages.allreport')->with([
        'reportFiles'=>$reportFiles,
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
//  `ReportId`, `reportTitle`, `reportImageFile`, `reportPdfFile`, `reportStatus`, `created_at`, `updated_at`
    $request->validate([
        'reportTitle'         => 'required|unique:money',
        'reportImageFile'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2028',
        'reportPdfFile'       => 'required|mimes:pdf,xlsx|max:4096',
    ]);
    // // create project instance
    $reportFiles = new Money;

    if ($request->has('reportStatus'))
    {
      $reportFiles->reportStatus = $request->input('reportStatus');
    }

    //pdf file
    if($request->file('reportPdfFile')){

        $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('reportPdfFile')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;

        $uploads_folder =  getcwd() .'/uploads/reportFiles/';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('reportPdfFile')->move($uploads_folder,    $image_full_name);
        $reportFiles->reportPdfFile=$image_full_name;
    }
    // img file
    if($request->file('reportImageFile')){

        $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('reportImageFile')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;

        $uploads_folder =  getcwd() .'/uploads/reportFiles/';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('reportImageFile')->move($uploads_folder,    $image_full_name);
        $reportFiles->reportImageFile=$image_full_name;
    }

    $reportFiles->reportTitle   = $request->input('reportTitle');
    $reportFiles->save();
    return redirect()->route('reportfiles.index')->with('success','تم أضافة  الملف بنجاح');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $data = Money::find($id);
    return view('dashboard.reportFiles.edit')->with(['data'=>$data]);
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

    if($request->file('reportPdfFile')){
        $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('reportPdfFile')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;

        $uploads_folder =  getcwd() .'/uploads/reportFiles';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('reportPdfFile')->move($uploads_folder,    $image_full_name);

        \DB::table('money')
        ->where('ReportId',$id)
        ->update([
          'reportPdfFile'=>$image_full_name,
        ]);
    }

    if($request->file('reportImageFile')){
        $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('reportImageFile')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;

        $uploads_folder =  getcwd() .'/uploads/reportFiles';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('reportImageFile')->move($uploads_folder,    $image_full_name);
        \DB::table('money')
        ->where('ReportId',$id)
        ->update([
          'reportImageFile'=>$image_full_name,
        ]);
    }

    if ($request->has('reportStatus'))
    {
      \DB::table('money')
      ->where('ReportId',$id)
      ->update([
        'reportStatus'=>$request->input('reportStatus'),
      ]);
    }
    \DB::table('money')
    ->where('ReportId',$id)
    ->update([
      'reportTitle'=>$request->input('reportTitle'),
    ]);

    return redirect()->route('reportfiles.index')->with('success','تم تحديث  الملف بنجاح');
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
      \DB::table('money')
      ->where('ReportId',$id)
      ->delete();
    }
    return redirect()->route('reportfiles.index')->with('success','تم حذف الملف بنجاح  ');
  }
}
