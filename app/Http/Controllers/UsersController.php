<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allUsers = User::latest()->paginate(5);
        return view('dashboard.users.index')->with(['allUsers'=>$allUsers]);
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
          'username'         => 'required|unique:users|max:255',
          'fullName'         => 'required|max:255',
          'userCategoryIdTable'   => 'required|numeric',
          'password'         => 'required',
          // 'confirmPassword'  => 'confirmed:password',
          'email'            => 'required|unique:users',
          'phone'            => 'required',
          'profileImage'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',

      ]);
      // // create project instance
      $user = new User;
      //
      // check if project status checked or not
      if($request->has('userStatus')){
          $user->userStatus = $request->input('userStatus');
      }

      if($request->has('phone') && !empty($request->input('phone')) ){
          $user->phone = $request->input('phone');
      }

      if($request->file('profileImage')){
          $image_name = time() . rand(1,1000000000000);
          $image_ext = $request->file('profileImage')->getClientOriginalExtension(); // example: png, jpg ... etc
          $image_full_name = $image_name . '.' . $image_ext;

          $uploads_folder =  getcwd() .'/uploads/profile';
          if (!file_exists($uploads_folder)) {
              mkdir($uploads_folder, 0777, true);
          }
          $request->file('profileImage')->move($uploads_folder,    $image_full_name);
          $user->profileImage=$image_full_name;
      }

      $user->fullName       = $request->input('fullName');
      $user->username       = $request->input('username');
      $user->userCategoryIdTable = $request->input('userCategoryIdTable');
      $user->email          = $request->input('email');
      $user->password       = Hash::make($request->input('password'));
      $user->save();
      return redirect()->route('users.index')->with('success','تم أضافة المستخدم بنجاح   ');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data = User::find($id);
      return view('dashboard.users.edit')->with(['data'=>$data]);
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
      // check if project status checked or not
      // return $request->input('userStatus');
        if($request->has('userStatus'))
        {     
          if($request->input('userStatus')==1)
          {
            \DB::table('users')
            ->where('userId',$id)
            ->update([
              'userStatus'=>1,
            ]);
          }
          else
          {
            \DB::table('users')
            ->where('userId',$id)
            ->update([
              'userStatus'=>0,
            ]);
          }

        }

        // upload project wrapper and store it in database
      if($request->file('profileImage')){
          $image_name = time() . rand(1,1000000000000);
          $image_ext = $request->file('profileImage')->getClientOriginalExtension(); // example: png, jpg ... etc
          $image_full_name = $image_name . '.' . $image_ext;

          $uploads_folder =  getcwd() .'/uploads/profile';
          if (!file_exists($uploads_folder)) {
              mkdir($uploads_folder, 0777, true);
          }
          $request->file('profileImage')->move($uploads_folder,    $image_full_name);
          \DB::table('users')
          ->where('userId',$id)
          ->update([
            'profileImage'=>$image_full_name,
          ]);
      }

      if($request->has('password') && !empty($request->input('password')) )
      {

        \DB::table('users')
        ->where('userId',$id)
        ->update([
          'password'=>Hash::make($request->input('password')),
      ]);

      }

      \DB::table('users')
      ->where('userId',$id)
      ->update([
        'userCategoryIdTable'=>$request->input('userCategoryIdTable'),
        'fullname'=>$request->input('fullName'),
        'username'=>$request->input('username'),
        'email'=>$request->input('email'),
      ]);

      return redirect()->route('users.index')->with('success','تم تحديث  بيانات المستخدم بنجاح   ');
          // return $request->all();
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
        \DB::table('users')
        ->where('userId',$id)
        ->delete();
      }
      return redirect()->route('users.index')->with('success','تم حذف المشروع بنجاح');
    }
}
