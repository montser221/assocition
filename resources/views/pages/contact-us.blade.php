@extends('layouts.app')
@section('title','   الاتصال بالجمعية')
{{-- include header --}}
@include('includes.header')
{{-- include contact page --}}

<!-- Start Contact Us -->
<div class="contact">
  <div class=" px-0 banner" id="basket-banner">
    <div class="pay-Inner">
     <div class="container">
       <div class="page-path">
           <p><a href="{{route('home')}}"> الرئيسية </a> تواصل معنا   </p>
           <div class="h2" style="padding-bottom: 100px !important;">
             الاتصال بالمؤسسة
           </div>
       </div>
     </div>
   </div>
   </div>
   <!--//Banner-->
  <div class="container">
    <div class="contact-us">
    
      <div class="row">
        <div class="col-sm-6">
         
          <div class="h2 text-right center-phone">تواصل معنا  </div>
          <div class="word-title text-center center-phone">
           <div class="text-center mt-1 mb-4 line-design-right"></div>
              {{-- <div class="text-right mt-3 mb-4 center-phone"><img src="{{url('design/shape.png')}}"></div> --}}

          </div>
           @include('includes.success')
          <div class="short-text text-gray mb-2">
            تواصل معنا لأي استفسار على الخدمات التكافلية الخيرية التي
          </div>
        </div>
        <div class="col-sm-6">
          <form class="form-contact" action="{{route('contact.store')}}" method="post">
            @csrf
            @method('POST')
            <div class="form-group">
              <Select name="msgType" class="form-control p-0" autoFocus  >
                <option disabled selected >نوع الرسالة</option>
                <option @if (old('msgType') =="complaint") selected @endif  value="complaint"> شكوى</option>
                <option @if (old('msgType') == "suggist") selected @endif value="suggist">إقتراح</option>
                <option @if (old('msgType') == "inquire") selected @endif value="inquire">استفسار</option>
              </Select>
               @error('msgType')
              <div class="alert alert-danger mt-2">
                {{$message}}
              </div>
            @enderror
            </div>
            <div class="form-inline">
              <input 
                  class="form-control w-49  fullname"   
                  type="text" 
                  placeholder="الاسم الكامل"  
                  value="{{old('fullName')}}" 
                  name="fullName"  >
              @error('fullName')
              <div class="alert alert-danger mt-2">
                {{$message}}
              </div>
            @enderror
              <input 
              class="form-control w-49  email"  
              type="text" 
              placeholder="البريد الالكتروني" 
              value="{{old('email')}}" 
              name="email"  >
             @error('email')
              <div class="alert alert-danger mt-2">
                {{$message}}
              </div>
            @enderror
            </div>
            <div class="form-group">
              <input class="form-control w-100"  type="text" placeholder="الموضوع" value="{{old('topic')}}" name="topic"  >
              @error('topic')
              <div class="alert alert-danger mt-2">
                {{$message}}
              </div>
            @enderror
            </div>
            <div class="form-group">
              <textarea class="form-control w-100"  name="msg" placeholder="اكتب الرسالة هنا..." rows="" cols="">{{old('msg')}}</textarea>
              @error('msg')
              <div class="alert alert-danger mt-2">
                {{$message}}
              </div>
            @enderror
            </div>
            <input type="submit" class="btn btn-main-color btn-lg btn-contact" name="" value="إرسال">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Contact Us -->
   
{{-- include footer --}}
@include('includes.footer')
