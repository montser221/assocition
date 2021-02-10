@extends('dashboard.index')
@section('title',' تعديل   صورة   ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item " aria-current="page"> <a href="{{route('images.index')}}">إدارة  البوم الصور </a></li>
      <li class="breadcrumb-item active">  تعديل   صورة    </li>
    </ol>
    </nav>
    <div class="paymentmethod-edit" style="background-color:#FFF;padding:15px">

      {{-- Errors message --}}
      @include('includes.errors')
      @include('includes.success')
      <h5 class="text-right" style="margin-right:10%">تعديل   صورة   </h5>

      <form  id="user-edit-form" enctype="multipart/form-data"  method="post" action="{{route('images.update',$data->imageId)}}">
        @csrf
          @method('PATCH')
          <div class="form-row">
            <div class="col">
              <label class="label-control" for="imageTitle">عنوان الصورة</label>
              <input id="i" type="text" name="imageTitle" class="form-control w-40" value="{{$data->imageTitle}}" >
            </div>
          </div>
          <div class="form-row">
            <div class="col">
              <label class="label-control" for="imageFile">  ملف الصورة </label>
              <input style="margin-right: 10%;" id="imageFile" type="file" name="imageFile" class="form-control-file w-80" >
            </div>
          </div>
          <div class="form-row">
            <div class="col" style="margin-top:8%">
              <div class="form-check">
                <label class="form-check-label" for="imageStatus">
                  <input class="form-check-input" type="radio" name="imageStatus" id="imageStatus" value="1"  >
                  تفعيل
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label" for="imageStatus">
                  <input class="form-check-input" type="radio" name="imageStatus" id="imageStatus" value="0"  >
               الغاء
                </label>
              </div>
            </div>
          </div>
        <div class="form-row">
            <button type="submit" class="btn text-orange text-white mt-3 " style="width:17%"> حفظ التعديلات <i class="fa fa-save"></i></button>
        </div>
    </form>
    </div>

@endsection
