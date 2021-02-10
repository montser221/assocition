<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayeeManagement;
class PayeeManagementController extends Controller
{
  public function index()
  {
      $allpayees = PayeeManagement::latest()->paginate(5);
      return view('dashboard.payees.index')->with(['allpayees'=>$allpayees]);
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
        'pName'           => 'required',
        'healthState'     => 'required',
        'gender'          => 'required',
        'ssnNumber'       => 'required|numeric',
        // 'pImage'          => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2028',
    ]);
    // // create project instance
    $payees = new PayeeManagement;

    // if($request->file('pImage')){
    //
    //     $image_name = time() . rand(1,1000000000000) . date('Y');
    //     $image_ext = $request->file('pImage')->getClientOriginalExtension(); // example: png, jpg ... etc
    //     $image_full_name = $image_name . '.' . $image_ext;
    //
    //     $uploads_folder =  getcwd() .'/uploads/payees/';
    //     if (!file_exists($uploads_folder)) {
    //         mkdir($uploads_folder, 0777, true);
    //     }
    //     $request->file('pImage')->move($uploads_folder,    $image_full_name);
    //     $payees->pImage=$image_full_name;
    // }

    if ($request->has('pStatus')) {
      $payees->pStatus   = $request->input('pStatus');
    }

    $payees->pName   = $request->input('pName');
    $payees->healthState   = $request->input('healthState');
    $payees->gender   = $request->input('gender');
    $payees->ssnNumber   = $request->input('ssnNumber');
    $payees->save();
    return redirect()->route('payees.index')->with('success','تم أضافة  المستفيد بنجاح');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $data = PayeeManagement::find($id);
    return view('dashboard.payees.edit')->with(['data'=>$data]);
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

    // if($request->file('pImage'))
    // {
    //     $image_name = time() . rand(1,1000000000000);
    //     $image_ext = $request->file('pImage')->getClientOriginalExtension(); // example: png, jpg ... etc
    //     $image_full_name = $image_name . '.' . $image_ext;
    //
    //     $uploads_folder =  getcwd() .'/uploads/payees';
    //     if (!file_exists($uploads_folder)) {
    //         mkdir($uploads_folder, 0777, true);
    //     }
    //     $request->file('pImage')->move($uploads_folder,    $image_full_name);
    //     \DB::table('payees')
    //     ->where('pId',$id)
    //     ->update([
    //       'pImage'=>$image_full_name,
    //     ]);
    // }

    if ($request->has('pStatus'))
    {
      \DB::table('payee_management')
      ->where('pId',$id)
      ->update([
        'pStatus'=>$request->input('pStatus'),
      ]);
    }

    \DB::table('payee_management')
    ->where('pId',$id)
    ->update([
      'pName'=>$request->input('pName'),
      'healthState'=>$request->input('healthState'),
      'ssnNumber'=>$request->input('ssnNumber'),
      'gender'=>$request->input('gender'),
    ]);

    return redirect()->route('payees.index')->with('success','تم تحديث  بيانات  المستفيد بنجاح');
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
      \DB::table('payee_management')
      ->where('pId',$id)
      ->delete();
    }
    return redirect()->route('payees.index')->with('success','تم حذف المستفيد بنجاح ');
  }
}
