<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voluntary;
class VolntController extends Controller
{
    public function volnt()
  {
    $allvolnt = Voluntary::latest()->paginate(10);
    // dd($allapplicable);
    return view('dashboard.volnt.index')->with([
      'allvolnt'=>$allvolnt,
    ]);
  }

  public function destroy($id)
  {
    // delete project by id
    if(intval($id)){
      \DB::table('voluntaries')
      ->where('voluntaryId',$id)
      ->delete();
    }
    return redirect()->route('volnt')->with('success','تم حذف المستفيد بنجاح ');
  }
}
