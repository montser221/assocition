<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Arrow;
class ArrowsController extends Controller
{
    // view all arrows
    public function index()
    {
        $allarrows = Arrow::with(['project'])->latest()->paginate(10);
        // $allarrows = Arrow::all()->where('arrowStatus',1);
        return view('dashboard.arrows.index')->with([
            'allarrows'=>$allarrows,
        ]);
    }

    //edit arrows
    public function edit($id)
    {
        $data = Arrow::find($id);
        return view('dashboard.arrows.edit')->with([
            'data'=>$data,
        ]);
    }

    // store arrows
    public function store(Request $request)
    {
        $request->validate([
            'arrowName'  =>'required',
            'arrowValue' => 'required',
        ]);
        // return $request->all();
        $arrow = new Arrow();
        if ($request->has('arrowStatus')) {
            $arrow->arrowStatus   = $request->input('arrowStatus');
          }
        $arrow->arrowName =$request->arrowName;
        $arrow->arrowValue=$request->arrowValue;
        $arrow->projectTable=$request->projectTable;
        $arrow->save();
        return  redirect()->route('arrows.index')->with('success','تم أضافة السهم بنجاح');
    }
    // update arrows
    public function update(Request $request,$id)
    {
        if($request->has('arrowStatus'))
        {
          if($request->input('arrowStatus')==1)
          {
            \DB::table('arrows')
            ->where('arrowId',$id)
            ->update([
              'arrowStatus'=>1,
            ]);
          }
          else
          {
            \DB::table('arrows')
            ->where('arrowId',$id)
            ->update([
              'arrowStatus'=>0,
            ]);
          }
    
        }

        \DB::table('arrows')
        ->where('arrowId',$id)
        ->update([
            'arrowName'=>$request->arrowName,
            'arrowValue'=>$request->arrowValue,
            'projectTable'=>$request->projectTable,
        ]);
        return  redirect()->route('arrows.index')->with('success','تم  تعديل  السهم بنجاح');
    }
   //destroy
   public function destroy($id)
   {
     // delete project by id
     if(intval($id)){
       \DB::table('arrows')
       ->where('arrowId',$id)
       ->delete();
     }
     return redirect()->route('arrows.index')->with('success','تم حذف     السهم بنجاح ');
   }


}
