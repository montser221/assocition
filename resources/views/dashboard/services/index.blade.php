@extends('dashboard.index')
@section('title',' إدرة الخدمات  ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item " aria-current="page"> <a href="{{route('projects.index')}}">إدارة  المشاريع </a></li>
      <li class="breadcrumb-item active "  > <a href="{{route('services.index')}}"> إدرة الخدمات  </a></li>
     </ol>
    </nav>
    <div class="services">

      <div class="row " style="margin-bottom:15px">
        <div class="col">
          <form class="" action="" method="post">
            <input type="text" class="form-control" name="" value="">
          </form>
        </div>

        <div class="col offset-lg-8">
          {{-- <a type="button" class="btn border border-dark  " name="button">  <i class="fa fa-upload fa-lg"></i>  تصدير </a>
          <a type="button" class="btn border border-dark " name="button"> <i class="fa fa-download fa-lg"></i> استيراد </a> --}}
              <!-- Button trigger modal Create New services -->
          <button data-toggle="modal" data-target="#createservices" type="button" class="btn text-orange text-white " name="button">  <i class="fa fa-plus "></i> &nbsp;&nbsp; أنشاء </a>
        </div>

      </div>

      <!-- Modal -->
      <div class="modal fade" id="createservices" tabindex="-1" data-keyboard="false"  data-backdrop="static" aria-labelledby="createservicesLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createservicesLabel">أنشاء   خدمة جديدة </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form  id="create-form" enctype="multipart/form-data" method="post" action="{{route('services.store')}}">
                @csrf
                @method('POST')
                <div class="form-row mr-5">
                  <div class="col">
                    <label class="label-control" for="serviceTitle">  العنوان  </label>
                    <input id="inputserviceTitle" type="text" name="serviceTitle" class="form-control w-40" placeholder="أكتب إسم  الخدمة   ">
                  </div>
                </div>
                <div class="form-row mr-5">
                  <div class="col">
                    <label class="label-control" for="serviceText">  نص مختصر  </label>
                      <textarea name="serviceText" class="form-control" rows="6" cols="80"></textarea>
                  </div>
                </div>
                <div class="form-row mr-5">
                  <div class="col">
                    <label class="label-control" for="serviceImage"> الصورة الشخصية </label>
                    <input  id="serviceImage" type="file" name="serviceImage" class="form-control-file w-80"  >
                  </div>
                </div>
                <div class="form-row mr-5">
                  <div class="col">
                    <div class="form-group form-check">
                      <input class="form-check-input" type="checkbox" id="serviceStatus" name="serviceStatus" >
                      <label class="form-check-label" for="serviceStatus" > تفعيل  الخدمة</label>
                    </div>
                  </div>

                </div>
            <div class="modal-footer d-block">
                <button type="button" class="btn text-warning btn-main" data-dismiss="modal">الغاء</button>
              <button style="margin: 0 8%;" type="submit" class="btn text-orange text-white "> إضافة <i class="fa fa-plus"></i></button>
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
          <th>   العنوان   </th>
          <th>   نص مختصر   </th>
          <th>  الصورة الشخصية </th>
          <th>  الحالة   </th>
          <th> أحداث  </th>
        </thead>
        <tbody>
          @foreach ($allservices  as  $service)
            <tr>
              <td>  رقم {{$service->serviceId}} </td>
              <td>{{  $service->serviceTitle }}</td>
              <td>{{  $service->serviceText }}</td>
              <td><img class="img-responsive img-thambnail" style="max-width:40px" src="{{  url('uploads/services/'.$service->serviceImage )}}" alt="" /></td>
              <td class="@if ( $service->serviceStatus ==1) text-success  @else text-danger @endif" >
                @if ( $service->serviceStatus ==1)
                  تم التفعيل
                @else
                  غير مفعلة
                @endif
              </td>
              <td>
                <form class="form-inline" action="{{route('services.destroy',$service->serviceId) }}" method="post">
                  @csrf
                  @method("DELETE")
                  <a class="btn  btn-sm ml-1" href="{{route('services.edit',$service->serviceId)}}" ><i class="fa fa-edit "></i></a>
                  <button   type="submit" class="btn  btn-sm  btn-project"><i class="fa fa-bank "></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
@endsection
