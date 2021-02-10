@extends('dashboard.index')
@section('title','إدرة   البوم الصور ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item active" aria-current="page"> <a href="{{route('images.index')}}"> إدرة   البوم الصور     </a></li>
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
              <!-- Button trigger modal Create New images -->
          <button data-toggle="modal" data-target="#createImages" type="button" class="btn text-orange text-white " name="button">  <i class="fa fa-plus "></i> &nbsp;&nbsp; أنشاء </a>
        </div>

      </div>

      <!-- Modal -->
      <div class="modal fade" id="createImages" tabindex="-1" data-keyboard="false"  data-backdrop="static" aria-labelledby="createImagesLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createImagesLabel">أضافة  صورة الى الالبوم</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form  id="create-form" enctype="multipart/form-data" method="post" action="{{route('images.store')}}">
                @csrf
                @method('POST')
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="imageTitle">عنوان الصورة</label>
                    <input id="i" type="text" name="imageTitle" class="form-control w-40" placeholder="عنوان الصورة" >
                  </div>
                </div>
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="imageFile">  ملف الصورة </label>
                    <input style="margin-right: 10%;" id="imageFile" type="file" name="imageFile" class="form-control-file w-80" >
                  </div>
                </div>
                <div class="form-row">
                  <div class="col" style="margin-top:8%">
                    <div class="form-check">
                      <label class="form-check-label" for="imageStatus">
                        <input class="form-check-input" type="radio" name="imageStatus" id="imageStatus" value="1"  >
                        تفعيل
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label" for="imageStatus">
                        <input class="form-check-input" type="radio" name="imageStatus" id="imageStatus" value="0"  >
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
          <th> عنوان الصورة   </th>
          <th> الصورة </th>
          <th>  الحالة </th>
          <th> أحداث  </th>
        </thead>
        <tbody>
          @foreach ($allimages as $image)
            <tr>
              <td> رقم  {{$image->imageId}} </td>
              <td>{{  $image->imageTitle }}</td>
              <td><img class="img-responsive img-thambnail" style="max-width:40px" src="storage/{{  $image->imageFile}}" alt="" /></td>

              <td class="@if ($image->imageStatus ==1) text-success  @else text-danger   @endif">
                @if ($image->imageStatus ==1)
                  تم التفعيل
                @else
                  غير مفعل
                @endif
              </td>
              <td>
                <form class="form-inline" action="{{route('images.destroy',$image->imageId) }}" method="post">
                  @csrf
                  @method("DELETE")
                  <a class="btn  btn-sm ml-1" href="{{route('images.edit',$image->imageId)}}" ><i class="fa fa-edit "></i></a>
                  <button   type="submit" class="btn  btn-sm  btn-project"><i class="fa fa-bank "></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
@endsection
