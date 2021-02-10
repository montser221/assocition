@extends('dashboard.index')
@section('title',' تعديل  السياسات ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item " aria-current="page"> <a href="{{route("policies.index")}}">  إدارة   السياسات العامة </a></li>
      <li class="breadcrumb-item active"> تعديل السياسات </li>
    </ol>
    </nav>

    <div class="policies-edit" style="background-color:#FFF;padding:15px">
        {{-- Errors message --}}
        @include('includes.errors')
        @include('includes.success')
        <h5>تعديل مشروع </h5>

        <form  id="edit-form" enctype="multipart/form-data" method="post" action="{{route('policies.update',$data->policyId)}}">
          @csrf
          @method('PATCH')
          <div class="form-row">
            <div class="col">
              <label class="label-control" for="policyTitle">العنوان</label>
              <input id="inputpolicyTitle" type="text" name="policyTitle" class="form-control"  value="{{$data->policyTitle}}" >
            </div>
            <div class="col">
              <label class="label-control" for="policyLevel">المستوى</label>
              <input id="inputpolicyLevel" type="text" name="policyLevel" class="form-control" value="{{$data->policyLevel}}" >
            </div>

          </div>
          <div class="form-row">
            <div class="col">
              <label class="label-control" for="policyImage">  الصورة المميزة  </label>
              <input type="file" class="form-control-file" name="policyImage" >
            </div>
            <div class="col">
              <label class="label-control" for="policyFile">  الصورة المميزة  </label>
              <input type="file" class="form-control-file" name="policyFile" >
            </div>
          </div>
          <div class="form-row">
            <div class="col">

              <label class="label-control" for="policyText"> نص السياسة</label>
              <textarea name="policyText" class="form-control" rows="5" cols="40">{{$data->policyText}}</textarea>
            </div>
          </div>
          {{--       //   'policyTitle','policyLevel','policyImage','policyFile','showInHome','policyStatus','policyText' --}}

        <div class="form-row">
            <div class="col" style="margin-top:8%">
              <div class="form-check">
                <label class="form-check-label" for="policyStatus">
                  <input class="form-check-input" type="radio" name="policyStatus" id="policyStatus" value="1"  >
                  تفعيل
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label" for="policyStatus">
                  <input class="form-check-input" type="radio" name="policyStatus" id="policyStatus" value="0"  >
                  إلغاء تفعيل
                </label>
              </div>
          </div>
          </div>

        <div class="form-row">
            <div class="col" style="margin-top:8%">
              <div class="form-check">
                <label class="form-check-label" for="showInHome">
                  <input class="form-check-input" type="radio" name="showInHome" id="showInHome" value="1"  >
                    ظهور في الرئسية
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label" for="showInHome">
                  <input class="form-check-input" type="radio" name="showInHome" id="showInHome" value="0"  >
                لا تظهر في الرئسية
                </label>
              </div>
          </div>
          </div>

        <button type="submit" class="btn text-orange text-white mt-3"> حفظ التعديلات <i class="fa fa-plus"></i></button>
      </form>
    </div>

@endsection
