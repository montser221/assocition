@extends('dashboard.index')
@section('title',' تعديل    بيانات الملف   ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item " aria-current="page"> <a href="{{route('reportfiles.index')}}">إدارة  الملفات </a></li>
      <li class="breadcrumb-item active">  تعديل   ملف    </li>
    </ol>
    </nav>
    <div class="paymentmethod-edit" style="background-color:#FFF;padding:15px">
{{-- //  `ReportId`, `reportTitle`, `reportImageFile`, `reportPdfFile`, `reportStatus`, `created_at`, `updated_at`
 --}}
      {{-- Errors message --}}
      @include('includes.errors')
      @include('includes.success')
      <h5 class="text-right" style="margin-right:10%">تعديل    ملف   </h5>

      <form  id="user-edit-form" enctype="multipart/form-data"  method="post" action="{{route('reportfiles.update',$data->ReportId)}}">
        @csrf
        @method('PATCH')

       <div class="form-row">
         <div class="col">
           <label class="label-control" for="reportTitle">  عنوان الملف </label>
           <input id="i" type="text" name="reportTitle" class="form-control w-40" value="{{$data->reportTitle}}">
         </div>
       </div>
       <div class="form-row">
         <div class="col">
           <label class="label-control" for="reportPdfFile">  الملف      </label>
           <input style="margin-right: 10%;" id="reportPdfFile" type="file" name="reportPdfFile" class="form-control-file w-80" >
         </div>
       </div>
       <div class="form-row">
         <div class="col">
           <label class="label-control" for="reportImageFile">  صورة مصغرة    </label>
           <input style="margin-right: 10%;" id="reportImageFile" type="file" name="reportImageFile" class="form-control-file w-80" >
         </div>
       </div>
       <div class="form-row">
         <div class="col" style="margin-top:8%">
           <div class="form-check">
             <label class="form-check-label" for="reportStatus">
               <input class="form-check-input" type="radio" name="reportStatus" id="reportStatus" value="1"  >
               تفعيل
             </label>
           </div>
           <div class="form-check">
             <label class="form-check-label" for="reportStatus">
               <input class="form-check-input" type="radio" name="reportStatus" id="reportStatus" value="0"  >
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
