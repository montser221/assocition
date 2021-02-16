@extends('dashboard.index')
@section('title',' أدارة الاعضاء الاخرين ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item active" aria-current="page"> <a href="{{route('otherfiles.index')}}">   أدارة الاعضاء الاخرين        </a></li>
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
              <!-- Button trigger modal Create New otherfiles -->
          <button data-toggle="modal" data-target="#createfiles" type="button" class="btn text-orange text-white " name="button">  <i class="fa fa-plus "></i> &nbsp;&nbsp; أنشاء </a>
        </div>

      </div>

      <!-- Modal -->
      <div class="modal fade" id="createfiles" tabindex="-1" data-keyboard="false"  data-backdrop="static" aria-labelledby="createfilesLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createfilesLabel">أضافة  بيانات عضو</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form  id="create-form" enctype="multipart/form-data" method="post" action="{{route('otherfiles.store')}}">
                @csrf
                @method('POST')

                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="memName">    الاسم </label>
                    <input id="i" type="text" name="memName" class="form-control w-40" placeholder="  الاسم " >
                  </div>
                </div>
{{-- 
                 <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="memEmail">    الايمل </label>
                    <input id="i" type="text" name="memEmail" class="form-control w-40" placeholder="  الايمل " >
                  </div>
                </div>
                 <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="memPhone">     الهاتف </label>
                    <input id="i" type="text" name="memPhone" class="form-control w-40" placeholder=" الهاتف   " >
                  </div>
                </div> --}}
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="memFile">  الملف      </label>
                    <input style="margin-right: 10%;" id="memFile" type="file" name="memFile" class="form-control-file w-80" >
                  </div>
                </div>
                <div class="form-row">
                  <div class="col" style="margin-top:8%">
                    <div class="form-check">
                      <label class="form-check-label" for="memStatus">
                        <input class="form-check-input" type="radio" name="memStatus" id="memStatus" value="1"  >
                        تفعيل
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label" for="memStatus">
                        <input class="form-check-input" type="radio" name="memStatus" id="memStatus" value="0"  >
                     الغاء
                      </label>
                    </div>
                  </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn text-warning btn-main mr-5" data-dismiss="modal">الغاء</button>
              <button style="width: 12%;margin: 0 8%;" type="submit" class="btn text-orange text-white "> إضافة <i class="fa fa-plus"></i></button>
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
          <th> الاسم </th>
          {{-- <th> الايمل </th> --}}
          {{-- <th>  الهاتف   </th> --}}
          <th> الملف  </th>
          <th>  الحالة </th>
          <th> أحداث  </th>
        </thead>
        <tbody>
          @foreach ($allfiles as $file)
            <tr>
              <td>  رقم  {{$file->memId}} </td>
              <td>{{  $file->memName }}</td>
              {{-- <td>{{  $file->memEmail }}</td> --}}
              {{-- <td>{{  $file->memPhone }}</td> --}}
              <td> <a class="main-color" href="storage/app/{{ $file->memFile }}"> رابط الملف </a> </td>
              <td class="@if ($file->memStatus ==1) text-success  @else text-danger   @endif">
                @if ($file->memStatus ==1)
                  تم التفعيل
                @else
                  غير مفعل
                @endif
              </td>
              <td>
                <form class="form-inline" action="{{route('otherfiles.destroy',$file->memId ) }}" method="post">
                  @csrf
                  @method("DELETE")
                  <a class="btn  btn-sm ml-1" href="{{route('otherfiles.edit',$file->memId)}}" ><i class="fa fa-edit "></i></a>
                  <button   type="submit" class="btn  btn-sm  btn-project"><i class="fa fa-bank "></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $allfiles->links() }}
    </div>
@endsection
