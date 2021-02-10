@extends('dashboard.index')
@section('title',' تعديل فئات المشاريع  ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item " aria-current="page"> <a href="{{route('projects.index')}}">إدارة  المشاريع </a></li>
      <li class="breadcrumb-item active">   تعديل فئات المشاريع  </li>
    </ol>
    </nav>
    <div class="projects-edit" style="background-color:#FFF;padding:15px">

      {{-- Errors message --}}
      @include('includes.errors')
      @include('includes.success')

      <form  id="user-edit-form"  method="post" action="{{route('projectcategories.update',$data->categoryId)}}">
        @csrf
          @method('PATCH')
          <div class="form-row">
            <div class="col">
              <label class="label-control" for="categoryName">إسم الفئة</label>
              <input id="inputcategoryName" type="text" name="categoryName" class="form-control"  value="{{$data->categoryName}}">
            </div>
          </div>

        <div class="form-row">
            <button type="submit" class="btn text-orange text-white mt-3 "> حفظ التعديلات <i class="fa fa-save"></i></button>
        </div>
    </form>
    </div>

@endsection
