@extends('dashboard.index')
@section('title',' إدارة  أهداف الجمعية')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item  "  > <a href="{{route('goals.index')}}">   إدارة  أهداف الجمعية    </a></li>
      <li class="breadcrumb-item active">  تعديل أهداف الجمعية </li>
    </ol>
    </nav>
    <div class="attendace-edit" style="background-color:#FFF;padding:15px">

      {{-- Errors message --}}
      @include('includes.errors')
      @include('includes.success')
      <h5 class="text-right" style="margin-right:10%">  تعديل  بيانات  الهدف</h5>

      <form  id="user-edit-form" enctype="multipart/form-data"  method="post" action="{{route('goals.update',$data->goalId)}}">
        @csrf
          @method('PATCH')
          <div class="form-row">
            <div class="col">
              <label class="label-control" for="goal" style="margin-right: 10%; "> الهدف  </label>
              <input id="goal" style="margin-right: 10%;  max-width: 50%" type="text" name="goal" class="form-control w-40" value="{{$data->goal}}"   >
            </div>
          </div>


        <div class="form-row">
          <div class="col" style="margin-top:8%">
            <div class="form-check">
              <label class="form-check-label" for="goalStatus"  style="margin-right: 10%; ">
                <input class="form-check-input" type="radio" name="goalStatus" id="goalStatus" value="1"  >
                تفعيل
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label" for="goalStatus"  style="margin-right: 10%; ">
                <input class="form-check-input" type="radio" name="goalStatus" id="goalStatus" value="0"  >
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
