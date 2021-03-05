@extends('dashboard.index')
@section('title','    تعديل مبادرة  ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item " aria-current="page"> <a href="{{route('projects.index')}}">إدارة  المشاريع </a></li>
      <li class="breadcrumb-item active">   تعديل مبادرة  </li>
    </ol>
    </nav>
    <div class="projects-edit" style="background-color:#FFF;padding:15px">
      {{-- Errors message --}}
      @include('includes.errors')
      @include('includes.success')
      <h5>تعديل مبادرة </h5>

      <form  id="edit-form" enctype="multipart/form-data" method="post" action="{{route('projects.update',$data->projectId)}}">
        @csrf
        @method('PATCH')
        <div class="form-row">
          <div class="col">
            <label class="label-control" for="projectName">إسم المبادرة</label>
            <input type="text" name="projectName" class="form-control" value="{{$data->projectName}}">
          </div>
        <!--  <div class="col">
            <?php
              $projectsCategories = App\Models\ProjectsCategories::all();
              // dd($projectsCategories);
            ?>
            <label class="label-control" for="projectCategoryId">الفئة المستهدفة</label>
            <select class="form-control" name="projectCategoryId" >
                <option  >أختر المجموعة</option>
                @foreach ($projectsCategories as $categories)
                  <option   class="form-control" @if ($data->projectCategoryId==$categories->categoryId)
                    selected="selected" @endif  value="{{$categories->categoryId}}">{{$categories->categoryName}}</option>
                @endforeach
            </select>
          </div> -->
          <div class="col">
            <label class="label-control" for="projectDesc"> نص مختصر </label>
            <input type="text" class="form-control" name="projectDesc"  value="{{$data->projectDesc}}">
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
            <textarea name="projectText" class="form-control" rows="6">  {{$data->projectText}} </textarea>
          </div>
        </div>
        <div class="form-row mt-3">
          <div class="col">
            <label class="label-control" for="projectLocation">مكان المبادرة</label>
            <input type="text" name="projectLocation" class="form-control"  value="{{$data->projectLocation}}">
          </div>
          <div class="col">
            <label class="label-control" for="projectCost">التكلفة</label>
            <input type="text" name="projectCost"  value="{{$data->projectCost}}" class="form-control" >
          </div>
          <div class="col">
            <label class="label-control" for="whatsapp">الواتساب</label>
            <input type="text" name="whatsapp" class="form-control" value="{{$data->whatsapp}}">
          </div>
        </div>
        <div class="form-row">
          <div class="col">
            <div class="form-group form-check">
              <input class="form-check-input" type="checkbox" id="projectStatus"  @if ($data->projectStatus==1) checked="checked" @else  @endif name="projectStatus" >
              <label class="form-check-label" for="projectStatus" > تفعيل المبادرة</label>
            </div>
          </div>
        </div>
        <div class="form-row">
           <input class="btn btn-secondary ml-2" type="reset" name="" value="تفريغ">
           <button type="submit" class="btn text-orange text-white "> حفظ التعديلات <i class="fa fa-save"></i></button>
        </div>
    </form>
    </div>
    {{-- Start Modal Edit --}}
    {{-- End Modal Edit --}}
@endsection
