@if($courseData) 
@extends('layouts.app')
@section('title', $courseData->courseName ?? "page not found")
{{-- include header --}}
@include('includes.header')
{{-- include contact page --}}

<!-- Start Contact Us -->
<div class=" project-detail">

    <div class="content mt-2">
      <div class="container zakat-fix">
      <div class="row">
        <div class="col-sm-12">
          <div class="h2 text-center mt-5 main-color">   @if ($courseData)   {{$courseData->courseName ?? ''}} @endif  </div>
            <div class="text-center mt-1 mb-4 line-design"></div>
        </div>
        <div class="col-sm-12 mt-5">
          <div class="row">
            <div class="col-md-8 offset-md-2 p-detail">
            @if ($courseData) 
              <img  style="min-width:350px;max-height:400px;border-radius:5px"
               src="{{ url('storage/'.$courseData->courseImage)}}" class="d-block w-100   fix-ph" alt="">
                <div class="p-name ">
               <span class="text-gray"> إسم الدورة :  {{$courseData->courseName}} </span>
               </div>
               <div class="p-name ">
               <span class="text-gray">   الزمان :  {{$courseData->courseTime}} </span>
               </div>
               <div class="p-name ">
               <span class="text-gray">   التاريخ :  {{$courseData->courseDate}} </span>
               </div>
               <div class="p-name ">
               <span class="text-gray">   المكان :  {{$courseData->courseLocation}} </span>
               </div>
              
               <p style="padding:15px;font-size:1.2rem">
                   <span class="text-gray">   وصف قصير  :    {{$courseData->courseDescription}}  </span> 
                </p>
               <p style="padding:15px;font-size:1.2rem">
                     <span class="text-gray"> محتوى الدورة     :    {{$courseData->courseContent}}  </span> 
                </p>
              @endif
                <hr>
                <div class="p-down">
                  <div class="p-cost mb-5  btn-price">
                    <strong class="text-gray"  style="/*margin-left:2rem*/"  class="d-inline-block">تكلفة الدورة</strong>
                    <button   class="d-inline-block btn btn-active btn-total-cost"  type="button" name="button"> @if($courseData->coursePrice == "free")   مجانية @else مدفوعة  @endif</button>
                  </div>
                  <?php
                  $getallSubscriber = \DB::table('trainning_subscribers')
                    ->where('trainningCourseId',$courseData->courseId)
                    ->count('*');
                  ?>
                  <div class="p-total mb-5">
                    <strong  class="text-gray" style="margin-left:2rem"  class="d-inline-block"> إجمالي المشتركين  </strong>
                    <span class="main-color" style="font-weight:bold;"> {{ $getallSubscriber }} </span>
                  </div>
                  <div class="p-total mb-5">
                    <strong  class="text-gray" style="margin-left:2rem"  class="d-inline-block">  باقي للاشتراك  </strong>
                    <span class="main-color" style="font-weight:bold;"> {{ $courseData->seatCount - $getallSubscriber ?? ''}} خانة </span>
                  </div>
                   <div class="progress mb-5" data-toggle="tooltip"  offset="2" data-placement="bottom" title="{{ $getallSubscriber }} ">
                    <div class="progress-bar" role="progressbar"
                         style="width: {{ $getallSubscriber / $courseData->seatCount * 100}} %;    background-color: #89c64f; " aria-valuenow="25"
                         aria-valuemin="0" aria-valuemax="100"
                          >
                        {{ round($getallSubscriber / $courseData->seatCount * 100)}}%</div>
                  </div>
                  <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ar_AR/sdk.js#xfbml=1&version=v9.0" nonce="rcB6zvfw"></script>
                  <style type="text/css" scoped>
                    .buttons-share a {
                        padding: 11px;
                      }
                       .buttons-share a .fa-facebook {color: #0065bb}
                       .buttons-share a .fa-twitter {color: #3da1f7}
                       .buttons-share a .fa-telegram {color: #509bdc}
                       .buttons-share a .fa-whatsapp {color: #080}
                       @media (max-width:576px){
                        .buttons-share a {padding:0px;}
                         .fa-3x { font-size: 1.8em;}
                       }
                       .detail-error {
                         border:1px solid #ff2424 !important 
                         }
                         .detail-success {
                           border:1px solid green !important;
                         }
                         .suscribe-now {
                           padding: 10px;
                          position: absolute;
                          bottom: -18px;
                          left: 42%;
                          width: 110px;
                          text-align:center;
                          background: #2fa89c;
                          color: FFF;
                          border-radius: 20px;
                         }
                         @media (max-width:576px) {
                         .btn-price {width:100px}
                         }
                  </style>
                  <div class="buttons-share mb-5 d-flext">
                    {{-- <a href="#">
                      <i class="fa fa-facebook fa-3x"></i>
                    </a>        --}}
                    <a  data-toggle="tooltip"  offset="2" data-placement="top" title="مشاركة" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{route("courseDetail",$courseData->courseId ?? null)}}&quote=دورة :- {{$courseData->courseDescription ?? null}}" class="fb-xfbml-parse-ignore"
                    >
                        <!--<i class="fa fa-facebook fa-3x"></i> -->
                        <img style="width: 38px;" src="{{url('design/icons/facebook.png')}}" />
                    </a>
                    <a data-toggle="tooltip"  offset="2" data-placement="top" title="مشاركة" target="_blank" href="https://twitter.com/intent/tweet?url={{route('courseDetail',$courseData->courseId  ?? null)}}&text=دورة :- {{$courseData->courseDescription ?? null }}">
                    <!--<i class="fa fa-twitter fa-3x twitter-share-button"></i>-->
                    <img style="width: 38px;" src="{{url('design/icons/twitter.png')}}" />
                    </a>                   
                    <a data-toggle="tooltip"  offset="2" data-placement="top" title="مشاركة" target="_blank" href="https://t.me/share/url?url={{route("courseDetail",$courseData->courseId  ?? null)}}&text={{$courseData->courseDescription ?? null }}">
                      <!--<i class="fa fa-telegram fa-3x"></i>-->
                      <img style="width: 38px;" src="{{url('design/icons/telegram.png')}}" />
                    </a>                    
                    <a data-toggle="tooltip"  offset="2" data-placement="top" title="مشاركة" target="_blank" href="https://api.whatsapp.com/send?text={{route("courseDetail",$courseData->courseId  ?? null)}} دورة :- {{$courseData->courseDescription ?? null }} " data-action="share/whatsapp/share">
                      <!--<i class="fa fa-whatsapp fa-3x"></i>-->
                        <img style="width: 38px;" src="{{url('design/icons/whatsapp.png')}}" />
                    </a>
                  </div>
                 
                  
                  

                 <a   class="suscribe-now" href="#">أشترك الآن </a>
                
                <!--<div class="basket">-->
                <!--    <a id="btn-basket" class="btn back-main " href="{{route('cart')}}">تبرع الآن</a>-->
                <!--</div>-->

            </div>
            {{-- @include('includes.errors') --}}
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- End Contact Us -->
{{-- @include('includes.ourlocation') --}}

{{-- include footer --}}
@include('includes.footer')
@else
<div class="alert alert-warning text-center " style="font-size:2rem">
 الصفحة غير موجودة عودة الى  <a class="main-color" href="{{ route('/') }}">الصفحة الرئيسية</a>
</div>
@endif