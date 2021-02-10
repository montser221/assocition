@extends('dashboard.index')
@section('title', 'إدارة    المستفيدين ' )
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item " aria-current="page"> <a href="{{route('payees.index')}}">إدارة    المستفيدين </a></li>
      <li class="breadcrumb-item active">   تعديل   بيانات مستفيد   </li>
    </ol>
    </nav>
    <div class="payees-edit" style="background-color:#FFF;padding:15px">

      {{-- Errors message --}}
      @include('includes.errors')
      @include('includes.success')
      <h5 class="text-right" style="margin-right:10%">  تعديل   بيانات مستفيد   </h5>

      <form  id="user-edit-form" enctype="multipart/form-data"  method="post" action="{{route('payees.update',$data->pId)}}">
        @csrf
          @method('PATCH')
          <div class="form-row">
            <div class="col">
              <label style="margin-right:10%" class="label-control" for="pName"> الاسم  </label>
              <input style="margin-right:10% ;width:60%;" id="pName" type="text" name="pName" class="form-control w-40" value="{{$data->pName}}">
            </div>

          </div>
          <div class="form-row">
            <div class="col">
              <label class="label-control" for="healthState" style="margin-right: 10%;"> الحالة الصحية </label>
              <input  style="margin-right:10% ;width:60%;" id="healthState" type="text" name="healthState" value="{{$data->healthState}}" class="form-control w-80"  >
            </div>
          </div>
          <div class="form-row">
            <div class="col">
              <label  style="margin-right: 10%;" class="label-control" for="ssnNumber">  رقم الهوية   </label>
              <input style="margin-right: 10%; width:60%" id="ssnNumber" type="text" name="ssnNumber" value="{{$data->ssnNumber}}" placeholder="أدخل رقم الهوية"   class="form-control w-80"  >
            </div>
          </div>
          <div class="form-row">
            <div class="col">
              <label  style="margin-right: 10%;" class="label-control" for="ssnNumber"> أختر الجنس</label>
              <select class="form-control mb-3" name="gender" style="padding:0 8px 0 0;width:60%;margin-right: 10%;">
                <option class=""  required>الجنس</option>

                <option class="" value="male"     @if ($data->gender ==  "male")  selected @endif>ذكر</option>
                <option class="" value="female"   @if ($data->gender ==  "female") selected @endif>أنثى</option>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="col" style="margin-top:8%">
              <div class="form-check">
                <label class="form-check-label" for="pStatus" style="margin-right: 10%;">
                  <input class="form-check-input" type="radio" name="pStatus" id="pStatus" value="1"  >
                  تفعيل
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label" for="pStatus" style="margin-right: 10%;">
                  <input class="form-check-input" type="radio" name="pStatus" id="pStatus" value="0"  >
               الغاء
                </label>
              </div>
          </div>
        </div>
        <div class="form-row">
            <button style="margin-right: 10%; "  type="submit" class="btn text-orange text-white mt-3 "> حفظ التعديلات <i class="fa fa-save"></i></button>
        </div>
    </form>
    </div>

@endsection
