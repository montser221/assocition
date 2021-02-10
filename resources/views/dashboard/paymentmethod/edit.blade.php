@extends('dashboard.index')
@section('title','  تعديل طرق الدفع ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item " aria-current="page"> <a href="{{route('projects.index')}}">إدارة  المشاريع </a></li>
      <li class="breadcrumb-item  " aria-current="page"> <a href="{{route('paymentmethod.index')}}"> إدرة طرق الدفع  </a></li>
      <li class="breadcrumb-item active">   تعديل طرق الدفع   </li>
    </ol>
    </nav>
    <div class="paymentmethod-edit" style="background-color:#FFF;padding:15px">

      {{-- Errors message --}}
      @include('includes.errors')
      @include('includes.success')
      <h5 class="text-right" style="margin-right:10%">تعديل   طرق الدفع   </h5>

      <form  id="user-edit-form" enctype="multipart/form-data"  method="post" action="{{route('paymentmethod.update',$data->methodId)}}">
        @csrf
          @method('PATCH')
          <div class="form-row">
            <div class="col">
              <label class="label-control" for="methodName">  طريقة الدفع</label>
              <input style="width:60%" id="inputmethodName" type="text" name="methodName" class="form-control w-40" value="{{$data->methodName}}" >
            </div>
          </div>

          <div class="form-row">
            <div class="col">
              <label class="label-control" for="methodImage"> الصورة المميزة </label>
              <input style="margin-right: 10%;" id="methodImage" type="file" name="methodImage" class="form-control-file w-80"  >
            </div>
          </div>
          <div class="form-row">
            <div class="col">
              <label class="label-control" for="methodDesc"> الوصف </label>
              <textarea style="margin-right: 10%; width:60%" class="form-control"  name="methodDesc" rows="5" cols="40"  required='required' >{{$data->methodDesc}}</textarea>                  </div>
          </div>
          <div class="form-row">
            <div class="col" style="margin-top:8%">
              <div class="form-check">
                <label class="form-check-label" for="methodStatus">
                  <input class="form-check-input" type="radio" name="methodStatus" id="methodStatus" value="1"  >
                  تفعيل
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label" for="methodStatus">
                  <input class="form-check-input" type="radio" name="methodStatus" id="methodStatus" value="0"  >
                إلغاء
                </label>
              </div>
          </div>
          </div>
        <div class="form-row">
            <button type="submit" style="width:15%" class="btn text-orange text-white mt-3 "> حفظ التعديلات <i class="fa fa-save"></i></button>
        </div>
    </form>
    </div>

@endsection
