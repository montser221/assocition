<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersCategories;
class UsersCategoriesController extends Controller
{

  public function index()
  {
    $allCategories = UsersCategories::all();
      return view('dashboard.userscategories.index')->with(['allCategories'=>$allCategories]);
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
        'userCategoryName' => 'required|unique:users_categories|max:255',
    ]);
    // // create project instance
    $user = new UsersCategories;
    $user->userCategoryName = $request->input('userCategoryName');
    $user->save();
    return redirect()->route('userscategories.index')->with('success','تم أضافة المجموعة بنجاحة    ');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $data = UsersCategories::find($id);
    return view('dashboard.userscategories.edit')->with(['data'=>$data]);
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
        'userCategoryName' => 'required|unique:users_categories|max:255',
    ]);
    \DB::table('users_categories')
    ->where('userCategoryId',$id)
    ->update([
      'userCategoryName'=> $request->input('userCategoryName')
    ]);
    return redirect()->route('userscategories.index')->with('success','تم  تحديث المجموعة بنجاح     ');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    if(intval($id)){
      \DB::table('users_categories')
      ->where('userCategoryId',$id)
      ->delete();
    }
    return redirect()->route('userscategories.index')->with('success','تم حذف المجموعة بنجاح ');
  }
}
