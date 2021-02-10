@extends('dashboard.index')
@section('title',' أدارة الاعضاء الاخرين   ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item " aria-current="page"> <a href="{{route('otherfiles.index')}}"> أدارة الاعضاء الاخرين       </a></li>
      <li class="breadcrumb-item active">  تعديل   بيانات العضو    </li>
    </ol>
    </nav>
    <div class="paymentmethod-edit" style="background-color:#FFF;padding:15px">

      {{-- Errors message --}}
      @include('includes.errors')
      @include('includes.success')
      <h5 class="text-right" style="margin-right:10%">تعديل    بيانات العضو   </h5>

      <form  id="user-edit-form" enctype="multipart/form-data"  method="post" action="{{route('otherfiles.update',$data->memId)}}">
        @csrf
        @method('PATCH')

               <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="memName">  عنوان الملف </label>
                    <input id="i" type="text" name="memName" class="form-control w-40"   value="{{ $data->memName}}" >
                  </div>
                </div>

                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="memFile">  الملف      </label>
                    <input style="margin-right: 10%;" id="memFile" type="file" name="memFile" class="form-control-file w-80" >
                  </div>
                </div>
                 <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="memEmail">    الايمل </label>
                    <input id="i" type="text" name="memEmail" class="form-control w-40"  value="{{ $data->memEmail }}"  >
                  </div>
                </div>
                 <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="memPhone">     الهاتف </label>
                    <input id="i" type="text" name="memPhone" class="form-control w-40"   value="{{ $data->memPhone }}" >
                  </div>
                </div>
       <div class="form-row">
         <div class="col" style="margin-top:8%">
           <div class="form-check">
             <label class="form-check-label" for="memStatus">
               <input class="form-check-input" type="radio" name="memStatus" id="memStatus" value="1"  >
               تفعيل
             </label>
           </div>
           <div class="form-check">
             <label class="form-check-label" for="memStatus">
               <input class="form-check-input" type="radio" name="memStatus" id="memStatus" value="0"  >
            الغاء
             </label>
           </div>
         </div>
       </div>
        <div class="form-row">
            <button type="submit" class="btn text-orange text-white mt-3 " style="width:17%"> حفظ التعديلات <i class="fa fa-save"></i></button>
        </div>
    </form>
    </div>

@endsection
