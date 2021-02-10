@extends('dashboard.index')
@section('title','  فئات المشاريع')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item " aria-current="page"> <a href="{{route('projects.index')}}">إدارة  المشاريع </a></li>
      <li class="breadcrumb-item active" aria-current="page">  فئات المشاريع </li>
    </ol>
    </nav>
    <div class="users">
      <div class="h5"> فئات   المشاريع</div>
      <div class="row " style="margin-bottom:15px">
        <div class="col">
          <form class="" action="" method="post">
            <input type="text" class="form-control" name="" value="">
          </form>
        </div>

        <div class="col offset-lg-8">
          {{-- <a type="button" class="btn  border border-dark " name="button">  <i class="fa fa-upload fa-lg"></i>  تصدير </a>
          <a type="button" class="btn border border-dark  " name="button"> <i class="fa fa-download fa-lg"></i> استيراد </a> --}}
              <!-- Button trigger modal Create New projectcategories -->
          <button data-toggle="modal" data-target="#createProjectCategorey" type="button" class="btn text-orange text-white " name="button">  <i class="fa fa-plus "></i> &nbsp;&nbsp; أنشاء </a>
        </div>

      </div>

      <!-- Modal -->
      <div class="modal fade" id="createProjectCategorey" tabindex="-1" data-keyboard="false"  data-backdrop="static" aria-labelledby="createProjectCategoreyLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createProjectCategoreyLabel">   إنشاء فئة جديدة </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form  id="create-form" enctype="multipart/form-data" method="post" action="{{route('projectcategories.store')}}">
                @csrf
                @method('POST')
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="categoryName">إسم الفئة</label>
                    <input id="inputcategoryName" type="text" name="categoryName" class="form-control" placeholder="أكتب إسم الفئة">
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
              <td>رقم  {{$project->categoryId}} </td>
              <td>{{  $project->categoryName }}</td>
              <td>
                <form class="form-inline" action="{{route('projectcategories.destroy',$project->categoryId) }}" method="post">
                  @csrf
                  @method("DELETE")
                  <a class="btn  btn-sm ml-1" href="{{route('projectcategories.edit',$project->categoryId)}}" ><i class="fa fa-edit "></i></a>
                  <button   type="submit" class="btn  btn-sm  btn-project"><i class="fa fa-bank "></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
@endsection
