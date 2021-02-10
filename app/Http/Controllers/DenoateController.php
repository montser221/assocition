<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DenoatePayDetail;
// use App\Models\PaymentMethod;
use App\Exports\AllDenoate;
use Maatwebsite\Excel\Facades\Excel;
use Moyasar\Moyasar;
use Moyasar\Providers\PaymentService;

class DenoateController extends Controller
{
  public function index(){
    $allDenoate = DenoatePayDetail::latest()->paginate(9);
      return view('dashboard.denoate.index')->with([
        'allDenoate'=>$allDenoate,
      ]);
  }
  public function payments(Request $request){
    
    if($request->status == 'failed'){

      return redirect()->route('cart')->with('error','عفوا لم تتم العملية بنجاح الرجاء');
     
    }else if($request->status == 'paid'){

      \Moyasar\Moyasar::setApiKey("sk_live_qXRKzZaXCSnnRZXr9TnNYbr5jm2ZcdyUYSbQJZHy"); 

      $paymentService = new \Moyasar\Providers\PaymentService();
      
      $payment = $paymentService->fetch($request->id);
  
      $name = $payment->source->name;
  
      $company_name = $payment->source->company;

      $items = session()->get('cart');

      foreach ($items as $cart){
        if(is_array($cart)){
            foreach ($cart as $c){
              $projectTable =  $c['projectId'];
              $moneyValue =  $c['den'];
              
              $denoate = new DenoatePayDetail;
  
              $denoate->projectTable = $projectTable;
              $denoate->denoateName = $name;
              $denoate->denoatePhone = '099999';
              $denoate->paymentMethodTable = 7;
              $denoate->cardName = $company_name;
              $denoate->moneyValue = $moneyValue;
              $denoate->denoateStatus =1;
              $denoate->save();
       
            }
        }
      }
      session()->flush('cart');
      return redirect()->route('cart')->with('success','تم التبرع بنجاح');
             
    }
  }

  public function exportAllDenoate(Request $request)
  {
    $startDate = $request->query('startDate');
    $endDate   = $request->query('endDate');
        // return Excel::download(new AllDenoate($startDate , $endDate) , 'تفاصيل الدفع.xlsx');
        $request->validate([
          'startDate'=>'required|date',
          'endDate'=>'required|date',
        ]);

    // if($request->has('exportAllDenoate'))
    // {
    //   if($startDate==null OR $endDate == null )
    //   {
    //      return view('includes._sperror');
    //   }
    //   else
    //   {

        return Excel::download(new AllDenoate($startDate , $endDate) , 'تفاصيل الدفع.xlsx');
    //   }
    // }

  }

  public function store(Request $request)
  {
      
      $request->validate([
        'projectTable'        => 'required',
        'denoateName'        => 'required',
        'denoatePhone'        => 'required|numeric',
        'paymentMethodTable'        => 'required',
        'moneyValue'        => 'required|numeric',
    ]);
    // create project instance
    $denoate = new DenoatePayDetail;

    // check if project status checked or not
    if($request->has('denoateStatus')){
        $denoate->denoateStatus=1;
    }

    $denoate->projectTable       = $request->input('projectTable');
    $denoate->denoateName       =  $request->input('denoateName');
    $denoate->denoatePhone       = $request->input('denoatePhone');
    $denoate->paymentMethodTable = $request->input('paymentMethodTable');
    $denoate->moneyValue         = $request->input('moneyValue');
    $denoate->save();
    return redirect()->route('denoate.index')->with('success','تم التبرع بنجاح');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $data = DenoatePayDetail::find($id);
    return view('dashboard.denoate.edit')->with(['data'=>$data]);
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
    $request->validate([
        'projectTable'        => 'required',
        'denoateName'        => 'required',
        'denoatePhone'  => 'required|numeric',
        'paymentMethodTable'        => 'required',
        'moneyValue'        => 'required|numeric',
    ]);
    // check if project status checked or not
    if($request->has('denoateStatus'))
    {
      if($request->input('denoateStatus')==1)
      {
        \DB::table('denoate_pay_details')
        ->where('denoateId',$id)
        ->update([
          'denoateStatus'=>1,
        ]);
      }
      else
      {
        \DB::table('denoate_pay_details')
        ->where('denoateId',$id)
        ->update([
          'denoateStatus'=>0,
        ]);
      }

    }


    \DB::table('denoate_pay_details')
    ->where('denoateId',$id)
    ->update([
      'projectTable'=>$request->input('projectTable'),
      'denoateName'=>$request->input('denoateName'),
      'denoatePhone'=>$request->input('denoatePhone'),
      'paymentMethodTable'=>$request->input('paymentMethodTable'),
      'moneyValue'=>$request->input('moneyValue'),
    ]);

    return redirect()->route('denoate.index')->with('success','تم تحديث التبرع بنجاح ');
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
      \DB::table('denoate_pay_details')
      ->where('denoateId',$id)
      ->delete();
    }
    return redirect()->route('denoate.index')->with('success','تم حذف التبرع بنجاح');
  }

}