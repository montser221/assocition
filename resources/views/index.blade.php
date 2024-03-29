@extends('layouts.app')
@section('title','الرئيسية')
@section('header')
    @include('includes.header')
@endsection
@include('includes.success')
@if (session()->has('cart-message'))
    <div class="alert alert-success text-right mb-0" >
      {{ session()->get('cart-message') }} <a class="btn btn-primary" href="{{route('cart')}}"> إذهب الى السلة الان وتبرع</a>
    </div>
@endif
@section('content')
{{-- Start Slider --}}
<div class="slider">
 @error('dnow')
  <div class="col alert alert-danger ">
  {{ $message }}
  </div>
  @enderror
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel"  data-interval="false">
      <div class="carousel-inner">
        @foreach ($allsliderimages->chunk(1) as $imageCollection)
        <div class="carousel-item {{ $loop->first ? 'active' : '' }} ">
        @foreach ($imageCollection as $slider)
        
       <img style="" src="{{ url($slider->sliderImage)}}" class="d-block w-100 slider-image" alt="...">
       <div class="container text-center slider-small" style="border-radius:10px;padding:10px;  position: absolute;top: 50%; left: 20%; width: 790px; background: #baa342;opacity: .7">
       {{-- <div class="container text-center slider-small" style="position: absolute;top: 40%;  left: 6%;"> --}}
         <div class="text-center mb-3 slider-title"  style="color:#fff;font-size:30px">{{ $slider->sliderTitle }} </div>
         <div class="text-center   mb-5 slider-text" style="color:#fff;font-size:20px;  width: 80%; margin: 0 auto;">{{ $slider->sliderText }}</div>
         <a target="_blank" href="{{ $slider->sliderLink }}" 
            class="btn btn-main  text-center slider-btn " 
             > {{ $slider->sliderBtnText }} </a>
             {{--  @if($slider->sliderBtnText == null) نص افتراضي @endif --}}
       </div>
     {{-- @endif --}}
   @endforeach
    </div>
@endforeach
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div> {{-- End Carousel--}}
</div>
<!-- End Slider -->
<section class="about-association">
  <div class="container">
    <hr>
      <p style="padding-bottom: 32px;">مرحبا بك في جمعية عاصم الخيرية    ! <span > <a class="main-color" href="{{route('ourproject')}}">تصفح المبادرات</a> الخيرية للقيام بالتبرع  </span></p>
    <hr>
</div>
</section>
<!-- Start Association -->
 @if(isset($aboutassociation->showInHome) && $aboutassociation->showInHome ==1)
<!-- End Association -->
<!-- Start Word of pricpal -->
<div class="word-of-princpal">
  <div class="container">
    <div class="word-title text-right main-color mb-4">
      <h3>   عن جمعية عاصم الخيرية</h3>
     {{-- <div class="text-right mt-1 mb-4 line-design"></div> --}}
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-6   word-text" style="color:#777">
        {{$aboutassociation->managerWord}}
     </div>
      <div class="col-sm-12  col-md-5 offset-md-1   text-center">
         <video 
            src="{{ url($aboutassociation->associationIcon) }}" 
            controls="true"   
            class="fix-width fix-width-phone"
            >
          </video>
      </div>
    </div>
  </div>
</div>
<!-- End Word of pricpal -->
<!-- Start message And Vison -->
<div class="msg-vison text-center">
  <div class="container text-center">
    <div class="row">
    <div class="col-sm mb-sm-3">
      <div class="back-vison"
       style="background-image: url({{ url($aboutassociation->visonImage) }});"
      >
      <div class="  vison">
        <img src="{{url("uploads/aboutassoiation/".$aboutassociation->visonIcon)}}" alt="">
        <div class="vison-title">
          الرؤية
          <p class="vison-text">
          {{$aboutassociation->vison}}
          </p>
        </div>
      </div>
    </div>
    </div>
      <div class="col-sm mb-sm-3">
      <div class="back-message"
       style="background-image: url({{ url($aboutassociation->messageImage) }});"
      >
      <div class="  message">
        <img src="{{url("uploads/aboutassoiation/".$aboutassociation->messageIcon)}}" alt="">
        <div class="msg-title">
          الرسالة
          <p class="message-text">
              {{$aboutassociation->message}}
          </p>
        </div>
      </div>
    </div>
  </div>
    </div>
  </div>
</div>
<!-- End message And Vison -->
@endif
{{-- Start Our Projects --}}
<div class="our-projects">
  <div class="container">
<?php $show = 0 ?>
@foreach ($allprojects as $project)
  @if ($project->projectStatus==1)
    <?php $show = 1 ?>
  @endif
@endforeach
@if ($show)
    <div class="h2 text-center">من مبادراتنا</div>
     <div class="text-center mt-1 mb-4 line-design"></div>
    <div class="text-center p-fix">مجموعة المبادرات التطوعية التي قامت بها المؤسسة</div>
    <div class="p-buttons">
      <button class="btn btn-light btn-urgent">  كل المبادرات </button>
      <!--<button class="btn btn-light">أخترنا لكم </button>-->
      <!--<button class="btn btn-light"> آخر المبادرات  </button>-->
    </div>
  @endif
    <div id="carouselProjectsIndicators" class="carousel slide" data-ride="carousel" data-interval="false">
    <div class="carousel-inner">
      <div class="row">
    @foreach ($allprojects->chunk(3) as $projectCollection)
      <div class="carousel-item {{ $loop->first ? 'active' :'' }} ">
        @foreach ($projectCollection as $project)
      {{-- <div class="carousel-item active"> --}}
        <div class="item-1 col-md-6 col-sm-12">
          <a href="{{route('projectDetail',$project->projectId)}}">
          <img style=" height: 126px;   max-height: 175px;"  src="{{ url("storage/".$project->projectImage) }}" class="" alt="1" />
          <span class="d-block text-center  main-color">{{$project->projectName ?? ''}}</span>
        </a>
         <p style="font-size:17px;min-height:70px; max-height: 70px;   overflow: auto;">
          {{$project->projectText ?? ''}}
          </p>
          <hr>
          <div class="text-center  mb-3 mt-3  ">
            تكلفة  المبادرة
          </div>
          <div class="btn  btn-lg d-block button-custom btn-active " style="direction: ltr;">
            {{-- 300,0000 SAR --}}
            </strong> {{number_format($project->projectCost,0) ?? 0}} </strong>  <strong> SAR</strong> 
            {{-- 300,0000 SAR --}}
          </div>
          <span   class="d-total-text"  >إجمالي التبرعات</span>
          <div class="denoate-total">
             <strong style="display: inline-block">SAR</strong>
             <strong>
            <?php
            $getAllDenoate = \DB::table('denoate_pay_details')
                                ->where('projectTable',$project->projectId)
                                ->sum('moneyValue');
                                // ->get();
            //echo( number_format($getAllDenoate,0));
            
            ?>
            @if($getAllDenoate >= $project->projectCost ) {{number_format( $project->projectCost ,0)}} @else  {{ number_format( $getAllDenoate ,0)}} @endif
            </strong>
          </div>
          <div class="remain mb-2"  >
            <span style="font-size: 12px; margin-left: 10px;">باقي للتبرع:</span>
             <small style="margin-left: 5px"> SAR</small>
              <small style="margin-left: 5px">   @if($getAllDenoate >= $project->projectCost ) 0 @else {{ $project->projectCost - $getAllDenoate }} @endif </small>
          </div>
      
           <div class="progress mb-5"  data-toggle="tooltip"  offset="2" data-placement="top" title="@if($getAllDenoate >= $project->projectCost ) {{  $project->projectCost }} @else  {{ number_format( $getAllDenoate ,0)}} @endif SAR ">
                    <div class="progress-bar" role="progressbar"

                 style="@if($getAllDenoate > 0)  background-color:#BAA342 !important; @else  background-color:#e9ecef;width:15% !important;  @endif @if($getAllDenoate >= $project->projectCost ) width:100%;  @else  width: {{  round($getAllDenoate / $project->projectCost * 100)  }}%; @endif" aria-valuenow="25"
                 aria-valuemin="0" aria-valuemax="100"
                > @if($getAllDenoate >= $project->projectCost ) 100% @else
                <small     style="color:#32353c;  font-size: 15px;position: absolute;right: 50%;">
                
                 {{  round($getAllDenoate / $project->projectCost * 100) }}% @endif</div>
                </small>
          </div>
           <style type="text/css">
            .our-projects .carousel .carousel-inner .item-1 .project-buttons button 
            {
                border-radius: 30px !important;
                color: #ffffff;
                background-color: #786e42;
                margin-bottom: 10px;
                padding: 7px;
            	min-width: 256px;
                border: 1px solid #786E42 !important;
            }
            ._add_ {
              border: none;
              padding: 8px !important;
              background-color: #BAA342;
              color: #FFF;
              border-radius: 5px;
            }
          </style>
          <div class="project-buttons">
            <small class="d-block text-gray mb-2"> أختيار مبلغ التبرع </small>
            <?php 
                $arr = \App\Models\Arrow::all()->where('projectTable',$project->projectId)->where('arrowStatus',1);
                $count_arr = $arr->count();
                ?>
                @if($count_arr <= 0)
                @else
                 <?php
                  foreach($arr as $a)
                  {?>
            <button    class="c-b btn-active">
                {{ $a->arrowName }} / {{ $a->arrowValue }} ريال
              <input class="arrVal" type="hidden"  value="{{ $a->arrowValue }}" />
            </button> 
             <?php
              }
              ?>
            @endif
          </div>
          <form class="form-m-p" action="{{route('addToCart',$project->projectId)}}" method="post">
          <div class="denoate-now">
              @csrf
              @method('post')
              <input required="required" type="number"  name="denoate"  class="denoate-phone c_c" placeholder="ضع قيمة التبرع هنا">
            <button  id="add-to-basket-project" type="submit" style="border:none;padding:10px" class="_add_" data-toggle="tooltip"  data-placement="bottom" title="إضافة الى السلة">  <i class="fa fa-shopping-basket"></i> </button>
          </form>
        <form class="d-inline-flex dnow-form" action="{{route('addToCartNow',$project->projectId)}}" method="post">
          @csrf
          @method('post')
          <input type="hidden"  name="dnow"  class="dnow" value="" >
          <button  style="padding:10px;border:0" class="btn-denoate projectnow" 
          type="submit">تبرع الآن </button>
        </form>
              <!--<a class="btn-denoate" href="{{route('cart')}}">تبرع الآن</a>-->
          </div>
        </div>
      @endforeach
    </div>
      @endforeach
  </div>
    </div> <!-- End Carousel Inner-->
@if ($show)
    <a class="carousel-control-prev" href="#carouselProjectsIndicators" role="button" data-slide="prev">
      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-right-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
        <path fill-rule="evenodd" d="M5.795 12.456A.5.5 0 0 1 5.5 12V4a.5.5 0 0 1 .832-.374l4.5 4a.5.5 0 0 1 0 .748l-4.5 4a.5.5 0 0 1-.537.082z"/>
      </svg>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselProjectsIndicators" role="button" data-slide="next">
      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-left-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
    <path fill-rule="evenodd" d="M10.205 12.456A.5.5 0 0 0 10.5 12V4a.5.5 0 0 0-.832-.374l-4.5 4a.5.5 0 0 0 0 .748l4.5 4a.5.5 0 0 0 .537.082z"/>
    </svg>      <span class="sr-only">Next</span>
    </a>
@endif
  </div> <!-- end Carousel -->
@if ($show)
<div class="text-center mt-5 ">
  <a href="{{route('ourproject')}}"><button class="btn btn-more">عرض المزيد </button></a>
</div>
@endif
  </div> <!--End container -->
</div>
<br>
{{-- End Our Projects --}}
<!-- Start Our Services -->
<?php
  $show=0;
 ?>
  @foreach ($services as $service)
    @if($service->serviceStatus==1)
      <?php
      $show=1;
       ?>
    @endif
  @endforeach
  @if( $show==1)
<div class="our-services">
  <div class="container">
    <div class="h2 text-center">
      خدماتنـــــــا
    </div>
 <div class="text-center mt-1 mb-4 line-design"></div>
    <div class="service-fix text-center">
      مجموعة الخدمات التطوعية التي تقوم بها المؤسسة
    </div>
    <div class="row">
      @foreach ($services as $service)
      <div class="col-sm-12 col-md-6 col-lg-3 mb-5">
        <div class="service">
          <img class="rounded-circle" src="{{url("uploads/services/".$service->serviceImage)}}" alt="">
          <div class="s-title">
              {{$service->serviceTitle}}
          </div>
          <p class="s-text">
            {{$service->serviceText}}
          </p>
        </div>
      </div>
    @endforeach
    </div>
  </div>
</div>
@endif
<!-- End Our Services -->
{{-- Start Our Courses --}}
<div class="our-projects">
  <div class="container">
    <?php $show = 0 ?>
    @foreach ($courses as $course)
      @if ($course->courseStatus==1)
        <?php $show = 1 ?>
      @endif
    @endforeach
    @if ($show)
      <div class="h2 text-center">  الدورات التدريبية</div>
      <div class="text-center mt-1 mb-4 line-design"></div>
      <div class="text-center p-fix">مجموعة الدورات التدريبية   التي قامت بها المؤسسة</div>
      <div class="p-buttons">
        <button class="btn btn-light btn-urgent">  كل الدورات التدريبية </button>
      </div>
    @endif
    <div id="carouselCourses" class="carousel slide" data-ride="carousel" data-interval="false">
      <div class="carousel-inner">
        <div class="row">
          @foreach ($courses->chunk(3) as $coursesCollection)
          <div class="carousel-item {{ $loop->first ? 'active' :'' }} ">
            @foreach ($coursesCollection as $course)
            <?php
             $getallSubscriber = \DB::table('trainning_subscribers')
                    ->where('trainningCourseId',$course->courseId)
                    ->count('*');
             ?>
              <div class="item-1 col-md-6 col-sm-12">
                <a href="{{route('courseDetail',$course->courseId)}}">
                  <img style=" height: 126px;   max-height: 175px;"  src="{{ url("storage/".$course->courseImage) }}" class="" alt=" " />
                  <span class="d-block text-center  main-color ">{{$course->courseName ?? ''}}</span>
                </a>
                <p style="font-size:18px;min-height:70px; max-height: 70px;   overflow: auto;margin-top:2rem">
                  {{$course->courseDescription ?? ''}}
                </p>
                <div class="remain mb-4" style="justify-content: start" >
                 @if ($course->seatCount - $getallSubscriber == 0)
                      <span style="font-size: 18px; margin-right: 10px; color: #0abd6b;"> أكتمل العدد <i class="fa fa-check fa-2x ml-4 mr-2"></i></span>
                  {{-- <small style="margin-left: 5px">{{ $course->seatCount - $getallSubscriber }} </small> --}}
                  {{-- <small style="margin-left: 5px"> خانة</small> --}}
                  @else
                  <span style="font-size: 12px; margin-left: 10px;">باقي للاشتراك:</span>
                  <small style="margin-left: 5px">{{ $course->seatCount - $getallSubscriber }} </small>
                  <small style="margin-left: 5px"> مقاعد</small>
                  @endif
                </div>
                <div class="links" style="  display: flex;justify-content: space-around;">
                 @if ($course->seatCount - $getallSubscriber == 0)
                  <a class="btn  " style="background: #0abd6b; color: #fff;"  >  أكتمل العدد</a> 
                  @else
                  <a class="btn  " style="background: #BAA342; color: #fff;" href="{{url('subscribenow?cid='.$course->courseId."&p=".$course->coursePrice )}}">إشترك الآن</a> 
                   @endif
                  <a class="btn  " style="background: #BAA342; color: #fff;" href="{{route('courseDetail',$course->courseId)}}">  قراءة المزيد</a> 
                </div>
              </div>  
            @endforeach
          </div> <!--End Carousel Item-->
          @endforeach
        </div> <!--End row -->
      </div> <!--End Carousel Inner --> 
      @if ($show)
    <a class="carousel-control-prev" href="#carouselCourses" role="button" data-slide="prev">
      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-right-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
        <path fill-rule="evenodd" d="M5.795 12.456A.5.5 0 0 1 5.5 12V4a.5.5 0 0 1 .832-.374l4.5 4a.5.5 0 0 1 0 .748l-4.5 4a.5.5 0 0 1-.537.082z"/>
      </svg>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselCourses" role="button" data-slide="next">
      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-left-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
    <path fill-rule="evenodd" d="M10.205 12.456A.5.5 0 0 0 10.5 12V4a.5.5 0 0 0-.832-.374l-4.5 4a.5.5 0 0 0 0 .748l4.5 4a.5.5 0 0 0 .537.082z"/>
    </svg>      <span class="sr-only">Next</span>
    </a>
@endif
    </div>
  </div> <!--End container -->
</div>
{{-- End Our Courses --}}
<!-- Start our achieving -->
<?php $a_view_at_home=0 ?>
      @foreach($statistics as $stat)
       @if($stat->sStatus==1)
        <?php $a_view_at_home=1 ?>
       @endif
      @endforeach
@if($a_view_at_home==1)
<div class="our-achieving">
  <div class="inner">
  <div class="container">
    <div class="h2 text-center mt-4" style="padding-top:30px;color:#786e42;">
      بفضل الله ثم بفضلكم وصل عدد انجازنا
    </div>
    <div class="row mt-4">
      <?php $ani = -1 ?>
      @foreach($statistics as $stat)
      <?php $ani++?>

       @if($stat->sStatus==1)
      <div class="col-sm-3 small-phone">
        <div class="item-1 ani"  >
         <i class="fa fa-plus plus-sign" aria-hidden="true"></i> <span class="animate-{{$ani}}"> {{$stat->sValue}}</span>
        </div>
        <div class="achieve-text  text-center   "   >
           {{$stat->sName}}
        </div>
      </div>
      @endif
      @endforeach
    </div>
  </div>
 </div>
</div>
@endif
<!-- End our achieving -->
{{-- @include('pages.said')  --}}
@include('pages.ourpartner')
<!-- Start Media Libarary -->
<div class="media-libarary">
  <div class="container">
    <div class="h2 text-center mb-2 mt-5 center-phone">المكتبة الاعلامية</div>
    <div class="text-center mt-1 mb-4 line-design"></div>  
    <div class="row">
      <div class="col-sm-12 col-md-3 mt-5 center-phone">
        <img src="{{url("design/image.png")}}" alt="">
        <div class="h4 d-inline mb-5 main-color">  البوم الصور</div>
      <br>
        <hr/>
        <div id="carouselImage" class="carousel slide" data-ride="carousel" data-interval="false"> <!-- Start Carousel -->
          <ol class="carousel-indicators">
            <?php $imagecout=-1; ?>
            @foreach ($images as $img)
              <?php $imagecout++; ?>
              @if($imagecout < 5)
            <li data-target="#carouselImage" data-slide-to="{{$imagecout}}" class="<?php echo $imagecout==0?'active':'' ?>" style="background-image:url(<?php echo  url("storage/".$img->imageFile); ?>);
              background-repeat: no-repeat;background-size: cover;"></li>
              @else
              @endif
            @endforeach
          </ol>
            <?php $z=0 ?>
            <div class="carousel-inner">
              @foreach ($images as $img)
                <?php $z++ ?>
                <div class="carousel-item <?php echo $z==1 ? "active" :''  ?>" id="first-slide">
                  <img style="max-height: 163px;"  src="<?php echo url("storage/".$img->imageFile); ?>" class="d-block w-100"  alt="{{ $img->imageTitle}}">
                </div>
            @endforeach
          </div>
          <a class="carousel-control-prev" href="#carouselImage" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselImage" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div> <!-- End Carousel-->
      </div>
      <div class="col-sm-12 col-md-3  mt-5 center-phone">
        <img src="{{url("design/video.png")}}" alt="">
      <div class="h4 d-inline mb-5 main-color">البوم الفيديو</div>
      <br>
        <hr/>
        <?php $video_count =0 ;?>
          @foreach ($videos as $video)
          <?php $video_count++;?>
            @if($video_count > 4)
              <?php continue ?>
            @else
            <a target="_blank" href="{{$video->videoLink}}">
          <img class="video-icon" src="{{url("uploads/videos/".$video->videoIcon)}}"  alt="">
          <span class="video-title">{{$video->videoTitle}}</span>
        </a>
          <span class="video-shows-count"> <i class="fa fa-eye"></i>
            <span>0</span>
            <span class="video-date">{{ $video->created_at->format('Y-m-d')}}</span>
          </span>
          <br>  
            @endif
          @endforeach
        @if($video_count > 4)
          <div class="showMore" style="font-size: 1.5rem;">
            <a target="_blank" href="{{route('allVideos')}}"> عرض المزيد</a>
          </div>
         @endif
      </div>
      <div class="col-sm-12 col-md-3 versions 4 mt-5 center-phone">
        <img src="{{url("design/pdf.png")}}" alt="">
        <div class="h4 d-inline mb-5 main-color">  دليل الحوكمة </div>
        <br>
        <hr/>
        <?php $file_count =0 ;?>
        @foreach ($files as $file)
        <?php $file_count++;?>
         @if($file_count > 4)
              <?php continue ?>
         @else
          <a target="_blank" href="{{url('storage/'.$file->pdfFile)}}">
            <img  class="version-img" style="" src="{{url("storage/".$file->imageFile)}}" alt="">
          <span class="img-title"> {{ $file->fileTitle }}</span>
          </a>
          <span class="img-shows-count"> <i class="fa fa-download"></i>
            <span>0</span>
            <span class="img-date">{{ $file->created_at->format('Y-m-d') }}</span>
          </span>
          <br>
        @endif
        @endforeach
       @if($file_count > 4)
        <div class="showMore" style="font-size: 1.5rem;">
            <a target="_blank" href="{{route('allFiles')}}"> عرض  المزيد</a>
        </div>
       @endif 
      </div>
             <div class="col-sm-12 col-md-3 versions 4 mt-5 center-phone">
        <img src="{{url("design/pdf.png")}}" alt="">
        <div class="h4 d-inline mb-5 main-color"> التقارير المالية </div>
        <br>
        <hr/>
        <?php $reportfile_count =0 ;?>
        @foreach ($reportFiles as $file)
        <?php $reportfile_count++;?>
         @if($reportfile_count > 4)
              <?php continue ?>
         @else
          <a target="_blank" href="{{url('uploads/reportFiles/'.$file->reportPdfFile)}}">
            <img class="report-img" style="width:60px;height:60px;" src="{{url("uploads/reportFiles/".$file->reportImageFile)}}" alt="">
          <span class="img-title"> {{ $file->reportTitle }}</span>
          </a>
          <span class="img-shows-count"> <i class="fa fa-download"></i>
            <span>0</span>
            <span class="img-date">{{$file->created_at->format('Y-m-d')}}</span>
          </span>
          <br>
        @endif
        @endforeach
       @if($reportfile_count > 4) 
        <div class="showMore" style="font-size: 1.5rem;">
            <a target="_blank" href="{{route('allReportFiles')}}"> عرض  المزيد</a>
        </div>
       @endif
      </div>
    </div>
  </div>
</div>
<!-- End Media Libarary -->
@include('includes.contact')
{{-- @include('includes._ourlocation') --}}
<!-- Start Our Mailing List -->
{{-- <div class="container">
  <div class="our-mailing-list">
    <div class="row">
      <div class="col-md-8">
        <div class="mail-title">
          الاشتراك في القائمة البريدية
        </div>
      </div>
      <div class="col-md-4">
        <form class="form-inline" action="" method="post" onsubmit="return false">
          @csrf
          @method('post')
          <input class="btn-mailing form-control" type="text" placeholder="بريدك الالكتروني" name="mailing-list" value="">
        </form>
      </div>
    </div>
  </div>
</div> --}}
<!-- End Our Mailing List -->
@endsection
@section('footer')
    @include('includes.footer')
@endsection
{{-- @else --}}
  {{-- <div class="alert alert-gray text-center text-danger text-lg">
      الموقع تحت الصيانة
  </div>
@endif --}}