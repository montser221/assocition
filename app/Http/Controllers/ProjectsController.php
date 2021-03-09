<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\ProjectsCategories;
use App\Models\DenoatePayDetail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DenoateExample;
use Intervention\Image\Facades\Image;
use \Storage;
class ProjectsController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allprojects = Projects::with(['arrow','denoate'])->latest()->paginate(10);
        return view('dashboard.projects.index')->with(['allprojects'=>$allprojects]);
    }

      public function customProjectDetail()
    {
      $customProject = Projects::orderBy('projectId','desc')->whereIn('projectId',[25,26])->get();
      // ->where('projectId',10103)->where('projectId',10002);
      return view('pages.customProject')
      ->with([
        'customProject'=>$customProject
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
       
          'projectName'        => 'required|unique:projects|max:255',
        //   'projectCategoryId'  => 'required|numeric',
          'projectDesc'        => 'required',
          'projectIcon'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:14096',
          'projectImage'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:14096',
        //   'projectWrapper'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
          'projectText'        => 'required',
          'projectLocation'    => 'required',
          'projectCost'        => 'required|numeric',
      ]);
      // create project instance
      $project = new Projects;

      // check if project status checked or not
      if($request->has('projectStatus')){
          $project->projectStatus=1;
      }
      if($request->has('whatsapp')){
          $project->whatsapp=$request->input('whatsapp');
      }

      if($request->file('projectIcon')){
          $path = Storage::disk('public_path')->putFile('uploads', $request->file('projectIcon'));
          $project->projectIcon=$path;
          $image = Image::make(Storage::path($path))->fit(1200,700);
          $image->save();
      }
      // upload project image and store it in database
      if($request->file('projectImage')){
          // $project->projectImage=$image_full_name;
          $path = Storage::disk('public_path')->putFile('uploads', $request->file('projectImage'));
          $project->projectImage=$path;
          $image = Image::make(Storage::path($path))->fit(1200,700);
          $image->save();
      }
        // upload project wrapper and store it in database

      $project->projectName       = $request->input('projectName');
      $project->projectDesc       = $request->input('projectDesc');
      $project->projectCategoryId = 1;
      // $project->projectCategoryId = $request->input('projectCategoryId');
      $project->projectText       = $request->input('projectText');
      $project->projectCost       = $request->input('projectCost');
      $project->projectLocation       = $request->input('projectLocation');
      $project->save();
      return redirect()->route('projects.index')->with('success','تم أضافة المشروع بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data = Projects::find($id);
      return view('dashboard.projects.edit')->with(['data'=>$data]);
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
       
        //   'projectCategoryId'  => 'required|numeric',
          'projectDesc'        => 'required',
          'projectText'        => 'required',
          'projectLocation'    => 'required',
          'projectCost'        => 'required|numeric',
      ]);
      
      // check if project status checked or not
      if($request->has('projectStatus') )
      {
        \DB::table('projects')
        ->where('projectId',$id)
        ->update([
          'projectStatus'=>1,
        ]);
      }
      else
      {
        \DB::table('projects')
        ->where('projectId',$id)
        ->update([
          'projectStatus'=>0,
        ]);
      }
      if($request->has('whatsapp')){
        \DB::table('projects')
        ->where('projectId',$id)
        ->update([
          'whatsapp'=>$request->input('whatsapp'),
        ]);
      }
      // upload project icon and store it in database
      if($request->file('projectIcon')){
          Storage::delete(Projects::find($id)->projectIcon);
          $path = Storage::disk('public_path')->putFile('uploads', $request->file('projectIcon'));
          // $project->projectImage=$path;
          $image = Image::make(Storage::path($path))->fit(1200,700);
          $image->save();
          \DB::table('projects')
          ->where('projectId',$id)
          ->update([
            'projectIcon'=>$path,
          ]);
      }
      // upload project image and store it in database
      if($request->file('projectImage')){
          Storage::delete(Projects::find($id)->projectImage);
          $path = Storage::disk('public_path')->putFile('uploads', $request->file('projectImage'));
          // $project->projectImage=$path;
          $image = Image::make(Storage::path($path))->fit(1200,700);
          $image->save();
          \DB::table('projects')
          ->where('projectId',$id)
          ->update([
            'projectImage'=>$path,
          ]);
      }
      \DB::table('projects')
      ->where('projectId',$id)
      ->update([
        'projectName'=>$request->input('projectName'),
        'projectDesc'=>$request->input('projectDesc'),
        'projectCategoryId'=>1,
        'projectText'=>$request->input('projectText'),
        'projectCost'=>$request->input('projectCost'),
        'projectLocation'=>$request->input('projectLocation'),
      ]);
      return redirect()->route('projects.index')->with('success','تم تحديث المشروع بنجاح ');
          // return $request->all();
    }
    public function projectDetail($id)
    {
      $projectData = Projects::find($id);
      return view('pages.projectDetail')->with([
        'projectData'=>$projectData,
      ]);
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
        Storage::delete(Projects::find($id)->projectIcon);
        Storage::delete(Projects::find($id)->projectImage);
        \DB::table('projects')
        ->where('projectId',$id)
        ->delete();
      }
      return redirect()->route('projects.index')->with('success','تم حذف المشروع بنجاح');
    }
}
