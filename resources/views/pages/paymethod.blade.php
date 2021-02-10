@extends('layouts.app')

@section('title','طرق التبرع')
@include('includes.header')

<div class="paymethod">
  <div class=" px-0 banner" id="basket-banner">
    <div class="pay-Inner">
     <div class="container">
       <div class="page-path">
           <p><a href="{{route('home')}}"> الرئيسية </a>/ طرق التبرع </p>
       </div>
     </div>
   </div>
   </div>
   <!--//Banner-->
  <div class="container">
    <div class="h2 text-center mt-5 main-color">
      طرق التبرع
    </div>
    <div class="text-center mt-1 mb-4 line-design"></div>
    <div class="text-center mt-3 text-gray">
      الطرق الالكترونية للتبرع للمؤسسة
    </div>
    <div class="row">
      @foreach ($paymethod as $method)
      
      <div class="col-md-4 col-sm-6  ">
        <div class="method text-center mt-5">
          <img class="rounded-circle mt-3 mb-4 " style="min-height: 120px;max-height: 120px;max-width:120px;max-height:120px; "  src="{{url('uploads/paymentmethod/'.$method->methodImage	)}}" alt="">
          <div class="title text-center mb-3 mt-3">
        {{$method->methodName}}
          </div>
          <div class="desc mb-4">
          {{$method->methodDesc}}
          </div>
        </div>
      </div>
    @endforeach

    </div>
  </div>
</div>

@include('includes.footer')
