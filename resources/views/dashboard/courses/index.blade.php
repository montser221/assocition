@extends('dashboard.index')
@section('title',' إدارة  الدورات التدريبية  ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item active" aria-current="page">إدارة  الدورات التدريبية</li>
    </ol>
    </nav>
    <div class="courses">
      <div class="h5">إدارة الدورات التدريبية</div>
      <div class="row " style="margin-bottom:15px">
        <div class="col">
          <form class="" action="" method="post">
            <input type="text" class="form-control" name="" value="">
          </form>
        </div>

        <div class="col offset-md-8">
          {{-- <a type="button" class="btn  border border-dark " name="button">  <i class="fa fa-upload fa-lg"></i>  تصدير </a>
          <a type="button" class="btn  border border-dark " name="button"> <i class="fa fa-download fa-lg"></i> استيراد </a> --}}
              <!-- Button trigger modal Create New courses -->
          <button data-toggle="modal" data-target="#createCourses" type="button" class="btn text-orange text-white " name="button">  <i class="fa fa-plus "></i> &nbsp;&nbsp; أنشاء </a>
        </div>

      </div>

      <!-- Modal -->
      <div class="modal fade" id="createCourses" tabindex="-1" data-keyboard="false"  data-backdrop="static" aria-labelledby="createCoursesLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createCoursesLabel">أنشاء  دورة جديدة</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form  id="create-form" enctype="multipart/form-data" method="post" action="{{route('courses.store')}}">
                @csrf
                @method('POST')
                <div class="form-row">
                  <div class="col">

                    <label class="label-control" for="courseName">إسم الدورة</label>
                    <input id="inputcourseName" 
                    type="text" 
                    name="courseName" 
                    autofocus 
                    class="form-control" 
                    placeholder="  إسم الدورة"
                     value="{{ old('courseName') }}"
                    >
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
                        placeholder="  عدد المقاعد  "
                         value="{{ old('seatCount') }}"
                        >
                  </div>
                  <div class="col">
                    <label class="label-control" for="coursePrice">  السعر</label>
                    <select class="form-control" name="coursePrice" style="padding:0">
                      <option disabled selected>أختر سعر الدورة  مدفوعة / مجانية</option>
                      <option value="paid" @if(old('coursePrice') =="paid") selected @endif >مدفوعة</option>
                      <option value="free" @if(old('coursePrice') =="free") selected @endif >مجانية</option>
                    </select>
                  </div>
                  <div class="col">
                    <label class="label-control" for="courseState">  حالة الدورة التدريبية</label>
                    <select class="form-control" name="courseState" style="padding:0">
                      <option disabled selected> أختر حالة الدورة   </option>
                      <option value="notStarting" @if(old('courseState') =="notStarting") selected @endif >لم تبدأ</option>
                      <option value="starting" @if(old('courseState') =="starting") selected @endif>سارية</option>
                      <option value="expired" @if(old('courseState') =="expired") selected @endif>منتهية</option>
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
                         value="{{ old('courseTime') }}"
                        >
                  </div>
                  <div class="col">
                    <label class="label-control" for="courseDate"> التاريخ</label>
                    <input 
                          type="date" 
                          name="courseDate"
                           class="form-control"
                            value="{{ old('courseDate') }}"
                            >
                  </div>
                  <div class="col">
                    <label class="label-control" for="courseLocation">   مكان الدورة  </label>
                    <input 
                          type="text" 
                          name="courseLocation" 
                          class="form-control" 
                          placeholder="   مكان الدورة "
                          value="{{ old('courseLocation') }}">
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
                              placeholder="  نص مختصر"
                              >{{ old('courseDescription') }}</textarea>
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
                              placeholder="محتوى الدورة"
                              >{{ old('courseContent') }}</textarea>
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
                            @if(old('courseStatus') == true)
                               checked="checked"
                            @endif
                             >
                      <label class="form-check-label" for="courseStatus" > تفعيل الدورة</label>
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer d-block">
              <button type="button" class="btn text-warning btn-main" data-dismiss="modal">الغاء</button>
              <button type="submit" class="btn text-orange text-white "> إضافة <i class="fa fa-plus"></i></button>
            </div>
                </form>
          </div>
        </div>
      </div>
      {{-- End Modal Create --}}
       {{-- Errors message --}}
      @include('includes.errors')
      {{-- success message --}}
      @include('includes.success')
      <table class="table table-hover table-bordered">
        <thead>
          <th>#</th>
          <th>   إسم الدورة</th>
          <th> عدد المقاعد</th>
          <th> الزمان</th>
          <th> التاريخ</th>
          <th> المكان</th>
          <th> الحالة  </th>
          <th> أحداث  </th>
        </thead>
        <tbody>
        <?php $ids = 0?>
          @foreach ($allcourses as $course)
            <?php $ids++?>
            <tr>
              <td>  {{$ids}}  </td>
              <td>{{$course->courseName}}</td>
              <td>{{$course->seatCount}}</td>
              <td>{{$course->courseTime}}</td>
              <td>{{$course->courseDate}}</td>
              <td>{{$course->courseLocation}}</td>
              <td class="@if ($course->courseStatus==1) text-success  @else text-danger   @endif">
                @if ($course->courseStatus==1)
                  تم التفعيل
                @else
                  غير مفعل
                @endif
              </td>
              <td>
                <form class="form-inline" action="{{route('courses.destroy',$course->courseId) }}" method="post">
                  @csrf
                  @method("DELETE")

                  <a class="btn  btn-sm ml-1" href="{{route('courses.show',$course->courseId)}}" ><i class="fa fa-eye "></i></a>
                  <a class="btn  btn-sm ml-1" href="{{route('courses.edit',$course->courseId)}}" ><i class="fa fa-edit "></i></a>
                  <button   type="submit" class="btn  btn-sm  btn-project"><i class="fa fa-bank "></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="container">
          {{$allcourses->links()}}
      </div>
    </div>
@endsection
