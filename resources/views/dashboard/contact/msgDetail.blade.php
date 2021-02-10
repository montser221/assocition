@extends('dashboard.index')
@section('title',' رسائل التواصل ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item "  > <a href="{{route('contact.contact')}}">    رسائل   التواصل</a></li>
      <li class="breadcrumb-item active "  > <a> تفاصيل الرسالة </a></li>
     </ol>
    </nav>
    <div class="users" style="background: #FFF ; padding: 20px;">
   
       
       <div class="container">
              <div class="text-right h3 m-b-5">تفاصيل    الرسالة</div>
         <div class="row text-right">
             <div class="col-sm-12 mb-3">
               <div>
                 الاسم :{{ $data->fullname }}
               </div>
             </div> 

             <div class="col-sm-12 mb-3">
               <div>
                 البريد :{{ $data->email }}
               </div>
             </div>


             <div class="col-sm-12 mb-3">
               <div>
                  الموضوع :{{ $data->topic }}
               </div>
             </div>
             <div class="col-sm-12 mb-3">
               <div>
                  الرسالة :{{ $data->message }}
               </div>
             </div>
             <div class="col-sm-12 mb-3">
               <div>
                  نوع الرسالة : 
               @if($data->msgType=="complaint")
               شكوى
              @elseif($data->msgType == "suggist")
              إقتراح
              @elseif($data->msgType == "inquire")
              أستفسار
               @endif
              
               </div>
             </div>
 
         </div>
       </div>
     
    </div>
@endsection
