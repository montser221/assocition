@extends('dashboard.index')
@section('title',' إدارة أوقات الدوام  ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item active "  > <a href="{{route('attendace.index')}}"> إدارة أوقات الدوام</a></li>
     </ol>
    </nav>
    <div class="users">

      <div class="row " style="margin-bottom:15px">
        <div class="col">
          <form class="" action="" method="post">
            <input type="text" class="form-control" name="" value="">
          </form>
        </div>

        <div class="col offset-lg-8">
          {{-- <a type="button" class="btn border border-dark  " name="button">  <i class="fa fa-upload fa-lg"></i>  تصدير </a>
          <a type="button" class="btn border border-dark " name="button"> <i class="fa fa-download fa-lg"></i> استيراد </a> --}}
              <!-- Button trigger modal Create New attendace -->
          <button data-toggle="modal" data-target="#createAttendace" type="button" class="btn text-orange text-white " name="button">  <i class="fa fa-plus "></i> &nbsp;&nbsp; أنشاء </a>
        </div>

      </div>

      <!-- Modal -->
      <div class="modal fade" id="createAttendace" tabindex="-1" data-keyboard="false"  data-backdrop="static" aria-labelledby="createAttendaceLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createAttendaceLabel"> أضافة أوقات الدوام </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form  id="create-form" enctype="multipart/form-data" method="post" action="{{route('attendace.store')}}">
                @csrf
                @method('POST')
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="day"> اليوم  </label>
                   {{--  <input id="day" type="text" name="day" class="form-control w-40" placeholder="أكتب  اليوم     "> --}}
                    <select name="day" class="form-control mb-3" style="    padding: 0px;"> 
                      <option >أختر اليوم</option>
                      <option value="0">السبت</option>
                      <option value="1">الأحد</option>
                      <option value="2">الأثنين</option>
                      <option value="3"> الثلاثاء</option>
                      <option value="4">الأربعاء</option>
                      <option value="5">الخميس</option>
                      <option value="6">الجمعة</option>
                    </select>
                  </div>

                </div>
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="startAt"> بداية الدوام   </label>
                    <input style="margin-right: 10%; width:80%;" id="startAt" type="time" name="startAt" placeholder="بداية الدوام" class="form-control w-80"  >
                  </div>
                </div>
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="startAt"> نهاية الدوام   </label>
                    <input style="margin-right: 10%; width:80%;"  id="endAt" type="time" name="endAt" placeholder="نهاية الدوام" class="form-control w-80"  >
                  </div>
                </div>
                <div class="form-row">
                  <div class="col" style="margin-top:8%">
                    <div class="form-check">
                      <label class="form-check-label" for="attendaceStatus">
                        <input class="form-check-input" type="radio" name="attendaceStatus" id="attendaceStatus" value="1"  >
                        تفعيل
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label" for="attendaceStatus">
                        <input class="form-check-input" type="radio" name="attendaceStatus" id="attendaceStatus" value="0"  >
                     الغاء
                      </label>
                    </div>
                </div>
                </div>
            <div class="modal-footer">
              <button type="button"  style="margin-right:8%;"  class="btn text-warning btn-main" data-dismiss="modal">الغاء</button>
              <button  type="submit" class="btn text-orange text-white "> إضافة <i class="fa fa-plus"></i></button>
            </div>
          </form>
          </div>
        </div>
      </div
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
          <th>  اليوم </th>
          <th> بداية الدوام </th>
          <th>نهاية الدوام </th>
          <th>الحالة   </th>
          <th> أحداث  </th>
        </thead>
        <tbody>
          @foreach ($allattendace as $attendace)
            <tr>
              <td>  {{$attendace->attendaceId}} </td>
              <td>
                @if($attendace->day==0)
                السبت
                @endif
                @if($attendace->day==1)
                الأحد
                @endif
                @if($attendace->day==2)
                الأثنين
                @endif
                @if($attendace->day==3)
                الأثلاثاء
                @endif
                
                @if($attendace->day==4)
                الأربعاء
                @endif
                @if($attendace->day==5)
                الخميس
                @endif
                
                @if($attendace->day==6)
                الجمعة
                @endif
                
              </td>
              <td>{{  $attendace->startAt }}</td>
              <td>{{  $attendace->endAt }}</td>
              <td class="@if ( $attendace->attendaceStatus ==1) text-success  @else text-danger   @endif">
                @if ( $attendace->attendaceStatus ==1)
                  تم التفعيل
                @else
                  غير مفعل
                @endif
              </td>

               <td>
                <form class="form-inline" action="{{route('attendace.destroy',$attendace->attendaceId) }}" method="post">
                  @csrf
                  @method("DELETE")
                  <a class="btn  btn-sm ml-1" href="{{route('attendace.edit',$attendace->attendaceId)}}" ><i class="fa fa-edit "></i></a>
                  <button   type="submit" class="btn  btn-sm  btn-project"><i class="fa fa-bank "></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
@endsection
