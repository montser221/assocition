@extends('layouts.app')

@section('title', __('messages.dulni'))

@include('includes.header')
<div class="dulni">
  <!--Start Banner-->
  <div class="  px-0 banner" id="dulani-banner">
    <div class="dulni-inner">
      <div class="container">
        <div class="page-path">
          <p><a href="{{url("/")}}"> الرئيسية </a>/ {{ __('messages.dulni') }} </p>
        </div>
      </div>
    </div>

  </div>
        <!-- End Banner-->

      <!-- Start Dullani Form-->
        <div class="content mx-auto">
          <div class="container dulni-fix" id="dulani-form-container">
            <div class="container mt-5 mb-5">
              {{-- @include('includes._errors') --}}
              @include('includes._success')
            </div>
            <h3 class="text-center mt-3 mb-2">{{ __('messages.dulni') }}</h3>
            <div class="text-center mt-1 mb-4 line-design"></div>
              <form method="post" action="{{route('dulni.store')}}" id="dulani-form">
                  @csrf
                  @method('post')
                  <input type="name" autoFocus class="form-control mb-3" name="name"   placeholder="الاسم">
                   @error('name')
                      <div class="alert alert-danger">
                        {{$message}}
                      </div>
                    @enderror
                  <input type="text" class="form-control mb-3" name="phone"   placeholder="الجوال">
                   @error('phone')
                      <div class="alert alert-danger">
                        {{$message}}
                      </div>
                    @enderror
                  <input type="text" class="form-control mb-3" name="address"   placeholder="العنوان">
                   @error('address')
                      <div class="alert alert-danger">
                        {{$message}}
                      </div>
                    @enderror
                  <input type="text" class="form-control mb-3" name="needy"   placeholder="أدخل إسم المحتاج">
                  @error('needy')
                      <div class="alert alert-danger">
                        {{$message}}
                      </div>
                    @enderror
                  <textarea class="form-control mb-3" rows="5" placeholder="التفاصيل" name="details"  ></textarea>
                  @error('details')
                      <div class="alert alert-danger">
                        {{$message}}
                      </div>
                    @enderror
                  <button class="btn btn-main-color btn-lg position-fix  mx-auto" type="submit">إرسال</button>
              </form>
          </div>
      </div>
      <!-- // End Dullani Form-->


    </div>
</div>
{{-- @include('includes.ourlocation') --}}
@include('includes.footer')
