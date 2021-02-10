<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;
class DashboardController extends Controller
{

    // dashboard page
    public function dashboard()
    {
        return view("admin.dashboard");
    }
    public function getUserStatus()
    {
        return Auth::user()->status;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($this->getUserStatus()==0)
            return redirect('/marketer');
        $usersData = User::latest()->paginate(10);
        return view("admin.index",compact('usersData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
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
            'name'     => 'required|unique:users|max:255',
            'email'    => 'required|unique:users',
            'password' => 'required',
            'phone'    => 'required|numeric',
        ]);
        $user = new User;
        $user->name     = $request->input('name');
        $user->email    = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->phone    = $request->input('phone');
        $user->save();
        return redirect()->route('admin.index')
               ->with('success','User Added Successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userProjects= User::find($id)->projects;

        return view('admin.show',compact('userProjects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = User::find($id);
        return view('admin.edit',compact('edit'));
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
            'name'     => 'required|max:255',
            'email'    => 'required',
        ]);
        $oldPassword = !empty($request->input('password')) ? Hash::make($request->input('password')) : "" ;
        if(!empty($oldPassword))
        {
            \DB::table('users')
            ->where('userId',$id)
            ->update([
                'name' =>$request->input('name'),
                'email'=>$request->input('email'),
                'password'=>$oldPassword,
                'phone'=>$request->input('phone'),
            ]);
        }
        else
        {
            \DB::table('users')
            ->where('userId',$id)
            ->update([
                'name' =>$request->input('name'),
                'email'=>$request->input('email'),
                'phone'=>$request->input('phone'),
            ]);
        }
        return redirect()->route('admin.index')
               ->with('success','User Updated Successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
