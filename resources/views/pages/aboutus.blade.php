@extends('layouts.app')



@section('title','من نحن')



@include('includes.header')



<!-- Start Contact Us -->

<div class="contact about-us" id="about">

  <div class=" px-0 banner" >

    <div class="pay-inner">

     <div class="container">

       <div class="page-path">

           <p><a href="{{route('home')}}"> الرئيسية </a> /  من نحن </p>

           <div class="h2" style="padding-bottom: 100px !important;">

         من نحن

           </div>

       </div>

     </div>

   </div>

   </div>

   <!--//Banner-->

  <div class="">

      <div class="word-of-princpal" id="word">

        <div>

          <div class="word-title text-center container">

       <h3>   عن جمعية عاصم الخيرية</h3>

          <div class="text-center mt-1 mb-4 line-design"></div>
          </div>

          <div class="text-center" style="margin-top: -22px;margin-bottom: 40px;color: #1b8633;">

    

          </div>

          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 word-text" style="color:#777">
              @isset($aboutassociation)
              {{$aboutassociation->managerWord ?? ''}}

            @endisset

            </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End message And Vison -->
  </div>
</div>

<!-- End Contact Us -->
<!-- Start message And Vison -->
<div class="msg-vison" id="msg-vison" style="margin-right: 10%;">
  <div class="container">
    <div class="row">
    <div class="col-sm-12 col-md-5 mb-5">
      <div class="back-vison" 
      style="background-image: url({{ url($aboutassociation->visonImage) }});">
      <div class="  vison">
        @isset($aboutassociation)
        <img src="{{ url("uploads/aboutassoiation/".$aboutassociation->visonIcon ) ?? ''}}" alt="">
      @endisset
        <div class="vison-title">
          الرؤية
          <p class="vison-text">
            @isset($aboutassociation)
            {{$aboutassociation->vison ?? ''}}
          @endisset
          </p>
        </div>
      </div>
    </div>
    </div>
      <div class="col-sm-12 col-md-5 mb-5">
      <div class="back-message"
      style="
        background-image: url(../{{ $aboutassociation->messageImage }});
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
      "
      >
      <div class="  message">
        @isset($aboutassociation)
        <img src="{{url("uploads/aboutassoiation/".$aboutassociation->messageIcon ?? '')}}" alt="">
      @endisset
        <div class="msg-title">
          الرسالة
          <p class="message-text">
        {{$aboutassociation->message ?? ''}}
          </p>
        </div>
      </div>
    </div>
  </div>
    </div>
  </div>
</div>
<!-- End message And Vison -->

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
<div class="our-services mb-5">
  <div class="container">
    <div class="h2 text-center" style="font-size: 3rem !important;">
      خدماتنـــــــا
    </div>
 <div class="text-center mt-1 mb-4 line-design"></div>
    <div class="service-fix text-center">
      مجموعة الخدمات التطوعية التي تقوم بها المؤسسة
    </div>
    <div class="row">
      @foreach ($services as $service)
      <div class="col-sm-3">
        <div class="service">
          <img src="{{url("uploads/services/".$service->serviceImage)}}" alt="">
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
{{--Start our goals --}}
<div class="our-goals mt-5 mb-5">
  <div class="h2 text-center main-color  mb-2" style="font-size: 3rem !important;">
    أهدافنا
  </div>
 <div class="text-center mt-1 mb-4 line-design"></div>
   <div class="container">
    <div class="row">
      @foreach ($goals as $goal)
      <div class="col-11 col-xs-12 col-sm-6 col-md-5">
        <div class="item text-right ">
          <i class="fa fa-check fa-2x ml-4 mr-2"></i>
          <span class="text ">{{$goal->goal}}</span>
        </div>
      </div>
    @endforeach
    </div>
  </div>
</div>
{{-- End our goals --}}

{{-- Start Member --}}
<div class="our-management-member  mb-5" id="member">
  <div class="container">
    <div class="h2 text-center main-color">
      أعضاء مجلس الإدارة
    </div>
    <div class="text-center mt-1 mb-4 line-design"></div>   
    <div class="mt-3 text-center text-gray">
      مجموعة اعظاء مجلس الإدارة
    </div>
    <div class="row">
    <?php $i=0;  ?>
      @foreach ($members as $member)
      <div class="@if($member->memberId==1) col-sm-8 offset-sm-2 @else col-md-4 offset-md-0 @endif  text-center">
        <img class="img-fix mt-5" style="max-width: 150px; width: 130px; height: 130px; max-height:150px; border-radius: 50%" src="{{url('uploads/members/'.$member->memberImage)}}" alt="">
        <div class="contact mt-3 d-inline-flex">
        @if ($member->memberEmail !="")
            <a class="ml-3" target="_blank" href="https://wa.me/{{$member->memberPhone ?? ''}}&text">
           <img style="width: 50px;" src="{{url('design/icons/whatsapp.png')}}" />
          </a>
        @endif
        @if ($member->memberPhone !="")
           <a href="mailto:{{$member->memberEmail}}" 
              style="background-color: #2fa89c;color: #fff;width: 66px;height: 52px;border-radius: 16px;">
            <i class="fa fa-envelope fa-3x" aria-hidden="true"></i>
            </a> 
        @endif 
        </div>
        <div class="h4    mt-4 mb-4"> {{ $member->memberName }}</div>
        <div class="h5 text-center mb-5 main-color"> {{$member->shortText}}</div>
      </div>
    <?php $i++;  ?>
  @endforeach
    </div>
  </div>
</div>
{{-- End Member --}}
{{-- Start work time --}}
<div class="container">
  <div class="work-times  mb-5 mt-5">
    <div class="h2 text-center main-color">
      أوقات العمل في الجمعية
    </div>
    <div class="text-center mt-1 mb-4 line-design"></div>
      <div class="row">
        <div class="col-sm-6 col-md-3 offset-md-1">
          <div class="item-1">
            اليوم
          </div>
        </div>
        <div class=" col-sm-6 ">
          <div class="item-2">
            <i class="fa fa-calendar fa-lg ml-3 main-color"></i> بداية الدوام - نهاية الدوام
          </div>
        </div>
        @foreach ($attendce as $attend)
        <div class="col-sm-6 col-md-3 offset-md-1 ">
          <div class="item-1">
                  @if($attend->day==0)
                السبت
                @endif
                @if($attend->day==1)
                الأحد
                @endif
                @if($attend->day==2)
                الأثنين
                @endif
                @if($attend->day==3)
                الثلاثاء
                @endif
                
                @if($attend->day==4)
                الأربعاء
                @endif
                @if($attend->day==5)
                الخميس
                @endif
                @if($attend->day==6)
                الجمعة
                @endif
          </div>
        </div>
        <div class="col-sm-6   ">
          <div class="item-2">
            <i class="fa fa-calendar fa-lg ml-3 main-color"></i> <span>{{$attend->startAt}}</span> - <span>{{$attend->endAt}}</span>
          </div>
        </div>
      @endforeach
      </div>
  </div>
</div>
{{-- End work time --}}

@include('includes.footer')

