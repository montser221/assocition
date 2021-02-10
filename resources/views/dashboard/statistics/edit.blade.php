@extends('dashboard.index')
@section('title','  الاحصائيات   ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item " aria-current="page"> <a href="">  الاحصائيات     </a></li>
      <li class="breadcrumb-item active"> تعديل مستخدم </li>
    </ol>
    </nav>

    <div class="users-edit" style="background-color:#FFF;padding:15px">
        {{-- Errors message --}}
        @include('includes.errors')
        @include('includes.success')
        <h5>تعديل  إحصائية </h5>

        <form  id="edit-form" enctype="multipart/form-data" method="post" action="{{route('statistics.update',$data->sId)}}">
          @csrf
          @method('PATCH')
            <div class="form-row">

            <div class="col">

              <label class="label-control" for="sName"> الاحصائية</label>

              <input id="sName" type="text" name="sName" class="form-control"  value="{{$data->sName}}">

            </div>

      
          </div>

          <div class="form-row">

            <div class="col">

              <label class="label-control" for="sValue">  القيمة  </label>

              <input type="text" class="form-control" name="sValue"  value="{{$data->sValue}}">

            </div>
          </div>
                      <div class="form-row">
                            <div class="col" style="margin-top:8%">

                    <div class="form-check">

                      <label class="form-check-label" for="sStatus">

                        <input class="form-check-input" type="radio" name="sStatus" id="sStatus" value="1"  >

                        تفعيل  

                      </label>

                    </div>

                    <div class="form-check">

                      <label class="form-check-label" for="sStatus">

                        <input class="form-check-input" type="radio" name="sStatus" id="styleStatus" value="0"  >

                     حظر  

                      </label>

                    </div>

                </div>
               </div>

        <button type="submit" class="btn text-orange text-white mt-3 " style="margin-right: 20%"> حفظ التعديلات <i class="fa fa-plus"></i></button>
      </form>
    </div>

@endsection
