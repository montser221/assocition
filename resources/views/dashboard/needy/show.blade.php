@extends('dashboard.index')
@section('title',' تفاصيل المحتاجين  ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item "  > <a href="{{route('needy')}}">  تفاصيل المحتاجسن  </a></li>
      
     </ol>
    </nav>
    <div class="users">
   
   
       <div class="container">
              <div class="text-right h3 ">  تفاصيل المحتاج      </div>
         <div class="row text-right">
             <div class="col-sm-12 mb-3">
               <div>
                 الاسم :{{ $data->name }}
               </div>
             </div> 

             <div class="col-sm-12 mb-3">
               <div>
                 البريد :{{ $data->phone }}
               </div>
             </div>


             <div class="col-sm-12 mb-3">
               <div>
                  العنوان :{{ $data->address }}
               </div>
             </div>
             <div class="col-sm-12 mb-3">
               <div>
                  المحتاج :{{ $data->needy }}
               </div>
             </div>

             <div class="col-sm-12 mb-3">
               <div>
                  التفاصيل :{{ $data->details }}
               </div>
             </div>
 
         </div>
       </div>
     
    </div>
@endsection
