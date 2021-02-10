@extends('dashboard.index')
@section('title',' تعديل مستخدم ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item " aria-current="page"> <a href="{{route("users.index")}}">  إدارة  المستخدمين </a></li>
      <li class="breadcrumb-item active"> تعديل مستخدم </li>
    </ol>
    </nav>

    <div class="users-edit" style="background-color:#FFF;padding:15px">
        {{-- Errors message --}}
        @include('includes.errors')
        @include('includes.success')
        <h5>تعديل مشروع </h5>

        <form  id="edit-form" enctype="multipart/form-data" method="post" action="{{route('users.update',$data->userId)}}">
          @csrf
          @method('PATCH')
          <div class="form-row">
            <div class="col">
              <label class="label-control" for="fullName">الاسم كامل</label>
              <input id="inputfullName" type="text" name="fullName" class="form-control"   value="{{$data->fullName}}">
            </div>
            <div class="col">
              <?php
                $usersCategories = App\Models\UsersCategories::all();
                // dd($usersCategories);
              ?>
              <label class="label-control" for="userCategoryIdTable">المجموعة </label>
              <select class="form-control" name="userCategoryIdTable" >
                  <option >أختر المجموعة</option>
                  @foreach ($usersCategories as $categories)
                    <option @if ($data->userCategoryIdTable==$categories->userCategoryId)
                      selected="selected"
                    @endif  class="form-control" value="{{$categories->userCategoryId}}">{{$categories->userCategoryName}}</option>
                  @endforeach
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="col">
              <label class="label-control" for="username"> اسم المستخدم</label>
              <input type="text" class="form-control" name="username"   value="{{$data->username}}">
            </div>
            <div class="col">
              <label class="label-control" for="email">  البريد الالكتروني </label>
              <input type="text" name="email" class="form-control"  value="{{$data->email}}">
            </div>
          </div>
          <div class="form-row">
            <div class="col">
              <label class="label-control" for="password"> كلمة المرور</label>
              <input id="password" type="password" class="form-control" name="password" placeholder="كلمة المرور">
            </div>
            <div class="col">
              <label class="label-control" for="profileImage"> صورة رمزية  </label>
              <input type="file" name="profileImage" class="form-control"  >
            </div>
          </div>


          <div class="form-row">
            <div class="col">
              <label class="label-control" for="confirmPassword"> تفاصيل اضافية </label>
              <textarea class="form-control" name="userNote" rows="4" cols="40"></textarea>
            </div>

            <div class="col">
              <div class="form-group">
                <div class="col">
                  <div class="form-check">
                    <label class="form-check-label" for="userStatus">
                      <input class="form-check-input" type="radio" name="userStatus" id="userStatus" value="1"  >
                      تفعيل المستخدم
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label" for="userStatus">
                      <input class="form-check-input" type="radio" name="userStatus" id="userStatus"   value="0" >
                   حظر المستخدم
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>

        <button type="submit" class="btn text-orange text-white mt-3"> حفظ التعديلات <i class="fa fa-plus"></i></button>
      </form>
    </div>

@endsection
