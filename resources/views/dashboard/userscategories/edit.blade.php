@extends('dashboard.index')
@section('title',' تعديل مجموعة المستخدمين  ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
        <li class="breadcrumb-item"><a href="{{route("users.index")}}">   إدارة  المستخدمين   </a></li>
        <li class="breadcrumb-item " aria-current="page"> <a href="{{route("userscategories.index")}}"> إدارة مجموعات المستخدمين </a></li>
      <li class="breadcrumb-item active">   تعديل مجموعة المستخدمين  </li>
    </ol>
    </nav>
    <div class="projects-edit">

      {{-- Errors message --}}
      @include('includes.errors')
      @include('includes.success')
      <h5 class="text-right">تعديل  مجموعة المستخدمين </h5>
      <form  id="user-edit-form"  method="post" action="{{route('userscategories.update',$data->userCategoryId)}}">
        @csrf
          @method('PATCH')
          <div class="form-row">
            <div class="col">
              <label class="label-control" for="userCategoryName">إسم المجموعة</label>
              <input id="inputcategoryName" type="text" name="userCategoryName" class="form-control"  value="{{$data->userCategoryName}}">
            </div>
          </div>

        <div class="form-row">
            <button type="submit" class="btn text-orange text-white mt-3 "> حفظ التعديلات <i class="fa fa-save"></i></button>
        </div>
    </form>
    </div>

@endsection
