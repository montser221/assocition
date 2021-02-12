<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TrainningSubscriber; 
use \Storage;
class TrainningSubscriberController extends Controller
{
    public function index()
    {
        return view('pages.subscribenow');
    }
    
    public function store(Request $request)
    { 
        $request->validate([
            'subscriberName'   => 'required|unique:trainning_subscribers|max:255',
             'subscriberEmail' => 'required|email',
             'subscriberPhone'  => 'required|numeric',
             'subscriberBirthOfDate' => 'required|date',
             'subscriberFamilyCard' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:14096',
            //  'trainningCourseId' => 'required|numeric',
        ]);
     $subscribe = new TrainningSubscriber;
     if($request->file('subscriberFamilyCard'))
     {

     }

     $subscribe->subscriberName=$request->subscriberName;
     $subscribe->subscriberEmail=$request->subscriberEmail;
     $subscribe->subscriberPhone=$request->subscriberPhone;
     $subscribe->subscriberBirthOfDate=$request->subscriberBirthOfDate;
    }
}
