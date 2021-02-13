<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TrainningSubscriber; 
use App\Models\TrainningCourses; 
use \Storage;
class TrainningSubscriberController extends Controller
{
    public function index()
    {
        return view('pages.subscribenow');
    }
    
    //get all subscriber
    public function subscriber()
    {
        $this->middleware('auth');
        $alltrainner = TrainningSubscriber::latest()->paginate(9);
        return view('dashboard.subscribers.index',compact('alltrainner'));
    }
    //explore all subscriber
    public function show($id)
    {
        $this->middleware('auth');
        $data = TrainningSubscriber::find($id) ;
        return view('dashboard.subscribers.show',compact('data'));
    }
    
    public function store(Request $request)
    { 
        $request->validate([
            'subscriberName'         => 'required|max:255',
             'subscriberEmail'       => 'required|email|unique:trainning_subscribers',
             'subscriberPhone'       => 'required|numeric|unique:trainning_subscribers',
             'subscriberBirthOfDate' => 'required|date',
             'subscriberFamilyCard'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:14096',
             'trainningCourseId'     => 'required|numeric',
        ]);
        $getallSubscriber = \DB::table('trainning_subscribers')
        ->where('trainningCourseId',$request->trainningCourseId)
        ->count('*');
        $seatCount = TrainningCourses::find($request->trainningCourseId);
        $c = $seatCount->seatCount;

    \DB::beginTransaction();
    $subscribe = new TrainningSubscriber;
    try{
    if( $c - $getallSubscriber == 0){
     throw new \Exception ('تم حجز المقعد مسبقا');   
    }
    $subscribe->subscriberName=$request->subscriberName;
    if($request->file('subscriberFamilyCard'))
     {
        $path = Storage::disk('public_path')->putFile('uploads', $request->file('subscriberFamilyCard'));
        $subscribe->subscriberFamilyCard=$path;
        // $image = Image::make(Storage::path($path))->fit(1200,700);
        // $image->save();
     }
    if($request->file('subscriberMoneyStatement'))
     {
        $path = Storage::disk('public_path')->putFile('uploads', $request->file('subscriberMoneyStatement'));
        $subscribe->subscriberMoneyStatement=$path;
        // $image = Image::make(Storage::path($path))->fit(1200,700);
        // $image->save();
     }
     $subscribe->subscriberEmail=$request->subscriberEmail;
     $subscribe->subscriberPhone=$request->subscriberPhone;
     $subscribe->subscriberBirthOfDate=$request->subscriberBirthOfDate;
     $subscribe->trainningCourseId=$request->trainningCourseId;
     $subscribe->save();
    }catch(\Exception $e)
    {
        \DB::rollback();
        // throw $e;
        session()->flash('error','تم حجز المقعد مسبقا');
        return redirect()->route('subscribenow.index');
    }
     
    \DB::commit();
    return redirect()->to('subscribenow?cid='.$request->trainningCourseId.'&p='.$request->cprice)->with('success','تم الاشتراك في الدورة التدريبية بنجاح');
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
        Storage::delete(TrainningSubscriber::find($id)->subscriberFamilyCard);
        \DB::table('trainning_subscribers')
        ->where('subscriberId',$id)
        ->delete();
      }
      return redirect()->route('subscribenow.subscriber')->with('success','تم حذف   المشترك  بنجاح');
    }
}
