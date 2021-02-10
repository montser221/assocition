@extends('dashboard.index')
@section('title','   تعديل  بيانات الخدمة  ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
       <li class="breadcrumb-item  " aria-current="page"> <a href="{{route('services.index')}}"> إدرة  الخدمات    </a></li>
      <li class="breadcrumb-item active">   تعديل  بيانات الخدمة     </li>
    </ol>
    </nav>
    <div class="services-edit" style="background-color:#FFF;padding:15px">

      {{-- Errors message --}}
      @include('includes.errors')
      @include('includes.success')
      <h5 class="text-right" style="margin-right:10%">  تعديل  بيانات الخدمة   </h5>

      <form  id="user-edit-form" enctype="multipart/form-data"  method="post" action="{{route('services.update',$data->serviceId)}}">
        @csrf
          @method('PATCH')
          <div class="form-row mr-5">
            <div class="col">
              <label class="label-control" for="serviceTitle">  العنوان  </label>
              <input id="inputserviceTitle" type="text" name="serviceTitle" class="form-control w-40"  value="{{$data->serviceTitle}}">
            </div>
          </div>
          <div class="form-row mr-5">
            <div class="col">

                <label class="label-control" for="serviceText">  نص مختصر  </label>
                <textarea name="serviceText" class="form-control" rows="6" cols="80">{{$data->serviceText}}</textarea>
            </div>
          </div>
          <div class="form-row mr-5">
            <div class="col">
              <label class="label-control" for="serviceImage"> الصورة الشخصية </label>
              <input  id="serviceImage" type="file" name="serviceImage" class="form-control-file w-80"  >
            </div>
          </div>
          <div class="form-row mr-5">
            <div class="col">
              <div class="form-group form-check mt-5">
                <input class="form-check-input" type="checkbox" id="serviceStatus" name="serviceStatus"    @if ($data->serviceStatus==1) checked="checked"  @else   @endif>
                <label class="form-check-label" for="serviceStatus" > تفعيل  الخدمة</label>
              </div>
            </div>

          </div>
        <div class="form-row">
            <button type="submit" class="btn text-orange text-white mt-3  mr-5"> حفظ التعديلات <i class="fa fa-save"></i></button>
        </div>
    </form>
    </div>

@endsection
