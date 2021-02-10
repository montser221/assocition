<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
class PaymentMethodController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $allpaymentmethod = PaymentMethod::latest()->paginate(5);
      return view('dashboard.paymentmethod.index')->with(['allpaymentmethod'=>$allpaymentmethod]);
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
        'methodName'     => 'required|unique:payment_methods',
        'methodDesc'     => 'required',
        'methodImage'    => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2028',

    ]);
    // // create project instance
    $PaymentMethod = new PaymentMethod;
    // check if project status checked or not
    if($request->has('methodStatus')){
        $PaymentMethod->methodStatus = $request->input('methodStatus');
    }

    if($request->file('methodImage')){

        $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('methodImage')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;

        $uploads_folder =  getcwd() .'/uploads/paymentmethod/';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('methodImage')->move($uploads_folder,    $image_full_name);
        $PaymentMethod->methodImage=$image_full_name;
    }


    $PaymentMethod->methodDesc   = $request->input('methodDesc');
    $PaymentMethod->methodName   = $request->input('methodName');
    $PaymentMethod->save();
    return redirect()->route('paymentmethod.index')->with('success','تم أضافة طريقة الدفع بنجاح');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $data = PaymentMethod::find($id);
    return view('dashboard.paymentmethod.edit')->with(['data'=>$data]);
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
    if($request->file('methodImage')){
        $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('methodImage')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;

        $uploads_folder =  getcwd() .'/uploads/paymentmethod';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('methodImage')->move($uploads_folder,    $image_full_name);
        \DB::table('payment_methods')
        ->where('methodId',$id)
        ->update([
          'methodImage'=>$image_full_name,
        ]);
    }

    if($request->has('methodStatus'))
    {
      if($request->input('methodStatus')==1)
      {
        \DB::table('payment_methods')
        ->where('methodId',$id)
        ->update([
          'methodStatus'=>1,
        ]);
      }
      else
      {
        \DB::table('payment_methods')
        ->where('methodId',$id)
        ->update([
          'methodStatus'=>0,
        ]);
      }

    }

    \DB::table('payment_methods')
    ->where('methodId',$id)
    ->update([
      'methodDesc'=>$request->input('methodDesc'),
      'methodName'=>$request->input('methodName'),
    ]);

    return redirect()->route('paymentmethod.index')->with('success','تم تحديث  بيانات طريقة الدفع بنجاح');
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
      \DB::table('payment_methods')
      ->where('methodId',$id)
      ->delete();
    }
    return redirect()->route('paymentmethod.index')->with('success','تم حذف طريقة الدفع بنجاح ');
  }
}
