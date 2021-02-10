@extends('layouts.app')

@section('title','  ألبوم الفيديو ')

@include('includes.header')
<div class="dulni">
  <!--Start Banner-->
  <div class="  px-0 banner" id="dulani-banner">
    <div class="dulni-inner">
      <div class="container">
        <div class="page-path">
          <p><a href="{{url("/")}}"> الرئيسية </a>/  ألبوم الفيديو </p>
        </div>
      </div>
    </div>

  </div>
        <!-- End Banner-->

      <!-- Start Dullani Form-->
        <div class="allvideos mx-auto">
          <div class="container" id="dulani-form-container">
            
            <h3 class="text-center mt-5 mb-2  main-color"> البوم الفيديو  </h3>
            <div class="text-center mt-1 mb-4 line-design"></div>
              <div class="row mb-5 center-phone">
                
                @foreach ($videos as $video)
                  <div class="col-sm-12 col-md-4 4 mt-5">
                    <a class="d-block" target="_blank" href="{{$video->videoLink}}">
                    <img src="{{url("uploads/videos/".$video->videoIcon)}}" alt="" style="    width: 100px;">
                    <span class="video-title"  style=" display: block; margin-right: 15px; margin-top: 14px; margin-bottom: 15px;">{{$video->videoTitle}}</span>
                    </a>
                    <span class="video-shows-count"> <i class="fa fa-eye"></i>
                    <span>0</span>
                    <span class="video-date">{{ $video->created_at->format('Y-m-d')}}</span>
                    </span>
                    <br>  
                  </div>     
                @endforeach
              </div>
         
          
          </div>
      </div>
    </div>
</div>
{{-- @include('includes.ourlocation') --}}
@include('includes.footer')
