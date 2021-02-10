@extends('dashboard.index')
@section('title','الاعدادات  ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item active" aria-current="page"> الاعدادات   </li>
    </ol>
    </nav>
    <div class="users">
      <div class="h5">الاعدادات  </div>
      <div class="row " style="margin-bottom:15px">
        <div class="col">
          <form class="" action="" method="post">
            <input type="text" class="form-control" name="" value="">
          </form>
        </div>

        <div class="col offset-lg-8">
          {{-- <a type="button" class="btn  border border-dark " name="button">  <i class="fa fa-upload fa-lg"></i>  تصدير </a> --}}
          {{-- <a type="button" class="btn   border border-dark" name="button"> <i class="fa fa-download fa-lg"></i> استيراد </a> --}}
              <!-- Button trigger modal Create New users -->
          {{-- <button data-toggle="modal" data-target="#createSettings" type="button" class="btn text-orange text-white " name="button">  <i class="fa fa-plus "></i> &nbsp;&nbsp; أنشاء </a> --}}
        </div>

      </div>
{{--

'foundationName',
'foundationTitle',
'email',
'phone1',
'phone2',
'phone3',
'phoneNumber',
'fax',
'foundationLogo',
'siteStatus',
'jobsStatus',
'keywords',
 --}}
      <!-- Modal -->
      <div class="modal fade" id="createSettings" tabindex="-1" data-keyboard="false"  data-backdrop="static" aria-labelledby="createSettingsLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createSettingsLabel">أنشاء  الاعدادات</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form  id="user-create-form" enctype="multipart/form-data" method="post" action="{{route('settings.store')}}">
                @csrf
                @method('POST')
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="foundationName"> أسم الشركة /المؤسسة  </label>
                    <input id="inputfullName" type="text" name="foundationName" class="form-control" placeholder=" أسم الشركة /المؤسسة   ">
                  </div>
                  <div class="col">
                    <label class="label-control" for="email">  البريد الالكتروني </label>
                    <input type="text" name="email" class="form-control"  placeholder="البريد الالكتروني">
                  </div>

                </div>
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="phone1">  رقم الجوال </label>
                    <input type="text" class="form-control" name="phone1" placeholder=" رقم الجوال  ">
                  </div>


                  <div class="col">
                    <label class="label-control" for="foundationTitle">  العنوان  </label>
                    <input type="text" class="form-control" name="foundationTitle" placeholder=" العنوان  ">
                  </div>
                </div>
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="phone2"> رقم الجوال 2  </label>
                    <input type="text" class="form-control" name="phone2" placeholder=" رقم الجوال 2  ">
                  </div>
                  <div class="col">
                    <label class="label-control" for="phone3">  رقم الجوال 3   </label>
                    <input type="text" name="phone3" class="form-control"  placeholder=" رقم الجوال 3  ">
                  </div>
                </div>
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="phoneNumber">  رقم الهاتف</label>
                    <input id="phoneNumber" type="text" class="form-control" name="phoneNumber" placeholder=" رقم الهاتف  ">
                  </div>
                  <div class="col">
                    <label class="label-control" for="fax"> الفاكس    </label>
                    <input id="fax" type="text" name="fax" class="form-control" placeholder=" الفاكس    ">
                  </div>
                  <span id='msg'></span>
                </div>
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="fax"> الكلمات المفتاحية    </label>
                    <textarea class="form-control" name="keywords" rows="5" cols="40"></textarea>
                  </div>
                  <div class="col">
                      <label class="label-control" for="foundationLogo"> شعار المؤسسة </label>
                      <input type="file" name="foundationLogo" class="form-control-file"  >
                  </div>
                </div>
                <div class="form-row">

                  {{-- <div class="col" style="margin-top:8%">
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
                </div> --}}

                {{-- <div class="col" style="margin-top:8%">
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
              </div> --}}

                </div>


            </div>
            <div class="modal-footer">
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

      {{-- <table class="table table-hover table-bordered">
        <thead>
          <th>#</th>
          <th>اسم المؤسسة / الشركة </th>
          <th> العنوان</th>
          <th> البريد الألكتروني</th>
          <th> رقم الجوال   </th>
          <th> رقم الجوال 2   </th>
          <th> رقم الجوال 3   </th>
          <th> رقم الهاتف   </th>
          <th> الفاكس</th>
          <th> شعار الموقع</th>
          <th> تفعيل الموقع</th>
          <th> وظائف  </th>
          <th> أحداث  </th>
        </thead>
        <tbody>
          @foreach ($allSettings as $setting)
            <tr>
              <td>  <input type="checkbox" name="" value=""> &nbsp;&nbsp;  <span class="mr-1">{{$i=1 ?? $i++}}</span> </td>
              <td>{{$setting->foundationName}}</td>
              <td>{{$setting->foundationTitle}}</td>
              <td>{{$setting->email}}</td>
               <td>  {{  $setting->phone1 }}  </td>
               <td>  {{  $setting->phone2 }}  </td>
               <td>  {{  $setting->phone3 }}  </td>
               <td>  {{  $setting->phoneNumber }}  </td>
               <td>  {{  $setting->fax }}  </td>
               <td>  <img style="max-width: 40px;max-height:40px" src="{{url("uploads/settings/". $setting->foundationLogo )}}" class="special-img" alt="">   </td>

              <td class="@if ($setting->siteStatus==1) text-success  @else text-danger   @endif">
                @if ($setting->siteStatus==1)
                  تم التفعيل
                @else
                  غير مفعل
                @endif
              </td>
              <td class="@if ($setting->jobsStatus==1) text-success  @else text-danger   @endif">
                @if ($setting->jobsStatus==1)
                  تم التفعيل
                @else
                  غير مفعل
                @endif
              </td>
              <td>
                <form class="form-inline" action="{{route('settings.destroy',$setting->settingId) }}" method="post">
                  @csrf
                  @method("DELETE")
                  <a class="btn  btn-sm ml-1" href="{{route('settings.edit',$setting->settingId)}}" ><i class="fa fa-edit "></i></a>
                  <button   type="submit" class="btn  btn-sm  btn-project"><i class="fa fa-bank "></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table> --}}

      <div class="settings-edit" style="background-color:#FFF;padding:30px">
          {{-- Errors message --}}
          {{-- @include('includes.errors') --}}
          {{-- @include('includes.success') --}}
          <h5>تعديل  الاعدادات </h5>

          <form  id="edit-form" enctype="multipart/form-data" method="post" action="@if(!empty($data)) {{route('settings.update',$data->settingId ?? 1)}}  @else{{route('settings.store')}}@endif">
            @csrf
            @if(!empty($data))
              @method('PATCH')
            @else
              @method('post')
            @endif
            <div class="form-row mb-4">
              <div class="col">
                <label class="label-control" for="foundationName"> أسم الشركة /المؤسسة  </label>
                <input id="inputfullName" type="text" name="foundationName" class="form-control" value="{{ !empty($data->foundationName) ? $data->foundationName :  old('foundationName') }}" >
              </div>
              <div class="col">
                <label class="label-control" for="email">  البريد الالكتروني </label>
                <input type="text" name="email" class="form-control"  value="{{$data->email ?? old('email')}}" >
              </div>

            </div>
            <div class="form-row mb-4">
              <div class="col">
                <label class="label-control" for="phone1">  رقم الجوال </label>
                <input type="text" class="form-control" name="phone1" value="{{$data->phone1 ?? ''}}">
              </div>


              <div class="col">
                <label class="label-control" for="foundationTitle">  العنوان  </label>
                <input type="text" class="form-control" name="foundationTitle" value="{{$data->foundationTitle ?? old('foundationTitle')}}">
              </div>
            </div>
            <div class="form-row mb-4">
              <div class="col">
                <label class="label-control" for="phone2"> رقم الجوال 2  </label>
                <input type="text" class="form-control" name="phone2" value="{{$data->phone2??''}}">
              </div>
              <div class="col">
                <label class="label-control" for="phone3">  رقم الجوال 3   </label>
                <input type="text" name="phone3" class="form-control" value="{{$data->phone3 ?? ''}}">
              </div>
            </div>
            <div class="form-row mb-4">
              <div class="col">
                <label class="label-control" for="phoneNumber">  رقم الهاتف</label>
                <input id="phoneNumber" type="text" class="form-control" name="phoneNumber" value="{{$data->phoneNumber ?? old('phoneNumber')}}">
              </div>
              <div class="col">
                <label class="label-control" for="fax"> الفاكس    </label>
                <input id="fax" type="text" name="fax" class="form-control" value="{{$data->fax ?? ''}}">
              </div>
              <span id='msg'></span>
            </div>
            <div class="form-row mb-4">
              <div class="col">
                <label class="label-control" for="fax"> الكلمات المفتاحية    </label>
                <textarea class="form-control" name="keywords" rows="5" cols="40">{{$data->keywords ?? ''}}</textarea>
              </div>
              <div class="col">
                  <label class="label-control" for="foundationLogo"> شعار المؤسسة </label>
                  <input type="file" name="foundationLogo" class="form-control-file"  >
              </div>
            </div>
            <div class="form-row mb-4">

              {{-- <div class="col" style="margin-top:8%">
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
            </div> --}}

            {{-- <div class="col" style="margin-top:8%">
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
          </div> --}}

         </div>

          <button type="submit" class="btn text-orange text-white mt-5"> حفظ التعديلات <i class="fa fa-plus"></i></button>
        </form>
      </div>
    </div>
@endsection
