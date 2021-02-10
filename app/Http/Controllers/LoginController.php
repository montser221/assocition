<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // login to system
    public function login()
    {
        // echo Hash::make('12345678');
        return view('dashboard.login');
    }

    function checklogin(Request $request)
    {
     $this->validate($request, [
      'email'   => 'required|email',
      'password'  => 'required|alphaNum|min:3'
     ]);

     $user_data = array(
      'email'  => $request->get('email'),
      'password' => $request->get('password')
     );

     if(Auth::attempt($user_data))
     {
        $userstatus = Auth::user()->userStatus;
        if($userstatus==1):
            return redirect('/dashboard');
        // elseif():
        //     return redirect('/marketer');
        endif;
     }
     else
     {
      return back()->with('error', ' بيانات تسجيل دخول خاطئة ');
     }

    }

    function logout()
    {
     Auth::logout();
     return redirect('login');
    }
}
