@extends('dashboard.index')
@section('title','إدارة مجموعات المستخدمين  ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item"><a href="{{route("users.index")}}">   إدارة  المستخدمين   </a></li>
      <li class="breadcrumb-item active" aria-current="page"> <a href="{{route("userscategories.index")}}"> إدارة مجموعات المستخدمين </a></li>
    </ol>
    </nav>
    <div class="users">
      <div class="h5"> مجموعات المستخدمين</div>
      <div class="row " style="margin-bottom:15px">
        <div class="col">
          <form class="" action="" method="post">
            <input type="text" class="form-control" name="" value="">
          </form>
        </div>

        <div class="col offset-lg-8">
          {{-- <a type="button" class="btn   " name="button">  <i class="fa fa-upload fa-lg"></i>  تصدير </a>
          <a type="button" class="btn   " name="button"> <i class="fa fa-download fa-lg"></i> استيراد </a> --}}
              <!-- Button trigger modal Create New userscategories -->
          <button data-toggle="modal" data-target="#createUsersCategorey" type="button" class="btn text-orange text-white " name="button">  <i class="fa fa-plus "></i> &nbsp;&nbsp; أنشاء </a>
        </div>

      </div>

      <!-- Modal -->
      <div class="modal fade" id="createUsersCategorey" tabindex="-1" data-keyboard="false"  data-backdrop="static" aria-labelledby="createUsersCategoreyLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createUsersCategoreyLabel">أنشاء مجموعة جديدة </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form  id="create-form" enctype="multipart/form-data" method="post" action="{{route('userscategories.store')}}">
                @csrf
                @method('POST')
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="userCategoryName">إسم المجموعة</label>
                    <input id="inputuserCategoryName" type="text" name="userCategoryName" class="form-control" placeholder="أكتب إسم المجموعة">
                  </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn text-warning btn-main" data-dismiss="modal">الغاء</button>
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
          <th> اسم المجموعة  </th>
          <th> أحداث  </th>
        </thead>
        <tbody>
          @foreach ($allCategories as $project)
            <tr>
              <td>  رقم {{$project->userCategoryId}} </td>
              <td>{{  $project->userCategoryName }}</td>
              <td>
                <form class="form-inline" action="{{route('userscategories.destroy',$project->userCategoryId) }}" method="post">
                  @csrf
                  @method("DELETE")
                  <a class="btn  btn-sm ml-1" href="{{route('userscategories.edit',$project->userCategoryId)}}" ><i class="fa fa-edit "></i></a>
                  <button   type="submit" class="btn  btn-sm  btn-project"><i class="fa fa-bank "></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
@endsection
