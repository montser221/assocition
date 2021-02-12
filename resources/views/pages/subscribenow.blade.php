@extends('layouts.app')
@section('title','الاشتراك في الدورة التدريبية')
@section('header')
    @include('includes.header')
@stop
@section('content')
  <div class="container  ">
  <h3  class="text-center mb-3">الاشتراك في الدورة   </h3>
  <div class="text-center mt-1 mb-4 line-design mb-5"></div>
 <form 
      style="  width: 35%;margin: auto;"
      method="post" 
      action="{{route('subscribe')}}"  
      enctype="multipart/form-data" 
      id="subrcribe-form">
      @csrf
      @method('POST')
      <label class="label-control text-right">إسم المشترك</label>
        <input 
        type="text" 
        class="form-control mb-3" 
        name="subscriberName" 
        value="{{old('subscriberName')}}"   
        placeholder="إسم المشترك">
          @error('subscriberName')
    <div class="alert alert-danger w-100">
      {{$message}}
    </div>
    @enderror
         <label class="label-control text-right">  البريد الالكتروني</label>
          <input 
          type="text" 
          class="form-control mb-3" 
          name="subscriberEmail" 
          value="{{old('subscriberEmail')}}"    
          placeholder="البريد الالكتروني">
            @error('subscriberEmail')
      <div class="alert alert-danger w-100">
        {{$message}}
      </div>
    @enderror
       <label class="label-control text-right">     تاريخ الميلاد</label>
          <input 
          type="date" 
          class="form-control mb-3" 
          name="subscriberBirthOfDate" value="{{old('subscriberBirthOfDate')}}"   
         >
          @error('subscriberBirthOfDate')
      <div class="alert alert-danger w-100">
        {{$message}}
      </div>
    @enderror
    <label class="label-control text-right"> رقم الهاتف</label>
    <input 
    type="text" 
    class="form-control mb-3"  
    name="subscriberPhone" 
    value="{{old('subscriberPhone')}}"    
    placeholder="رقم الهاتف">
    @error('subscriberPhone')
      <div class="alert alert-danger w-100">
        {{$message}}
      </div>
    @enderror
          <label class="label-control text-right">       كرت العائلة</label>
          <div class="file-fix ">
            <i class="fa fa-upload"></i>  <span class="" style=" font-size:15px !important; top: 3px;right: 16px;">ارفق كرت العائلة</span>
            <input 
            type="file" 
            class="form-control form-control-file mb-3 "
            value="{{ old('subscriberFamilyCard') }}"
            name="subscriberFamilyCard">
      @error('subscriberFamilyCard')
        <div class="alert alert-danger w-100 mb-5">
        {{$message}}
      </div>
    @enderror
          </div>
          <input 
          type="hidden" 
          name="trainningCourseId"
          value="{{ request()->query('cid') }}" />
          
          <input 
          type="hidden" 
          name="cprice"
          value="{{ request()->query('p') }}" />
          @if(request()->query('p')=="paid") 
            {{-- <label class="label-control text-right"> test</label>
            <input 
            type="text" 
            class="form-control mb-3"  
            name="subscriberPhone" 
            value="{{old('subscriberPhone')}}"    
            placeholder="رقم الهاتف">
            @error('subscriberPhone')
              <div class="alert alert-danger w-100">
                {{$message}}
              </div>
            @enderror --}}
          @endif
          <button 
            class="btn btn-job  btn-lg  mb-5   mx-auto" 
            type="submit"
            style="width:120px ;margin-top:5rem"
            >إشتراك</button>
      </form>
  </div>
@stop
@section('footer')
  @include('includes.footer')
@stop

