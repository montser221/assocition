<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TrainningCourses;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
class TrainningCoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allcourses = TrainningCourses::latest()->paginate(9);
        return view('dashboard.courses.index')->with(['allcourses'=>$allcourses]);
    }

    public function ourcourses()
    {
        $allcourses = TrainningCourses::latest()->paginate(9);
        return view('pages.ourcourses')->with(['allcourses'=>$allcourses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    /*
    coursePrice
courseState
    */
      $request->validate([
          'courseName'        => 'required|unique:trainning_courses|max:255',
          'courseDescription' => 'required|max:255',
          'courseImage'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:14096',
          'courseTime'        => 'required|date_format:H:i',
          'courseDate'        => 'required|date',
          'courseLocation'    => 'required',
          'coursePrice'       => 'required|string',
          'courseState'       => 'required|string',
          'courseContent'     => 'required',
          'seatCount'         => 'required|numeric',
      ]);
      // return $request->all();
      // create traning courses instance
      $course = new TrainningCourses;
      // check if course status checked or not
      if($request->has('courseStatus')){
          $course->courseStatus=1;
      }  
      // upload course image and store it in database
      if($request->file('courseImage')){
          $path = Storage::disk('public_path')->putFile('courses', $request->file('courseImage'));
          $course->courseImage=$path;
          $image = Image::make(Storage::path($path))->fit(1400,800);
          $image->save();
      }
       

      $course->courseName        = $request->input('courseName');
      $course->courseDescription = $request->input('courseDescription');
      $course->courseTime        = $request->input('courseTime');
      $course->courseDate        = $request->input('courseDate');
      $course->courseContent     = $request->input('courseContent');
      $course->courseLocation    = $request->input('courseLocation');
      $course->coursePrice       = $request->input('coursePrice');
      $course->courseState       = $request->input('courseState');
      $course->seatCount         = $request->input('seatCount');
      $course->save();
      return redirect()->route('courses.index')->with('success','تم أضافة الدورة التدريبية  بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data = TrainningCourses::find($id);
      return view('dashboard.courses.edit')->with(['data'=>$data]);
    }

    public function show($id)
    {
      $data = TrainningCourses::find($id);
        return view('dashboard.courses.show',compact('data'));
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
      // check if course status checked or not
      if($request->has('courseStatus') )
      {
        \DB::table('trainning_courses')
        ->where('courseId',$id)
        ->update([
          'courseStatus'=>1,
        ]);
      }
      else
      {
        \DB::table('trainning_courses')
        ->where('courseId',$id)
        ->update([
          'courseStatus'=>0,
        ]);
      }
      if($request->has('courseName')){
        \DB::table('trainning_courses')
        ->where('courseId',$id)
        ->update([
          'courseName'=>$request->input('courseName'),
        ]);
      }
       
      // upload course image and store it in database
      if($request->file('courseImage')){
          Storage::delete(TrainningCourses::find($id)->courseImage);
          $path = Storage::disk('public_path')->putFile('courses', $request->file('courseImage'));
          // dd($path);
          // $course->courseImage=$path;
          $image = Image::make(Storage::path($path))->fit(1400,800);
          $image->save();
          \DB::table('trainning_courses')
          ->where('courseId',$id)
          ->update([
            'courseImage'=>$path,
          ]);
      }
        
      if($request->has('courseDescription')){
        \DB::table('trainning_courses')
        ->where('courseId',$id)
        ->update([
          'courseDescription'=>$request->input('courseDescription'),
        ]);
      }
      

      if($request->has('coursePrice')){
        \DB::table('trainning_courses')
        ->where('courseId',$id)
        ->update([
          'coursePrice'=>$request->input('coursePrice'),
        ]);
      }
      if($request->has('courseState')){
        \DB::table('trainning_courses')
        ->where('courseId',$id)
        ->update([
          'courseState'=>$request->input('courseState'),
        ]);
      }
      if($request->has('courseTime') && $request->input('courseTime') != null ){
        \DB::table('trainning_courses')
        ->where('courseId',$id)
        ->update([
          'courseTime'=>$request->input('courseTime'),
        ]);
      } 
      else 
      {
        \DB::table('trainning_courses')
        ->where('courseId',$id)
        ->update([
          'courseTime'=>$request->input('olCourseTime'),
        ]);
      }

      if($request->has('courseDate')){
        \DB::table('trainning_courses')
        ->where('courseId',$id)
        ->update([
          'courseDate'=>$request->input('courseDate'),
        ]);
      }
      if($request->has('courseLocation')){
        \DB::table('trainning_courses')
        ->where('courseId',$id)
        ->update([
          'courseLocation'=>$request->input('courseLocation'),
        ]);
      }
       
      if($request->has('courseContent')){
        \DB::table('trainning_courses')
        ->where('courseId',$id)
        ->update([
          'courseContent'=>$request->input('courseContent'),
        ]);
      }
      if($request->has('seatCount')){
        \DB::table('trainning_courses')
        ->where('courseId',$id)
        ->update([
          'seatCount'=>$request->input('seatCount'),
        ]);
      }
      return redirect()->route('courses.index')->with('success','تم تحديث الدورة التدريبية بنجاح ');
    }


    public function courseDetail($id)
    {
      $courseData = TrainningCourses::find($id);
      return view('pages.courseDetail')->with([
        'courseData'=>$courseData,
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
      // delete course by id
      if(intval($id)){
        Storage::delete(TrainningCourses::find($id)->courseImage);
        \DB::table('trainning_courses')
        ->where('courseId',$id)
        ->delete();
      }
      return redirect()->route('courses.index')->with('success','تم حذف الدورة التدريبية بنجاح');
    }
}
