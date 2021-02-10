@extends('dashboard.index')

@section('title',' إدارة المستخدمين  ')

@section('dashboard-content')

  <nav aria-label="breadcrumb">

    <ol class="breadcrumb">

      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>

      <li class="breadcrumb-item active" aria-current="page">إدارة  المستخدمين</li>

    </ol>

    </nav>

    <div class="users">

      <div class="h5">إدارة المستخدمين</div>

      <div class="row " style="margin-bottom:15px">

        <div class="col">

          <form class="" action="" method="post">

            <input type="text" class="form-control" name="" value="">

          </form>

        </div>



        <div class="col offset-lg-8">

          {{-- <a type="button" class="btn  border border-dark " name="button">  <i class="fa fa-upload fa-lg"></i>  تصدير </a>

          <a type="button" class="btn   border border-dark" name="button"> <i class="fa fa-download fa-lg"></i> استيراد </a> --}}

              <!-- Button trigger modal Create New users -->

          <button data-toggle="modal" data-target="#createUser" type="button" class="btn text-orange text-white " name="button">  <i class="fa fa-plus "></i> &nbsp;&nbsp; أنشاء </a>

        </div>



      </div>



      <!-- Modal -->

      <div class="modal fade" id="createUser" tabindex="-1" data-keyboard="false"  data-backdrop="static" aria-labelledby="createUserLabel" aria-hidden="true">

        <div class="modal-dialog  modal-lg">

          <div class="modal-content">

            <div class="modal-header">

              <h5 class="modal-title" id="createUserLabel">أنشاء مستخدم جديد</h5>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

              </button>

            </div>

            <div class="modal-body">



              <form  id="user-create-form" enctype="multipart/form-data" method="post" action="{{route('users.store')}}">

                @csrf

                @method('POST')

                <div class="form-row">

                  <div class="col">

                    <label class="label-control" for="fullName">الاسم كامل</label>

                    <input id="inputfullName" type="text" name="fullName" class="form-control" placeholder="الاسم الكامل">

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

                          <option  class="form-control" value="{{$categories->userCategoryId}}">{{$categories->userCategoryName}}</option>

                        @endforeach

                    </select>

                  </div>

                </div>

                <div class="form-row">

                  <div class="col">

                    <label class="label-control" for="username"> اسم المستخدم</label>

                    <input type="text" class="form-control" name="username" placeholder="أسم المستخدم">

                  </div>

                  <div class="col">

                    <label class="label-control" for="email">  البريد الالكتروني </label>

                    <input type="text" name="email" class="form-control"  placeholder="البريد الالكتروني">

                  </div>

                </div>

                <div class="form-row">

                  <div class="col">

                    <label class="label-control" for="password"> كلمة المرور</label>

                    <input id="password" type="password" class="form-control" name="password" placeholder="كلمة المرور">

                  </div>

                  <div class="col">

                    <label class="label-control" for="confirmPassword">أعادة كلمة المرور</label>

                    <input id="confirmPassword" type="password" name="confirmPassword" class="form-control" placeholder="أكتب إسم المشروع">

                  </div>

                  <span id='msg'></span>

                </div>



                <div class="form-row">

                  <div class="col">

                    <label class="label-control" for="profileImage"> صورة رمزية  </label>

                    <input type="file" name="profileImage" class="form-control" placeholder="كلمة المرور">

                  </div>

                </div>



                <div class="form-row">

                  <div class="col">

                    <label class="label-control" for="confirmPassword"> الهاتف</label>

                    <input type="text" name="phone"  class="form-control" value="">

                  </div>

                  <div class="col">

                    <label class="label-control" for="confirmPassword"> تفاصيل اضافية </label>

                    <textarea class="form-control" name="userNote" rows="4" cols="40"></textarea>

                  </div>



                  <div class="col" style="margin-top:8%">

                    <div class="form-check">

                      <label class="form-check-label" for="userStatus">

                        <input class="form-check-input" type="radio" name="userStatus" id="userStatus" value="1"  >

                        تفعيل المستخدم

                      </label>

                    </div>

                    <div class="form-check">

                      <label class="form-check-label" for="userStatus">

                        <input class="form-check-input" type="radio" name="userStatus" id="userStatus" value="0"  >

                     حظر المستخدم

                      </label>

                    </div>

                </div>



                </div>



            </div>

            <div class="modal-footer">

              <button type="button" class="btn main-color " data-dismiss="modal">الغاء</button>

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

          <th>الأسم </th>

          <th> المجموعة</th>

          <th> اسم المستخدم </th>

          <th> البريد الألكتروني</th>

          <th> الحالة</th>

          <th> صورة الفلاف</th>

          <th> أحداث  </th>

        </thead>

        <tbody>

          @foreach ($allUsers as $user)

            <tr>

              <td>رقم {{$user->userId}}</td>

              <td>{{$user->username ?? ''}}</td>

              <td>{{$user->fullName ?? ''}}</td>

              <td>{{ App\Models\UsersCategories::find($user->userCategoryIdTable)->userCategoryName ?? ''}}</td>

              <td>  {{  $user->email ?? '' }}  </td>

              <td class="@if ($user->userStatus==1) text-success  @else text-danger   @endif">

                @if ($user->userStatus==1)

                  تم التفعيل

                @else

                  غير مفعل

                @endif

              </td>

              <td>  <img style="max-width: 40px;max-height:40px" src="{{url("uploads/profile/". $user->profileImage )}}" class="special-img" alt="">   </td>

              <td>

                <form class="form-inline" action="{{route('users.destroy',$user->userId) }}" method="post">

                  @csrf

                  @method("DELETE")

                  <a class="btn  btn-sm ml-1" href="{{route('users.edit',$user->userId)}}" ><i class="fa fa-edit "></i></a>

                  <button   type="submit" class="btn  btn-sm  btn-project"><i class="fa fa-bank "></i></button>

                </form>

              </td>

            </tr>

          @endforeach

        </tbody>

      </table>

    </div>

@endsection
