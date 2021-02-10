@extends('dashboard.index')
@section('titleتعديل إدارة  أعضاء مجلس الادارة  ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item " aria-current="page"> <a href="{{route('members.index')}}">إدارة  أعضاء مجلس الادارة </a></li>
      <li class="breadcrumb-item active">   تعديل  أعضاء مجلس الادارة   </li>
    </ol>
    </nav>
    <div class="members-edit" style="background-color:#FFF;padding:15px">

      {{-- Errors message --}}
      @include('includes.errors')
      @include('includes.success')
      <h5 class="text-right" style="margin-right:10%"> تعديل   أعضاء مجلس الادارة    </h5>

      <form  id="user-edit-form" enctype="multipart/form-data"  method="post" action="{{route('members.update',$data->memberId)}}">
        @csrf
          @method('PATCH')
          <div class="form-row">
            <div class="col">
              <label style="margin-right:10%" class="label-control" for="memberName"> الاسم  </label>
              <input style="margin-right:10% ;width:60%;" id="memberName" type="text" name="memberName" class="form-control w-40" value="{{$data->memberName}}">
            </div>

          </div>
          <div class="form-row">
            <div class="col">
              <label class="label-control" for="shortText" style="margin-right: 10%;"> نص  مختصر </label>
              <input  style="margin-right:10% ;width:60%;" id="shortText" type="text" name="shortText" value="{{$data->shortText}}" class="form-control w-80"  >
            </div>
          </div>
              <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="memberEmail">    الايمل </label>
                    <input  style="margin-right:10% ;width:60%;" 
                    id="memberEmail" 
                    type="text" 
                    name="memberEmail" 
                   value="{{$data->memberEmail}}"
                   
                    class="form-control w-80"  >
                  </div>
                </div>
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="memberPhone">  رقم الواتساب   </label>
                    <input  style="margin-right:10% ;width:60%;" 
                    id="memberPhone" 
                    type="text" 
                    name="memberPhone" 
                    value="{{$data->memberPhone }}"  
                   
                    class="form-control w-80"  >
                  </div>
                </div>
          <div class="form-row">
            <div class="col">
              <label class="label-control" for="shortText" style="margin-right: 10%;"> الصورة الشخصية </label>
              <input style="margin-right: 10%; width:60%" id="memberImage" type="file" name="memberImage"   class="form-control w-80"  >
            </div>
          </div>
          <div class="form-row">
            <div class="col" style="margin-top:8%">
              <div class="form-check">
                <label class="form-check-label" for="memberStatus" style="margin-right: 10%;">
                  <input class="form-check-input" type="radio" name="memberStatus" id="memberStatus" value="1"  >
                  تفعيل
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label" for="memberStatus" style="margin-right: 10%;">
                  <input class="form-check-input" type="radio" name="memberStatus" id="memberStatus" value="0"  >
               الغاء
                </label>
              </div>
          </div>
        </div>
        <div class="form-row">
            <button style="margin-right: 10%; "  type="submit" class="btn text-orange text-white mt-3 "> حفظ التعديلات <i class="fa fa-save"></i></button>
        </div>
    </form>
    </div>

@endsection
