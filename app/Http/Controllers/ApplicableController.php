<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payee;
class ApplicableController extends Controller
{
  public function applicable()
  {
    $allapplicable = Payee::latest()->paginate(9);
    // dd($allapplicable);
    return view('dashboard.applicable.index')->with([
      'allapplicable'=>$allapplicable,
    ]);
  }
  // activate the subscriber
  public function activate($id)
  {
    $this->middleware('auth');
      // \DB::table('trainning_subscribers')
      // ->where('payeeId',$id)
      Payee::where('payeeId',$id)->update(['payeeStatus'=>1]);
      return redirect()->route('applicable')->with('success','تم تفعيل العضوء بنجاح');
  }
  // deactivate the subscriber
  public function deactivate($id)
  {
    $this->middleware('auth');
      // \DB::table('trainning_subscribers')
      // ->where('payeeId',$id)
      Payee::where('payeeId',$id)->update(['payeeStatus'=>0]);
      return redirect()->route('applicable')->with('success','تم  الغاء تفعيل العضوء بنجاح');
}
  public function destroy($id)
  {
    // delete project by id
    if(intval($id)){
      \Storage::delete(Payee::find($id)->moneyNotify);
      \DB::table('payees')
      ->where('payeeId',$id)
      ->delete();
    }
    return redirect()->route('applicable')->with('success','تم حذف المستفيد بنجاح ');
  }
}
