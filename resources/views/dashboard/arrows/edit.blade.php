@extends('dashboard.index')
@section('title','  تعديل   اسهم التبرعات ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item " aria-current="page"> <a href="{{route('arrows.index')}}">إدارة   اسهم التبرعات </a></li>
      <li class="breadcrumb-item active">   تعديل   السهم   </li>
    </ol>
    </nav>
    <div class="paymentmethod-edit" style="background-color:#FFF;padding:15px">

      {{-- Errors message --}}
      @include('includes.errors')
      @include('includes.success')
      <h5 class="text-right" style="margin-right:10%"> تعديل سهم التبرع</h5>

      <form  id="user-edit-form" enctype="multipart/form-data"  method="post" action="{{route('arrows.update',$data->arrowId)}}">
        @csrf
          @method('PATCH')

          <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="arrowName">   السهم</label>
                    <input id="inputarrowName"
                      type="text"
                      name="arrowName"
                      class="form-control w-40"
                      value="{{$data->arrowName}}">
                  </div>
                </div>
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="arrowValue">  قيمة السهم </label>
                    <input
                      type="text"
                      name="arrowValue"
                      class="form-control w-40"
                      value="{{$data->arrowValue}}">
                  </div>
                </div>
                <div class="form-row">
                  <div class="col">
                    <?php
                      $projects  = App\Models\Projects::all();
                      // dd($projectsCategories);
                    ?>
                    <label class="label-control" for="projectTable">  المشروع</label>
                    <select class="form-control  w-40" name="projectTable" style="padding: 0; width: 40%; margin-right: 10%;   margin-top: 2%;" >
                        <option >أختر المشروع</option>
                        @foreach ($projects  as $project)
                          <option  class="form-control" @if($data->projectTable==$project->projectId) selected="selected" @endif  value="{{$project->projectId}}">{{$project->projectName}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                {{-- <div class="form-row">
                  <div class="col" style="margin-top:4%">
                    <div class="form-check">
                      <label class="form-check-label" for="arrowStatus">
                        <input class="form-check-input" type="radio" name="arrowStatus" id="arrowStatus" value="1"  >
                        تفعيل
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label" for="arrowStatus">
                        <input class="form-check-input" type="radio" name="arrowStatus" id="arrowStatus" value="0"  >
                      إلغاء
                      </label>
                    </div>
                </div>
              </div> --}}
        <div class="form-row mt-3">
            <button type="submit" style="width:20%"  class="btn text-orange text-white mt-3 sm-w-40"> حفظ التعديلات <i class="fa fa-save"></i></button>
        </div>
    </form>
    </div>

@endsection
