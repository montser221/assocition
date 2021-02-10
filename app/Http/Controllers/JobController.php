<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Jobs;
use App\Models\Pages;
use App\Models\PagesViews;
class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageId   = 7;
        $vistorIp = request()->ip();
        $pageTotalViews = Pages::pageTotalViews($pageId);
            // dd($pageTotalViews);
            if(PagesViews::is_unique_view($vistorIp,$pageId) === true)
            {
            // PagesViews::Create([
            //     'pagesTable'=>$pageId,
            //     'visitorIp'=>$vistorIp,
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
                return view('pages.jobs');
    }
     

    public function store(Request $request)
    {
      // return $request->all();
      $request->validate([
          'fullName'  => 'required',
          'email'     => 'required|unique:jobs',
          'age'       => 'required|numeric',
          'gender'    => 'required',
          'phone'     => 'required|numeric',
           'jobTitle'       => 'required',
          'cv'        => 'required|mimes:pdf|max:10000',
      ]);

      $jobs = new Jobs;
      //Store user cv Icon
      if($request->file('cv')){
        // dd($request->file('cv'));
          $image_name = time() . rand(1,1000000000000);
          $image_ext = $request->file('cv')->getClientOriginalExtension(); // example: png, jpg ... etc
          $image_full_name = $image_name . '.' . $image_ext;

          $uploads_folder =  getcwd() .'/uploads/jobs/';
          if (!file_exists($uploads_folder)) {
              mkdir($uploads_folder, 0777, true);
          }
          $request->file('cv')->move($uploads_folder,    $image_full_name);
          $jobs->cv=$image_full_name;
      }


      $jobs->fullname = $request->input('fullName');
      $jobs->email    = $request->input('email');
      $jobs->age      = $request->input('age');
      $jobs->gender   = $request->input('gender');
      $jobs->phone    = $request->input('phone');
      $jobs->job      = $request->input('jobTitle');
      $jobs->save();
      return redirect()->route('jobs.index')->with('success','تم تقديم الطلب بنجاح');
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
}
