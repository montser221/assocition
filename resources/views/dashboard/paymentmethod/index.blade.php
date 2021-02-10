@extends('dashboard.index')
@section('title','إدرة طرق الدفع   ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item " aria-current="page"> <a href="{{route('projects.index')}}">إدارة  المشاريع </a></li>
      <li class="breadcrumb-item active "  > <a href="{{route('paymentmethod.index')}}"> إدرة طرق الدفع  </a></li>
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
              <!-- Button trigger modal Create New paymentmethod -->
          <button data-toggle="modal" data-target="#createPaymentMethod" type="button" class="btn text-orange text-white " name="button">  <i class="fa fa-plus "></i> &nbsp;&nbsp; أنشاء </a>
        </div>

      </div>

      <!-- Modal -->
      <div class="modal fade" id="createPaymentMethod" tabindex="-1" data-keyboard="false"  data-backdrop="static" aria-labelledby="createPaymentMethodLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createPaymentMethodLabel">أنشاء طريقة دفع جديدة  </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form  id="create-form" enctype="multipart/form-data" method="post" action="{{route('paymentmethod.store')}}">
                @csrf
                @method('POST')
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="methodName"> البطاقة الائتمانية</label>
                    <input id="inputmethodName" type="text" name="methodName" class="form-control w-40" placeholder="أكتب إسم طريقة الدفع ">
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
                    <textarea class="form-control"  name="methodDesc" rows="5" cols="80" placeholder="الوصف"></textarea>                  </div>
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
            <div class="modal-footer">
                <button type="button" style="margin-right:10%" class="btn text-warning btn-main mr-5" data-dismiss="modal">الغاء</button>
              <button style="width: 12%;" type="submit" class="btn text-orange text-white "> إضافة <i class="fa fa-plus"></i></button>
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
          <th>  طريقة الدفع   </th>
          <th>  الصورة المميزة </th>
          <th>   الوصف   </th>
          <th>   الحالة   </th>
          <th> أحداث  </th>
        </thead>
        <tbody>
          @foreach ($allpaymentmethod as $payment)
            <tr>
              <td>   رقم  {{$payment->methodId}}</td>
              <td>{{  $payment->methodName }}</td>
              <td><img class="img-responsive img-thambnail" style="max-width:40px" src="{{  url('uploads/paymentmethod/'.$payment->methodImage )}}" alt="" /></td>
              <td>{{$payment->methodDesc}}</td>
              <td class="@if ($payment->methodStatus==1) text-success  @else text-danger   @endif">
                @if ($payment->methodStatus==1)
                  تم التفعيل
                @else
                  غير مفعل
                @endif
              </td>
              <td>
                <form class="form-inline" action="{{route('paymentmethod.destroy',$payment->methodId) }}" method="post">
                  @csrf
                  @method("DELETE")
                  <a class="btn  btn-sm ml-1" href="{{route('paymentmethod.edit',$payment->methodId)}}" ><i class="fa fa-edit "></i></a>
                  <button   type="submit" class="btn  btn-sm  btn-project"><i class="fa fa-bank "></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
@endsection
