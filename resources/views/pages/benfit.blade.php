@extends('layouts.app')

@section('title','تسجيل عضوية ')

@include('includes.header')
<div class="voluntary">
  <!--Start Banner-->
  <div class="  px-0 banner" id="dulani-banner">
    <div class="dulni-inner">
      <div class="container">
        <div class="page-path">
          <p><a href="{{url("/")}}"> الرئيسية </a>/تسجيل عضوية </p>
        </div>
      </div>
    </div>

  </div>
  <!-- End Banner-->
  <!-- Start Dullani Form-->
    <div class="content mx-auto">
      <div class="container voluntary-fix" id="dulani-form-container">
        <div class="container mt-5 mb-5">
          {{-- @include('includes._errors') --}}
          @include('includes.success')
        </div>
        <h3 class="text-center mt-3 mb-2">  تسجيل عضوية </h3>
        <div class="text-center mt-1 mb-4 line-design"></div>
        <div class="benfit-top nav  nav-tabs d-none  id="myTab" role="tablist"">
          <hr>
         
        </div>
          <form enctype="multipart/form-data" method="post" action="{{route('benfit.store')}}" id="dulani-form">
            @csrf
            @method('POST')
            <div class="mt-3">
              البيانات الشخصية
            </div>
            <hr>
            <div class="form-row">
              <div class="col">
                <label  class="label-control">الاسم</label>
                    <input type="text" autoFocus class="form-control mb-3" value="{{old('firstName')}}" name="firstName"  placeholder="الاسم">
                    @error('firstName')
                      <div class="alert alert-danger">
                        {{$message}}
                      </div>
                    @enderror
              </div>
              <div class="col">
                <label  class="label-control">إسم الاب</label>
                      <input type="text" class="form-control mb-3" value="{{old('fatherName')}}" name="fatherName"  placeholder="إسم الأب">
                       @error('fatherName')
                      <div class="alert alert-danger">
                        {{$message}}
                      </div>
                    @enderror
              </div>

            </div>
            <div class="form-row">
              <div class="col">
                <label  class="label-control">إسم الجد</label>
                    <input type="text" class="form-control mb-3" value="{{old('grandFatherName')}}" name="grandFatherName"  placeholder="إسم الجد">
                      @error('grandFatherName')
                      <div class="alert alert-danger">
                        {{$message}}
                      </div>
                    @enderror
              </div>
              <div class="col">
                <label  class="label-control">الاسم الاخير  </label>
                      <input type="text" class="form-control mb-3" value="{{old('lastName')}}" name="lastName"  placeholder=" الاسم الأخير">
                     @error('lastName')
                      <div class="alert alert-danger">
                        {{$message}}
                      </div>
                    @enderror
              </div>
            </div>
            <div class="form-row">
              
              <div class="col">
                  
                <label  class="label-control">    الحالة الإجتماعية</label>
                    <select 
                    class="form-control mb-3" 
                    name="socialState"
                     style="padding:0 8px 0 0;" placeholder="">
                    
                      <option class=""  disabled selected  >الحالة الإجتماعية </option>
                      <option class="" value="married"   @if (old('socialState') ==  "married")  selected @endif>متزوج</option>
                      <option class="" value="unmarried" @if (old('socialState') ==  "unmarried") selected @endif>أعزب</option>
                    </select>
                     @error('socialState')
                      <div class="alert alert-danger">
                        {{$message}}
                      </div>
                    @enderror
              </div>
              <div class="col">
                <label  class="label-control">رقم الهوية</label>
                      <input 
                      type="name" 
                      class="form-control mb-3"
                       value="{{old('ssnNumber')}}"
                        name="ssnNumber"  
                        placeholder="  رقم الهوية  ">
                      @error('ssnNumber')
                      <div class="alert alert-danger">
                        {{$message}}
                      </div>
                    @enderror
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <label  class="label-control">  الجنسية</label>
                    <input 
                    type="text" 
                    class="form-control mb-3" 
                    value="{{old('natonality')}}"
                     name="natonality"  placeholder=" الجنسية ">
                     @error('natonality')
                      <div class="alert alert-danger">
                        {{$message}}
                      </div>
                    @enderror
              </div>
       
              <div class="col">
                  
                <label  class="label-control">  الجنس</label>
                    <select class="form-control mb-3" 
                     required="required" name="gender" style="padding:0 8px 0 0; ">
                      <option   selected  disabled class="" >الجنس</option>
                      @if (old('gender') ==  "male")  @endif
                      <option class="" value="male"   @if (old('gender') ==  "male")  selected @endif>ذكر</option>
                      <option class="" value="female"   @if (old('gender') ==  "female") selected @endif>أنثى</option>
                    </select>
                     @error('gender')
                      <div class="alert alert-danger">
                        {{$message}}
                      </div>
                    @enderror
              </div>

              {{-- </div> --}}
            </div>
             <div class="form-row">
            <div class="col">
                <label  class="label-control">  إشعار سداد رسوم </label>
                    <input 
                    type="file" 
                    class="form-control mb-3" 
                  
                     name="moneyNotify"  
                     >
                     @error('moneyNotify')
                      <div class="alert alert-danger">
                        {{$message}}
                      </div>
                    @enderror
              </div>
       
              <div class="col">      
                <label  class="label-control">  نوع العضوية</label>
                    <select class="form-control mb-3" 
                     required="required" name="memberType" style="padding:0 8px 0 0; ">
                      <option   selected  disabled class="" >إختار نوع العضوية</option>
                      @if (old('memberType') ==  "volnteerMember") 
                      
                       @endif
                      <option   value="volnteerMember"  
                      @if (old('memberType') ==  "volnteerMember")  selected @endif>عضوية متطوع
                       </option>
                     
                     <option   
                      value="commonMember"   @if (old('memberType') ==  "commonMember") selected @endif>عضوية   جمعية عمومية
                      </option>
                    </select>
                     @error('memberType')
                      <div class="alert alert-danger">
                        {{$message}}
                      </div>
                    @enderror
              </div>
             </div>
            <div class="form-row">
              <div class="col">
                <label  class="label-control">  تاريخ الميلاد </label>
                    <input type="date"
                     class="form-control mb-3" 
                     value="{{old('birthDate')}}" 
                     style="width:100%;" name="birthDate" 
                      placeholder=" تاريخ الميلاد ">
                      @error('birthDate')
                      <div class="alert alert-danger">
                        {{$message}}
                      </div>
                    @enderror
              </div>

            </div>
            <div class="form-row">
              <div class="col">
                <label  class="label-control">    الوظيفة </label>
                    <input 
                    type="text" 
                    class="form-control mb-3" 
                    value="{{old('jobTitle')}}" 
                    name="jobTitle" 
                     placeholder=" الوظيفة ">
                      @error('jobTitle')
                      <div class="alert alert-danger">
                        {{$message}}
                      </div>
                    @enderror
              </div>
              <div class="col">
                <label  class="label-control">    جهة العمل </label>
                      <input 
                      type="text"
                       class="form-control mb-3"
                        value="{{old('jobEmployer')}}"
                         name="jobEmployer" 
                          placeholder="جهة العمل ">
                    @error('jobEmployer')
                      <div class="alert alert-danger">
                        {{$message}}
                      </div>
                    @enderror
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <label  class="label-control">      عنوان السكن </label>
                    <input 
                    type="text" 
                    class="form-control mb-3"
                     value="{{old('address')}}" 
                     name="address"  
                     placeholder=" عنوان السكن ">
                     @error('address')
                      <div class="alert alert-danger" >
                        {{$message}}
                      </div>
                    @enderror
              </div>
              <div class="col">
                <label  class="label-control">الجوال</label>
                      <input type="text" 
                      class="form-control mb-3" 
                      value="{{old('phone')}}" 
                      name="phone" 
                       placeholder=" الجوال ">
                       @error('phone')
                      <div class="alert alert-danger">
                        {{$message}}
                      </div>
                    @enderror
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <label  class="label-control"> وقت التواصل </label>
                    <input type="text" 
                    class="form-control mb-3" 
                    value="{{old('bestContactTime')}}"
                     name="bestContactTime"  placeholder="  وقت التواصل المفضل   ">
                     @error('bestContactTime')
                      <div class="alert alert-danger">
                        {{$message}}
                      </div>
                    @enderror
              </div>
              <div class="col">
                <label  class="label-control">    البريد الإلكتروني  </label>
                      <input type="text" 
                      class="form-control mb-3"
                       value="{{old('email')}}" 
                       name="email"  
                       placeholder=" البريد الإلكتروني ">
                       @error('email')
                      <div class="alert alert-danger"  >
                        {{$message}}
                      </div>
                    @enderror
              </div>
            </div>
              <button class="btn btn-main-color btn-lg position-fix  mx-auto" type="submit">إرسال</button>
          </form>
      </div>
  </div>
  <!-- // End Dullani Form-->


    </div>
</div>
{{-- @include('includes.ourlocation') --}}

@section('footer')
  @include('includes.footer')
@endsection