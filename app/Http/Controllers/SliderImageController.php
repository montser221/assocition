<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\SliderImage;
use Storage;
use Image;
class SliderImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $allsliderimages =  SliderImage::latest()->paginate(9);
       return view('dashboard.sliderimages.index',compact('allsliderimages'));
    }
    public function store(Request $request)
    {
      $request->validate([
          'sliderTitle'        => 'required|unique:slider_images|max:255',
          'sliderText'         => 'required',
          'sliderImage'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:14096',
          'sliderLink'        => 'required|url',
      ]);
      // create slider instance
      $slider = new SliderImage;

      // check if slider status checked or not
      if($request->has('sliderStatus')){
          $slider->sliderStatus=1;
      }
      // upload   image and store it in database
      if($request->file('sliderImage')){
          $path = Storage::disk('public_path')->putFile('uploads/sliders', $request->file('sliderImage'));
          $slider->sliderImage='storage/'.$path;
          $image = Image::make(Storage::path($path))->fit(1200,700);
          $image->save();
      }
        // upload  wrapper and store it in database
      $slider->sliderTitle      = $request->input('sliderTitle');
      $slider->sliderText       = $request->input('sliderText');
      $slider->sliderLink       = $request->input('sliderLink');
      $slider->save();
      return redirect()->route('sliderimages.index')->with('success','تم أضافة الملف بنجاح');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data = SliderImage::find($id);
      return view('dashboard.sliderimages.edit')->with(['data'=>$data]);
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
      // check if slider status checked or not
      if($request->has('sliderStatus') )
      {
        \DB::table('slider_images')
        ->where('sliderId',$id)
        ->update([
          'sliderStatus'=>1,
        ]);
      }
      else
      {
        \DB::table('slider_images')
        ->where('sliderId',$id)
        ->update([
          'sliderStatus'=>0,
        ]);
      }
       // upload slider image and store it in database
      if($request->file('sliderImage')){
        Storage::delete(SliderImage::find($id)->sliderImage);
        $path = Storage::disk('public_path')->putFile('uploads/sliders', $request->file('sliderImage'));
        \DB::table('slider_images')
        ->where('sliderId',$id)
        ->update([
          'sliderImage'=> 'storage/'.$path,
        ]);
        $image = Image::make(Storage::path($path))->fit(1200,700);
        $image->save();
    }

    if($request->has('sliderTitle'))
    {
      \DB::table('slider_images')
      ->where('sliderId',$id)
      ->update([
        'sliderTitle'=>$request->input('sliderTitle'),
      ]);
    }

    if($request->has('sliderText'))
    {
      \DB::table('slider_images')
      ->where('sliderId',$id)
      ->update([
        'sliderText'=>$request->input('sliderText'),
      ]);
    }

    if($request->has('sliderLink'))
    {
      \DB::table('slider_images')
      ->where('sliderId',$id)
      ->update([
        'sliderLink'=>$request->input('sliderLink'),
      ]);
    }
     
      return redirect()->route('sliderimages.index')->with('success','تم تحديث  الملف بنجاح ');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // delete slider by id
      if(intval($id)){
        Storage::delete(SliderImage::find($id)->sliderImage);
        \DB::table('slider_images')
        ->where('sliderId',$id)
        ->delete();
      }
      return redirect()->route('sliderimages.index')->with('success','تم حذف الملف بنجاح');
    }
}
