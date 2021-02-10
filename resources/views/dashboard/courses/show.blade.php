@extends('dashboard.index')
@section('title','تفاصيل الدورة التدريبية')
@section('dashboard-content')
  <div class="panel panel-default mt-5 mr-5">
  <div class="panel-heading">
    <h3 class="panel-title">تفاصيل الدورة التدريبية </h3>
  </div>
  <div class="panel-body">
   <table class="table table-hover table-bordered">
{{--  'courseName','courseDescription','courseContent',
        'courseImage','courseDate','courseLocation',
        'seatCount','courseStatus','created_at','updated_at' --}}
    <thead>
     <th>الاسم</th>
     <th>  الزمان </th>
     <th>  التاريخ </th>
     <th>المكان </th>
     <th>  وصف قصير</th>
     <th> عدد المقاعد </th>
     <th>   السعر </th>
     <th>  الحالة </th>
     <th> المحتوى     </th>
     <th>  التفعيل </th>
    </thead>
    <tbody>
    <tr>
    <td>{{ $data->courseName }}</td>
    <td>{{ $data->courseTime }}</td>
    <td>{{ $data->courseDate }}</td>
    <td>{{ $data->courseLocation }}</td>
    <td>{{ $data->courseDescription }}</td>
    <td>{{ $data->seatCount }}</td>
    <td>@if($data->coursePrice == "free")  مجانية @else مدفوعة @endif</td>
    <td>@if($data->courseState == "expired") منتهية  @elseif($data->courseState == "starting") سارية @else لم تبدأ  @endif </td>
    <td>{{ $data->courseContent }}</td>
   <td class="@if ($data->courseStatus==1) text-success  @else text-danger   @endif">
                @if ($data->courseStatus==1)
                  تم التفعيل
                @else
                  غير مفعل
                @endif
              </td>
    </tr>
    </tbody>
   </table>
  </div>
</div>

@endsection