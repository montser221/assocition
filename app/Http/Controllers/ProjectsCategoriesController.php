<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectsCategories;
class ProjectsCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $allCategories = ProjectsCategories::all();
        return view('dashboard.projectcategories.index')->with(['allCategories'=>$allCategories]);
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
          'categoryName' => 'required|unique:projects_categories|max:255',
      ]);
      // // create project instance
      $user = new ProjectsCategories;
      $user->categoryName = $request->input('categoryName');
      $user->save();
      return redirect()->route('projectcategories.index')->with('success','تم أضافة المجموعة بنجاحة    ');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data = ProjectsCategories::find($id);
      return view('dashboard.projectcategories.edit')->with(['data'=>$data]);
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
          'categoryName' => 'required|unique:projects_categories|max:255',
      ]);
      \DB::table('projects_categories')
      ->where('categoryId',$id)
      ->update([
        'categoryName'=> $request->input('categoryName')
      ]);
      return redirect()->route('projectcategories.index')->with('success','تم  تحديث المجموعة بنجاح     ');
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
        \DB::table('projects_categories')
        ->where('categoryId',$id)
        ->delete();
      }
      return redirect()->route('projectcategories.index')->with('success','تم حذف المجموعة بنجاح ');
    }
}
