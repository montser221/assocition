@extends('layouts.app')

@section('title',' الوظائف ')

@include('includes.header')
<div class="dulni">
  <!--Start Banner-->
  <div class="  px-0 banner" id="dulani-banner">
    <div class="dulni-inner">
      <div class="container">
        <div class="page-path">
          <p><a href="{{url("/")}}"> الرئيسية </a>/  الوظائف   </p>
          <div class="h2" style="padding-bottom:100px !important">
            الوظائـــف المتاحة
          </div>
        </div>
      </div>
    </div>

  </div>
        <!-- End Banner-->
        <div class="container mt-5 mb-5">
          {{-- @include('includes._errors') --}}
          @include('includes._success')
        </div>

      <!-- Start Dullani Form-->
        <div class="content mx-auto">
          <div class="container dulni-fix" id="dulani-form-container">
            <h3 class="text-center mt-3 mb-3">     ارسال طلب توظيف</h3>
               <div class="text-center mt-1 mb-4 line-design"></div>
              <form method="post" action="{{route('jobs.store')}}"  enctype="multipart/form-data" id="dulani-form">
                @csrf
                @method('POST')
                  <input type="text" class="form-control mb-3" name="fullName" value="{{old('fullName')}}"   placeholder="الاسم الكامل">
                   @error('fullName')
              <div class="alert alert-danger w-100">
                {{$message}}
              </div>
            @enderror
                  <input type="text" class="form-control mb-3" name="email" value="{{old('email')}}"    placeholder="البريد الالكتروني">
                   @error('email')
              <div class="alert alert-danger w-100">
                {{$message}}
              </div>
            @enderror
                  <input type="number" class="form-control mb-3" name="age" value="{{old('age')}}"    placeholder="العمر">
                 @error('age')
              <div class="alert alert-danger w-100">
                {{$message}}
              </div>
            @enderror
                <select class="form-control mb-3" name="gender" style="padding:0 8px 0 0;">
                  <option class=""  required>الجنس</option>
                  @if (old('gender') ==  "male")  @endif
                  <option class="" value="male"   @if (old('gender') ==  "male")  selected @endif>ذكر</option>
                  <option class="" value="female"   @if (old('gender') ==  "female") selected @endif>أنثى</option>
                </select>
                @error('gender')
                  <div class="alert alert-danger w-100">
                    {{$message}}
                  </div>
                 @enderror
                  <input type="text" class="form-control mb-3"  name="phone" value="{{old('phone')}}"    placeholder="الجوال">
            @error('phone')
              <div class="alert alert-danger w-100">
                {{$message}}
              </div>
            @enderror
                  <input type="text" class="form-control mb-3" name="jobTitle"  value="{{old('jobTitle')}}" requ ired placeholder="الوظيفة">
            @error('jobTitle')
              <div class="alert alert-danger w-100">
                {{$message}}
              </div>
            @enderror
                  <div class="file-fix">
                    <i class="fa fa-upload"></i> <span>أرفع ملف</span><span class="title">ارفع السيرة الذاتية</span>
                    <input type="file" class="form-control form-control-file mb-3 "   name="cv">
              @error('cv')
                <div class="alert alert-danger w-100">
                {{$message}}
              </div>
            @enderror
                  </div>
                  <button class="btn btn-job  btn-lg position-fix  mx-auto" type="submit">إرسال</button>
              </form>
          </div>
      </div>
      <!-- // End Dullani Form-->


    </div>
</div>
{{-- @include('includes.ourlocation') --}}
@include('includes.footer')
