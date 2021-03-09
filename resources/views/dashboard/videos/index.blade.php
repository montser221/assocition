@extends('dashboard.index')
@section('title',' إدارة  الفيديوهات    ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item active "  > <a href="{{route('videos.index')}}"> إدارة الفيديوهات  </a></li>
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
              <!-- Button trigger modal Create New videos -->
          <button data-toggle="modal" data-target="#createVideo" type="button" class="btn text-orange text-white " name="button">  <i class="fa fa-plus "></i> &nbsp;&nbsp; أنشاء </a>
        </div>

      </div>

      <!-- Modal -->
      <div class="modal fade" id="createVideo" tabindex="-1" data-keyboard="false"  data-backdrop="static" aria-labelledby="createVideoLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createVideoLabel"> أضافة  فيديو جديد   </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form  id="create-form" enctype="multipart/form-data" method="post" action="{{route('videos.store')}}">
                @csrf
                @method('POST')
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="videoTitle"> عنوان الفيديو  </label>
                    <input id="videoTitle" type="text" name="videoTitle" class="form-control w-40" placeholder="أكتب عنوان الفيديو">
                  </div>

                </div>
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="videoIcon">  ايقونة الفيديو    </label>
                    <input  style="margin-right: 10%;" id="videoIcon" type="file" name="videoIcon" class="form-control-file w-40" >
                  </div>

                </div>
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="videoLink"> رابط الفيديو </label>
                    <input style="margin-right: 10%;" id="videoLink" type="text" name="videoLink" placeholder="  رابط الفيديو   " class="form-control w-80"  >
                  </div>
                </div>

                <div class="form-row">
                  <div class="col" style="margin-top:8%">
                    <div class="form-check">
                      <label class="form-check-label" for="videoStatus">
                        <input class="form-check-input" type="radio" name="videoStatus" id="videoStatus" value="1"  >
                        تفعيل
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label" for="videoStatus">
                        <input class="form-check-input" type="radio" name="videoStatus" id="videoStatus" value="0"  >
                     الغاء
                      </label>
                    </div>
                </div>
                </div>
            <div class="modal-footer">
              <button type="button" class="btn text-warning btn-main" style="margin-right:10%"  data-dismiss="modal">الغاء</button>
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
          <th>  عنوان الفيديو </th>
          <th>  إيقونة الفيديو   </th>
           <th> رابط  الفيديو </th>
          <th>الحالة   </th>
          <th> أحداث  </th>
        </thead>
        <tbody>
          @foreach ($allvideos as $video)
            <tr>
              <td> رقم {{$video->videoId}} </td>
              <td>{{  $video->videoTitle }}</td>
              <td><img class="" src="{{url('uploads/videos/'.$video->videoIcon)}}" style="width: 50px;height: 50px;" alt="" /></td>
              <td> <a class="ml-4" style="color:#333" id="link" target="_blank" href="{{url( $video->videoLink )}}"><i class="fa fa-link " style="color:#ff7612"></i> فتح الرابط</a> <a  class="_copy" id="copy" style="cursor:pointer;color:#333; text-decoration :none;"> <i class="fa fa-copy" style="color:#ff7612"></i>  نسخ الرابط</a> </td>
              <td class="@if ($video->videoStatus==1) text-success  @else text-danger   @endif">
                @if ($video->videoStatus==1)
                  تم التفعيل
                @else
                  غير مفعل
                @endif
              </td>
                <td>
                <form class="form-inline" action="{{route('videos.destroy',$video->videoId) }}" method="post">
                  @csrf
                  @method("DELETE")
                  <a class="btn  btn-sm ml-1" href="{{route('videos.edit',$video->videoId)}}" ><i class="fa fa-edit "></i></a>
                  <button   type="submit" class="btn  btn-sm  btn-project"><i class="fa fa-bank "></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
<div class="container">
      {{$allvideos->links()}}
    </div>
@endsection
