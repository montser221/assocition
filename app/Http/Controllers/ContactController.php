<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Models\Pages;
use App\Models\PagesViews;
class ContactController extends Controller
{
  public function index()
  {
    $pageId   = 6;
    $vistorIp = request()->ip();
   $pageTotalViews = Pages::pageTotalViews($pageId);
   
    if(PagesViews::is_unique_view($vistorIp,$pageId) === true)
    {
      // PagesViews::create([
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
      return view('pages.contact-us');
  }

  public function contact()
  {
    $allContact = ContactUs::latest()->paginate(10);
      return view('dashboard.contact.contact')->with([
        'allContact'=>$allContact,
      ]);
  }
 public function msgDetail($id)
  {
    $data = ContactUs::find($id);
      return view('dashboard.contact.msgDetail')->with([
        'data'=>$data,
      ]);
  }

  public function store(Request $request)
  {
   
    $request->validate([
        'msgType'    => 'required',
        'fullName'    => 'required',
        'email' => 'required',
        'topic'   => 'required',
        'msg' => 'required',
         
    ]);
 
    $contact = new ContactUs;
 
    $contact->msgType  = $request->input('msgType');
    $contact->fullname  = $request->input('fullName');
    $contact->email     = $request->input('email');
    $contact->topic     = $request->input('topic');
    $contact->message   = $request->input('msg');
 
    $contact->save();
    return redirect()->route('contact.index')->with('success',' تم ارسال رسالتكم بنجاح شكرا لكم');
  }

   public function store2(Request $request)
  {
    // return $request->all();
    $request->validate([
        'msgType'    => 'required',
        'fullName'    => 'required',
        'email' => 'required',
        'topic'   => 'required',
        'msg' => 'required',
         
    ]);

    $contact = new ContactUs;
 
    $contact->msgType  = $request->input('msgType');
    $contact->fullname  = $request->input('fullName');
    $contact->email     = $request->input('email');
    $contact->topic     = $request->input('topic');
    $contact->message   = $request->input('msg');
 
    $contact->save();
    return redirect()->route('home')->with('success',' تم ارسال رسالتكم بنجاح شكرا لكم');
  }

  public function destroy($id)
  {
    // ContactUs::where('contactId',[2,3,4,5])->delete();

    // delete project by id
    if(intval($id)){
      \DB::table('contact_us')
      ->where('contactId',[2,3,4,5])
      ->delete();
    }
    return redirect()->route('contact.contact')->with('success','تم حذف   الرسالة بنجاح ');
  }
}
