@extends('dashboard.index')
@section('title',' إدارة  الفيديوهات    ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item  "  > <a href="{{route('videos.index')}}"> إدارة الفيديوهات  </a></li>
      <li class="breadcrumb-item active">   تعديل  بيانات الفيديو     </li>
    </ol>
    </nav>
    <div class="attendace-edit" style="background-color:#FFF;padding:15px">

      {{-- Errors message --}}
      @include('includes.errors')
      @include('includes.success')
      <h5 class="text-right" style="margin-right:10%">  تعديل  بيانات الفيديو   </h5>

      <form  id="user-edit-form" enctype="multipart/form-data"  method="post" action="{{route('videos.update',$data->videoId)}}">
        @csrf
          @method('PATCH')
          <div class="form-row">
            <div class="col">
              <label class="label-control" for="videoTitle" style="margin-right: 10%; "> عنوان الفيديو  </label>
              <input id="videoTitle" style="margin-right: 10%;  max-width: 50%" type="text" name="videoTitle" class="form-control w-40" value="{{$data->videoTitle}}"   >
            </div>

          </div>
          <div class="form-row">
            <div class="col">
              <label class="label-control" for="videoIcon">  ايقونة الفيديو    </label>
              <input  style="margin-right: 10%; id="videoIcon" type="file" name="videoIcon" class="form-control-file w-40" >
            </div>

          </div>
          <div class="form-row">
            <div class="col">
              <label class="label-control" for="videoLink"  style="margin-right: 10%; "> رابط الفيديو </label>
              <input style="margin-right: 10%;  max-width: 50% " id="videoLink" type="text" name="videoLink" value="{{$data->videoLink
              }}" class="form-control w-80"  >
            </div>
          </div>

        <div class="form-row">
          <div class="col" style="margin-top:8%">
            <div class="form-check">
              <label class="form-check-label" for="videoStatus"  style="margin-right: 10%; ">
                <input class="form-check-input" type="radio" name="videoStatus" id="videoStatus" value="1"  >
                تفعيل
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label" for="videoStatus"  style="margin-right: 10%; ">
                <input class="form-check-input" type="radio" name="videoStatus" id="videoStatus" value="0"  >
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
