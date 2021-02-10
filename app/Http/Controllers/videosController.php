<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\video;
class videosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $allvideos = video::latest()->paginate(8);

      return view('dashboard.videos.index')->with(['allvideos'=>$allvideos]);
    }

    public function allVideos ()
    {
      $videos = video::all()->where('videoStatus',1);
      return view('pages.allVideos')->with([
        'videos'=>$videos,
      ]);
    }



    public function store(Request $request)
    {

      $request->validate([
          'videoTitle'         => 'required|unique:videos',
          'videoIcon'         =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2028',
          'videoLink'         => 'required|unique:videos',
      ]);
      // // create project instance
      $video = new video;
      //
      if($request->file('videoIcon')){

          $image_name = time() . rand(1,1000000000000);
          $image_ext = $request->file('videoIcon')->getClientOriginalExtension(); // example: png, jpg ... etc
          $image_full_name = $image_name . '.' . $image_ext;

          $uploads_folder =  getcwd() .'/uploads/videos/';
          if (!file_exists($uploads_folder)) {
              mkdir($uploads_folder, 0777, true);
          }
          $request->file('videoIcon')->move($uploads_folder,    $image_full_name);
          $video->videoIcon=$image_full_name;
      }
      // check if project status checked or not
      if($request->has('videoStatus')){
          $video->videoStatus = $request->input('videoStatus');
      }


      $video->videoTitle       = $request->input('videoTitle');
      $video->videoLink       = $request->input('videoLink');
      $video->save();
      return redirect()->route('videos.index')->with('success','تم أضافة  الفيديو بنجاح   ');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data = video::find($id);
      return view('dashboard.videos.edit')->with(['data'=>$data]);
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
      // return $request->input('videostatus');
        if($request->has('videoStatus'))
        {
          if($request->input('videoStatus')==1)
          {
            \DB::table('videos')
            ->where('videoId',$id)
            ->update([
              'videoStatus'=>1,
            ]);
          }
          else
          {
            \DB::table('videos')
            ->where('videoId',$id)
            ->update([
              'videoStatus'=>0,
            ]);
          }

        }

        if($request->file('videoIcon')){

            $image_name = time() . rand(1,1000000000000);
            $image_ext = $request->file('videoIcon')->getClientOriginalExtension(); // example: png, jpg ... etc
            $image_full_name = $image_name . '.' . $image_ext;

            $uploads_folder =  getcwd() .'/uploads/videos/';
            if (!file_exists($uploads_folder)) {
                mkdir($uploads_folder, 0777, true);
            }
            $request->file('videoIcon')->move($uploads_folder,    $image_full_name);
            // $images->videoIcon=$image_full_name;
            \DB::table('videos')
            ->where('videoId',$id)
            ->update([
              'videoIcon'=>$request->input('videoIcon'),
            ]);
        }
      \DB::table('videos')
      ->where('videoId',$id)
      ->update([
        'videoTitle'=>$request->input('videoTitle'),
        'videoLink'=>$request->input('fullName'),
      ]);

      return redirect()->route('videos.index')->with('success','تم تحديث  بيانات  الفيديو بنجاح     ');
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
        \DB::table('videos')
        ->where('videoId',$id)
        ->delete();
      }
      return redirect()->route('videos.index')->with('success','تم حذف    الفيديو بنجاح ');
    }
}
