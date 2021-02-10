<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dulni;
use App\Models\Pages;
use App\Models\PagesViews;
class DulniController extends Controller
{
    public function index()
    {
      $pageId   = 3;
      $vistorIp = request()->ip();
     $pageTotalViews = Pages::pageTotalViews($pageId);
      // dd($pageTotalViews);
      if(PagesViews::is_unique_view($vistorIp,$pageId) === true)
      {
        // PagesViews::Create([
        //   'pagesTable'=>$pageId,
        //   'visitorIp'=>$vistorIp,
        // ]);
        \DB::table('pages')
          ->where('pageId',$pageId)
          ->update([
            'totalViews'=> 1,
            'updated_at'=>now(),
          ]);
      
      }
      else
      {
        // dd('bad');
      }
        return view('pages.dulni');
    }

    public function needy()
    {
      $allneedy = Dulni::all();
        return view('dashboard.needy.index')->with([
          'allneedy'=>$allneedy,
        ]);
    }

    public function show($id)
    {
      $data = Dulni::find($id);
        return view('dashboard.needy.show')->with([
          'data'=>$data,
        ]);
    }

    public function store(Request $request)
    {
      // return $request->all();
      $request->validate([
          'name'    => 'required',
          'address' => 'required',
          'needy'   => 'required',
          'details' => 'required',
          'phone'   => 'required|numeric',
      ]);

      $payees = new Dulni;

      $payees->name      = $request->input('name');
      $payees->phone     = $request->input('phone');
      $payees->needy     = $request->input('needy');
      $payees->address   = $request->input('address');
      $payees->details   = $request->input('details');
      $payees->save();
      return redirect()->route('dulni.index')->with('success','تم  تسجيل بيانات المحتاج بنجاح  ');
    }

   public function destroy($id)
  {
    // delete project by id
    if(intval($id)){
      \DB::table('dulnis')
      ->where('dulniId',$id)
      ->delete();
    }
    return redirect()->route('needy')->with('success','تم حذف   المحتاج بنجاح ');
  }
}
