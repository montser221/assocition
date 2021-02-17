@extends('layouts.app')

@section('title','الدورات التدريبية')

@section('header')
    @include('includes.header')
@stop

@section('content')

<style type="text/css">
.our-projects .all-projects 
{
    padding-bottom: 10px;
    padding-bottom: 30px;
    box-shadow: 0px 0px 1px 0px;
    background-color: #FFF;
    box-shadow: #a7a7a766 0px 5px 20px 0px;
    border-radius: 10px;
    margin-top: 5px;
    margin-bottom: 15px;
    margin-left: 15px;
    padding-top: 11px;
    max-width: 30% !important;
}  

 
.our-projects .all-projects img 
{
      max-width: 100%;
} 


@media (max-width:576px)
 {
 
.our-projects .all-projects {
    max-width: 95% !important;
    margin-right: 10px !important;
  }

}
</style>

    <?php $show = 0 ?>
    @foreach ($allcourses as $course)
      @if ($course->courseStatus==1)
        <?php $show = 1 ?>
      @endif
    @endforeach
    @if ($show)
      <div class="h2 text-center">  الدورات التدريبية</div>
      <div class="text-center mt-1 mb-4 line-design"></div>
      <div class="text-center p-fix mb-5" style="color:#ccc">مجموعة الدورات التدريبية   التي قامت بها المؤسسة</div>
    @endif
<div class="our-projects">
<div class="container">
    <div class="row">     
        @foreach ($allcourses as $course)
        <div class="all-projects col-md-4 col-sm-6">
        <?php
            $getallSubscriber = \DB::table('trainning_subscribers')
                ->where('trainningCourseId',$course->courseId)
                ->count('*');
            ?>
        <a href="{{route('courseDetail',$course->courseId)}}">
            <img style="  max-height: 175px;"  src="{{ url("storage/".$course->courseImage) }}" class="" alt=" " />
            <span 
            class="d-block text-center  main-color " 
            style="  margin-top: 2rem; font-size: 20px;">
            {{$course->courseName ?? ''}}</span>
        </a>
        <p 
        style="
        font-size:15px;
        min-height:70px;
         max-height: 70px;   
         overflow: auto;
         margin:2rem">
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
            <small style="margin-left: 5px"> خانة</small>
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
      <br>
    </div>
</div>
</div>
<div class="container mt-5 mb-5">
 {{$allcourses->links()}}
</div>
{{-- End Our Projects --}}
@stop

@section('footer')
  @include('includes.footer')
@stop

