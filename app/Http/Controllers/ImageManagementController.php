<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImageManagement;
use Illuminate\Support\Facades\Storage;
class ImageManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $allimages = ImageManagement::latest()->paginate(10);
        return view('dashboard.images.index')->with(['allimages'=>$allimages]);
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
          'imageTitle'     => 'required|unique:image_management',
          'imageFile'    => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2028',
      ]);
      // // create project instance
      $images = new ImageManagement;

      if ($request->has('imageStatus'))
      {
        $images->imageStatus = $request->input('imageStatus');
      }
      if($request->file('imageFile')){

        $path = \Storage::putFile('uploads/images', $request->file('imageFile'));
        $images->imageFile=$path;
      }

      $images->imageTitle   = $request->input('imageTitle');
      $images->save();
      return redirect()->route('images.index')->with('success','تم أضافة  الصورة الى الالبوم');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data = ImageManagement::find($id);
      return view('dashboard.images.edit')->with(['data'=>$data]);
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

      if($request->file('imageFile')){
        Storage::delete(ImageManagement::find($id)->imageFile);
        $path = Storage::putFile('uploads/images', $request->file('imageFile'));
          \DB::table('image_management')
          ->where('imageId',$id)
          ->update([
            'imageFile'=>$path,
          ]);
      }

      if ($request->has('imageStatus'))
      {
        \DB::table('image_management')
        ->where('imageId',$id)
        ->update([
          'imageStatus'=>$request->input('imageStatus'),
        ]);
      }
      \DB::table('image_management')
      ->where('imageId',$id)
      ->update([
        'imageTitle'=>$request->input('imageTitle'),
      ]);

      return redirect()->route('images.index')->with('success','تم تحديث  الصورة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      \Storage::delete(ImageManagement::find($id)->imageFile);
      // delete project by id
      if(intval($id)){
        \DB::table('image_management')
        ->where('imageId',$id)
        ->delete();
      }
      return redirect()->route('images.index')->with('success','تم حذف الصورة بنجاح  ');
    }
}
