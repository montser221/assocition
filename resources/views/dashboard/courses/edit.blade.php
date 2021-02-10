@extends('dashboard.index')
@section('title',' تعديل   الدورة التدريبية  ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item " aria-current="page"> <a href="{{route('courses.index')}}">    الدورات التدريبية  </a></li>
      <li class="breadcrumb-item active">     تعديل   الدورة التدريبية   </li>
    </ol>
    </nav>
    <div class="projects-edit" style="background-color:#FFF;padding:15px">
      {{-- Errors message --}}
      @include('includes.errors')
      @include('includes.success')
      <h5>تعديل   الدورة التدريبية   </h5>

      <form  id="edit-form" enctype="multipart/form-data" method="post" action="{{route('courses.update',$data->courseId)}}">
        @csrf
        @method('PATCH')
       <div class="form-row">
          <div class="col">
            <label class="label-control" for="courseName">إسم الدورة</label>
            <input id="inputcourseName" 
                type="text" 
                name="courseName" 
                autofocus 
                class="form-control" 
                value=" {{ $data->courseName }}">
          </div>
          <div class="col">
            <label class="label-control" for="courseImage">صورة مميزة</label>
            <input type="file" name="courseImage" class="form-control"  >
          </div> 
        </div>
                           
        <div class="form-row mt-3">
          <div class="col">
            <label class="label-control" for="seatCount">   عدد المقاعد</label>
            <input 
            type="text"
              name="seatCount" 
              class="form-control" 
              value=" {{ $data->seatCount }}">
          </div>
          <div class="col">
            <label class="label-control" for="coursePrice">  السعر</label>
            <select class="form-control" name="coursePrice" style="padding:0">
              <option disabled selected>أختر سعر الدورة  مدفوعة / مجانية</option>
              <option value="paid" @if( $data->coursePrice  =="paid") selected @endif >مدفوعة</option>
              <option value="free" @if( $data->coursePrice  =="free") selected @endif >مجانية</option>
            </select>
          </div>
          <div class="col">
            <label class="label-control" for="courseState">  حالة الدورة التدريبية</label>
            <select class="form-control" name="courseState" style="padding:0">
              <option disabled selected> أختر حالة الدورة   </option>
              <option value="notStarting" @if($data->courseState =="notStarting") selected @endif >لم تبدأ</option>
              <option value="starting" @if($data->courseState    =="starting") selected @endif>سارية</option>
              <option value="expired" @if($data->courseState     =="expired") selected @endif>منتهية</option>
            </select>
          </div>
        </div>
        <div class="form-row mt-3">
          <div class="col">
            <label class="label-control" for="courseTime"> الزمان</label>
            <input 
            type="time" 
            name="courseTime" 
            class="form-control"  
            value="{{ $data->courseTime }} ">
            <input type="hidden"  name="olCourseTime" value="{{ $data->courseTime }}" />
          </div>
          <div class="col">
            <label class="label-control" for="courseDate"> التاريخ</label>
            <input 
            type="date" 
            name="courseDate" 
            class="form-control" 
            value="{{ $data->courseDate }}" >
            <input type="hidden"  name="olddate" value="{{ $data->courseDate }}" />
          </div>
          <div class="col">
            <label class="label-control" for="courseLocation">   مكان الدورة  </label>
            <input 
            type="text" 
            name="courseLocation" 
            class="form-control" 
            value=" {{ $data->courseLocation }}">
          </div>
        </div>
        <div class="form-row">
          <div class="col">
            <label class="label-control" for="courseDescription"> نص مختصر </label>
          <textarea 
              class="form-control"  
              name="courseDescription"  
              rows="3" 
              cols="80"
              > 
                  {{ $data->courseDescription }}
            </textarea>
          </div>
        </div>

        <div class="form-row">
          <div class="col">
            <label class="label-control" for="courseContent"> محتوى الدورة</label>
            <textarea 
                class="form-control"  
                name="courseContent"  
                rows="7" 
                cols="80"
                > 
                {{ $data->courseContent }}
            </textarea>
          </div>
        </div>
        <div class="form-row mt-3">

          <div class="col">
            <div class="form-group form-check">
              <input 
              class="form-check-input" 
              type="checkbox" 
              id="courseStatus" 
              name="courseStatus" 
              @if ($data->courseStatus==1) checked="checked" @else  @endif >
              <label class="form-check-label" for="courseStatus" > تفعيل الدورة</label>
            </div>
          </div>
        </div>
        <div class="form-row">
           <button type="submit" class="btn text-orange text-white "> حفظ التعديلات <i class="fa fa-save"></i></button>
        </div>
    </form>
    </div>
    {{-- Start Modal Edit --}}
    {{-- End Modal Edit --}}
@endsection
