@extends('dashboard.index')
@section('title',' الاسهم الخاصة بالمشاريع ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item " aria-current="page"> <a href="{{route('arrows.index')}}">إدارة  الاسهم </a></li>
     </ol>
    </nav>
    <div class="users">

      <div class="row " style="margin-bottom:15px">
        <div class="col">
          <form class="" action="" method="post">
            <input type="text" class="form-control" name="" value="">
          </form>
        </div>

        <div class="col offset-lg-8">
          {{-- <a type="button" class="btn border border-dark  " name="button">  <i class="fa fa-upload fa-lg"></i>  تصدير </a>
          <a type="button" class="btn border border-dark " name="button"> <i class="fa fa-download fa-lg"></i> استيراد </a> --}}
              <!-- Button trigger modal Create New paymentmethod -->
          <button data-toggle="modal" data-target="#createPaymentMethod" type="button"
           class="btn text-orange text-white " name="button">  <i class="fa fa-plus "></i> &nbsp;&nbsp; أنشاء </a>
        </div>

      </div>

      <!-- Modal -->
      <div class="modal fade" id="createPaymentMethod"
       tabindex="-1" data-keyboard="false"
        data-backdrop="static" aria-labelledby="createPaymentMethodLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createPaymentMethodLabel">       أضافة سهم جديد  </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form   id="create-form"
                      enctype="multipart/form-data"
                      method="post"
                      action="{{route('arrows.store')}}">
                @csrf
                @method('POST')
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="arrowName">   السهم</label>
                    <input id="inputarrowName"
                      type="text"
                      name="arrowName"
                      class="form-control w-40"
                      placeholder=" أدخل أسم السهم">
                  </div>
                </div>
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="arrowValue">  قيمة السهم</label>
                    <input
                      type="text"
                      name="arrowValue"
                      class="form-control w-40"
                      placeholder=" أدخل قيمة السهم">
                  </div>
                </div>
                <div class="form-row">

                  <div class="col">
                    <?php
                      $projects  = App\Models\Projects::all();
                      // dd($projectsCategories);
                    ?>
                    <label class="label-control" for="projectTable">  المشروع</label>
                    <select class="form-control" name="projectTable" style="padding: 0;" >
                        <option >أختر المشروع</option>
                        @foreach ($projects  as $project)
                          <option  class="form-control" value="{{$project->projectId}}">{{$project->projectName}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>

                {{-- <div class="form-row">
                  <div class="col" style="margin-top:8%">
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
            <div class="modal-footer">
                <button type="button" style="margin-right:10%" class="btn text-warning btn-main mr-5" data-dismiss="modal">الغاء</button>
              <button style="width: 12%;" type="submit" class="btn text-orange text-white "> إضافة <i class="fa fa-plus"></i></button>
            </div>
          </form>
          </div>
        </div>
      </div
    </div>
  </div>
      {{-- End Modal Create --}}


       {{-- Errors message --}}
      @include('includes.errors')
      {{-- success message --}}
      @include('includes.success')

      <table class="table table-hover table-bordered">
        <thead>
          <th>#</th>
          <th>    السهم   </th>
          <th>  قيمة السهم   </th>
          <th>    المشروع   </th>
          <th>   وقت الانشاء   </th>
          <th>   الحالة   </th>
          <th> أحداث  </th>
        </thead>
        <tbody>
          @foreach ($allarrows as $arrow)
            <tr>
              <td>   رقم  {{$arrow->arrowId }}</td>
              <td>{{  $arrow->arrowName }}</td>
              <td>{{$arrow->arrowValue}}</td>
              <td>{{  $arrow->project->projectName ??""}}</td>
              <td>{{$arrow->created_at}}</td>
              <td class="@if ($arrow->arrowStatus==1) text-success  @else text-danger   @endif">
                @if ($arrow->arrowStatus==1)
                  تم التفعيل
                @else
                  غير مفعل
                @endif
              </td>
              <td>
                <form class="form-inline" action="{{route('arrows.destroy',$arrow->arrowId) }}" method="post">
                  @csrf
                  @method("DELETE")
                  <a class="btn  btn-sm ml-1" href="{{route('arrows.edit',$arrow->arrowId)}}" ><i class="fa fa-edit "></i></a>
                  <button   type="submit" class="btn  btn-sm  btn-project"><i class="fa fa-bank "></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      {{ $allarrows->links() }}
    </div>
@endsection
