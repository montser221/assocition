@extends('dashboard.index')
@section('title','إدارة أوقات الدوام')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item " aria-current="page"> <a href="{{route('attendace.index')}}">إدارة أوقات الدوام </a></li>
      <li class="breadcrumb-item active">   تعديل  أوقات الدوام     </li>
    </ol>
    </nav>
    <div class="attendace-edit" style="background-color:#FFF;padding:15px"> 

      {{-- Errors message --}}
      @include('includes.errors')
      @include('includes.success')
      <h5 class="text-right" style="margin-right:10%"> تعديل  أوقات الدوام  </h5>

      <form  id="user-edit-form" enctype="multipart/form-data"  method="post" action="{{route('attendace.update',$data[0]->attendaceId)}}">
        @csrf
          @method('PATCH')
          <div class="form-row mb-3">
            <div class="col ">
              <label class="label-control" for="day" style="margin-right: 10%; "> اليوم  </label>
              {{-- <input id="day" style="margin-right: 10%;  max-width: 50%" type="text" name="day" class="form-control w-40" value="{{$data[0]->day}}"   >
               --}}
                 <select name="day" class="form-control "  style="margin-right: 10%;  max-width: 50% "> 
                      <option >أختر اليوم</option>
                      <option @if($data[0]->day==0) selected @endif value="0">السبت</option>
                      <option @if($data[0]->day==1) selected @endif  value="1">الأحد</option>
                      <option @if($data[0]->day==2) selected @endif  value="2">الأثنين</option>
                      <option @if($data[0]->day==3) selected @endif value="3"> الثلاثاء</option>
                      <option @if($data[0]->day==4) selected @endif value="4">الأربعاء</option>
                      <option @if($data[0]->day==5) selected @endif value="5">الخميس</option>
                      <option @if($data[0]->day==6) selected @endif value="6">الجمعة</option>
                    </select>
            </div>

          </div>

          <div class="form-row mb-3">
            <div class="col">
              <label class="label-control" for="startAt"  style="margin-right: 10%; "> بداية الدوام   </label>
              <input style="margin-right: 10%;  max-width: 50% " id="startAt" type="time" name="startAt" value="{{$data[0]->startAt}}" class="form-control w-80"  >
            </div>
          </div>

          <div class="form-row mb-3">
            <div class="col">
              <label class="label-control" for="startAt"  style="margin-right: 10%; "> نهاية الدوام   </label>
              <input style="margin-right: 10%; max-width: 50%" id="endAt" type="time" name="endAt"  value="{{$data[0]->endAt}}" class="form-control w-80"  >
            </div>
        </div>
        <div class="form-row">
          <div class="col" style="margin-top:8%">
            <div class="form-check">
              <label class="form-check-label" for="attendaceStatus"  style="margin-right: 10%; ">
                <input class="form-check-input" type="radio" name="attendaceStatus" id="attendaceStatus" value="1"  >
                تفعيل
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label" for="attendaceStatus"  style="margin-right: 10%; ">
                <input class="form-check-input" type="radio" name="attendaceStatus" id="attendaceStatus" value="0"  >
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
