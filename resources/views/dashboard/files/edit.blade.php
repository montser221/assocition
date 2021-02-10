@extends('dashboard.index')
@section('title',' تعديل    بيانات الملف   ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item " aria-current="page"> <a href="{{route('files.index')}}">إدارة  الملفات </a></li>
      <li class="breadcrumb-item active">  تعديل   ملف    </li>
    </ol>
    </nav>
    <div class="paymentmethod-edit" style="background-color:#FFF;padding:15px">

      {{-- Errors message --}}
      @include('includes.errors')
      @include('includes.success')
      <h5 class="text-right" style="margin-right:10%">تعديل    ملف   </h5>

      <form  id="user-edit-form" enctype="multipart/form-data"  method="post" action="{{route('files.update',$data->fileId)}}">
        @csrf
        @method('PATCH')

       <div class="form-row">
         <div class="col">
           <label class="label-control" for="fileTitle">  عنوان الملف </label>
           <input id="i" type="text" name="fileTitle" class="form-control w-40" value="{{$data->fileTitle}}">
         </div>
       </div>
       <div class="form-row">
         <div class="col">
           <label class="label-control" for="pdfFile">  الملف      </label>
           <input style="margin-right: 10%;" id="pdfFile" type="file" name="pdfFile" class="form-control-file w-80" >
         </div>
       </div>
       <div class="form-row">
         <div class="col">
           <label class="label-control" for="imageFile">  صورة مصغرة    </label>
           <input style="margin-right: 10%;" id="imageFile" type="file" name="imageFile" class="form-control-file w-80" >
         </div>
       </div>
       <div class="form-row">
         <div class="col" style="margin-top:8%">
           <div class="form-check">
             <label class="form-check-label" for="fileStatus">
               <input class="form-check-input" type="radio" name="fileStatus" id="fileStatus" value="1"  >
               تفعيل
             </label>
           </div>
           <div class="form-check">
             <label class="form-check-label" for="fileStatus">
               <input class="form-check-input" type="radio" name="fileStatus" id="fileStatus" value="0"  >
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
