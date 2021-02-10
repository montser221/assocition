@extends('dashboard.index')
@section('title',' إدارة المشاريع  ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item active" aria-current="page">إدارة  المشاريع</li>
    </ol>
    </nav>
    <div class="projects">
      <div class="h5">إدارة المشاريع</div>
      <div class="row " style="margin-bottom:15px">
        <div class="col">
          <form class="" action="" method="post">
            <input type="text" class="form-control" name="" value="">
          </form>
        </div>

        <div class="col offset-md-8">
          {{-- <a type="button" class="btn  border border-dark " name="button">  <i class="fa fa-upload fa-lg"></i>  تصدير </a>
          <a type="button" class="btn  border border-dark " name="button"> <i class="fa fa-download fa-lg"></i> استيراد </a> --}}
              <!-- Button trigger modal Create New Projects -->
          <button data-toggle="modal" data-target="#createProject" type="button" class="btn text-orange text-white " name="button">  <i class="fa fa-plus "></i> &nbsp;&nbsp; أنشاء </a>
        </div>

      </div>

      <!-- Modal -->
      <div class="modal fade" id="createProject" tabindex="-1" data-keyboard="false"  data-backdrop="static" aria-labelledby="createProjectLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createProjectLabel">أنشاء مشروع جديد</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form  id="create-form" enctype="multipart/form-data" method="post" action="{{route('projects.store')}}">
                @csrf
                @method('POST')
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="projectName">إسم المشروع</label>
                    <input id="inputProjectName" type="text" name="projectName" شعautofocus class="form-control" placeholder="أكتب إسم المشروع">
                  </div>
                  <!-- <div class="col">
                    <?php
                      $projectsCategories = App\Models\ProjectsCategories::all();
                      // dd($projectsCategories);
                    ?>
                    <label class="label-control" for="projectCategoryId">الفئة المستهدفة</label>
                    <select class="form-control" name="projectCategoryId" style="padding:0" >
                        <option >أختر المجموعة</option>
                        @foreach ($projectsCategories as $categories)
                          <option  class="form-control" value="{{$categories->categoryId}}">{{$categories->categoryName}}</option>
                        @endforeach
                    </select>
                  </div> -->
                  <div class="col">
                    <label class="label-control" for="projectDesc"> نص مختصر </label>
                    <input type="text" class="form-control" name="projectDesc" placeholder="نص مختصر">
                  </div>
                </div>

                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="projectIcon"> الايقونة</label>
                    <input type="file" name="projectIcon" class="form-control" >
                  </div>
                  <div class="col">
                    <label class="label-control" for="projectImage">صورة مميزة</label>
                    <input type="file" name="projectImage" class="form-control"  >
                  </div>
                  <!--<div class="col">-->
                  <!--  <label class="label-control" for="projectWrapper">الغلاف</label>-->
                  <!--  <input type="file" name="projectWrapper" class="form-control" >-->
                  <!--</div>-->
                </div>

                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="projectText">المحتوى</label>
                    <textarea name="projectText" class="form-control" rows="6" placeholder="أكتب المحتوى هنا"></textarea>
                  </div>
                </div>
                <div class="form-row mt-3">
                  <div class="col">
                    <label class="label-control" for="projectLocation">مكان المشروع</label>
                    <input type="text" name="projectLocation" class="form-control" placeholder="مكان المشروع">
                  </div>
                  <div class="col">
                    <label class="label-control" for="projectCost">التكلفة</label>
                    <input type="text" name="projectCost" class="form-control"  placeholder="10000 SAR">
                  </div>
                  <div class="col">
                    <label class="label-control" for="whatsapp">الواتساب</label>
                    <input type="text" name="whatsapp" class="form-control" placeholder="+966553622542">
                  </div>
                </div>
                <div class="form-row mt-3">

                  <div class="col">
                    <div class="form-group form-check">
                      <input class="form-check-input" type="checkbox" id="projectStatus" name="projectStatus" >
                      <label class="form-check-label" for="projectStatus" > تفعيل المشروع</label>
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
          <th>   المشروع</th>
          <th>    مكان المشروع</th>
          <th>   التكلفة</th>
          <th> الواتساب</th>
          <th>الفئة المستهدفة</th>
          <th>الصورة المميزة</th>
          <!--<th>صورة الغلاف</th>-->
          <th>الايقونة</th>
          <th>مشروع مميز</th>
          <th> الحالة  </th>
          <th> أحداث  </th>
        </thead>
        <tbody>
        <?php $ids = 0?>
          @foreach ($allprojects as $project)
            <?php $ids = 0?>
            <tr>
              <td>  {{$ids}}  </td>
              <td>{{$project->projectName}}</td>
              <td>{{$project->projectLocation}}</td>
              <td>{{$project->projectCost}}</td>
              <td>{{$project->whatsapp}}</td>
              <td>{{ \App\Models\ProjectsCategories::find($project->projectCategoryId)->categoryName}}</td>
              <td> <img style="max-width:40px;max-height:40px" src="{{url("storage/".$project->projectImage)}}" class="special-img" alt=""> </td>
              <!--<td> <img style="max-width:40px;max-height:40px" src="{{url("storage/".$project->projectWrapper)}}" class="wrapper" alt=""> </td>-->
              <td> <img style="max-width:40px;max-height:40px" src="{{url("storage/".$project->projectIcon)}}" class="icon" alt="" /></i> </td>
              <td>نعم</td>
              <td class="@if ($project->projectStatus==1) text-success  @else text-danger   @endif">
                @if ($project->projectStatus==1)
                  تم التفعيل
                @else
                  غير مفعل
                @endif
              </td>
              <td>
                <form class="form-inline" action="{{route('projects.destroy',$project->projectId) }}" method="post">
                  @csrf
                  @method("DELETE")

                  <a class="btn  btn-sm ml-1" href="{{route('projects.edit',$project->projectId)}}" ><i class="fa fa-edit "></i></a>
                  <button   type="submit" class="btn  btn-sm  btn-project"><i class="fa fa-bank "></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="container">
          {{$allprojects->links()}}
      </div>
    </div>
@endsection
