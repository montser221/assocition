@extends('dashboard.index')
@secton('title',' تعديل  الاعدادات ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item " aria-current="page"> <a href="{{route("settings.index")}}">  الاعدادات    </a></li>
      <li class="breadcrumb-item active">تعديل الاعدادات</li>
    </ol>
    </nav>

    <div class="settings-edit" style="background-color:#FFF;padding:15px">
        {{-- Errors message --}}
        @include('includes.errors')
        @include('includes.success')
        <h5>تعديل  الاعدادات </h5>

        <form  id="edit-form" enctype="multipart/form-data" method="post" action="{{route('settings.update',$data->settingId)}}">
          @csrf
          @method('PATCH')
          <div class="form-row">
            <div class="col">
              <label class="label-control" for="foundationName"> أسم الشركة /المؤسسة  </label>
              <input id="inputfullName" type="text" name="foundationName" class="form-control" value="{{$data->foundationName}}" >
            </div>
            <div class="col">
              <label class="label-control" for="email">  البريد الالكتروني </label>
              <input type="text" name="email" class="form-control"  value="{{$data->email}}" >
            </div>

          </div>
          <div class="form-row">
            <div class="col">
              <label class="label-control" for="phone1">  رقم الجوال </label>
              <input type="text" class="form-control" name="phone1" value="{{$data->phone1}}">
            </div>


            <div class="col">
              <label class="label-control" for="foundationTitle">  العنوان  </label>
              <input type="text" class="form-control" name="foundationTitle" value="{{$data->phone2}}">
            </div>
          </div>
          <div class="form-row">
            <div class="col">
              <label class="label-control" for="phone2"> رقم الجوال 2  </label>
              <input type="text" class="form-control" name="phone2" value="{{$data->phone2}}">
            </div>
            <div class="col">
              <label class="label-control" for="phone3">  رقم الجوال 3   </label>
              <input type="text" name="phone3" class="form-control" value="{{$data->phone3}}">
            </div>
          </div>
          <div class="form-row">
            <div class="col">
              <label class="label-control" for="phoneNumber">  رقم الهاتف</label>
              <input id="phoneNumber" type="text" class="form-control" name="phoneNumber" value="{{$data->phoneNumber}}">
            </div>
            <div class="col">
              <label class="label-control" for="fax"> الفاكس    </label>
              <input id="fax" type="text" name="fax" class="form-control" value="{{$data->fax}}">
            </div>
            <span id='msg'></span>
          </div>
          <div class="form-row">
            <div class="col">
              <label class="label-control" for="fax"> الكلمات المفتاحية    </label>
              <textarea class="form-control" name="keywords" rows="5" cols="40">{{$data->keywords}}</textarea>
            </div>
            <div class="col">
                <label class="label-control" for="foundationLogo"> شعار المؤسسة </label>
                <input type="file" name="foundationLogo" class="form-control-file"  >
            </div>
          </div>
          <div class="form-row">

            <div class="col" style="margin-top:8%">
              <div class="form-check">
                <label class="form-check-label" for="siteStatus">
                  <input class="form-check-input" type="radio" name="siteStatus" id="siteStatus" value="1"  >
                  تفعيل الموقع
                </label>
              </div>

              <div class="form-check">
                <label class="form-check-label" for="siteStatus">
                  <input class="form-check-input" type="radio" name="siteStatus" id="siteStatus" value="0"  >
                الغاء الموقع
                </label>
              </div>
          </div>

          <div class="col" style="margin-top:8%">
            <div class="form-check">
              <div class="">

              </div>
              <label class="form-check-label" for="jobsStatus">
                <input class="form-check-input" type="radio" name="jobsStatus" id="jobsStatus" value="1"  >
                تفعيل الوظائف
              </label>
            </div>

            <div class="form-check">
              <label class="form-check-label" for="jobsStatus">
                <input class="form-check-input" type="radio" name="jobsStatus" id="jobsStatus" value="0"  >
              الغاء الوظائف
              </label>
            </div>
        </div>

       </div>

        <button type="submit" class="btn text-orange text-white mt-3"> حفظ التعديلات <i class="fa fa-plus"></i></button>
      </form>
    </div>

@endsection
