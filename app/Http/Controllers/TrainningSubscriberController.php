<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class TrainningSubscriberController extends Controller
{
    public function index()
    {
        return view('pages.subscribenow');
    }
    
    public function store(Request $request)
    { 
        return $request->all();
        $request->validate([
            'subscriberName'   => 'required|unique:trainning_subscribers|max:255',
             'subscriberEmail' => 'required|email',
             'subscriberPhone'  => 'required|numeric',
             'subscriberBirthOfDate' => 'required|date',
             'subscriberFamilyCard' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:14096',
            //  'trainningCourseId' => 'required|numeric',
        ]);
     
    }
}
