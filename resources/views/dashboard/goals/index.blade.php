@extends('dashboard.index')
@section('title',' إدارةالاهداف    ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item active "  > <a href="{{route('goals.index')}}">  إدارة أهداف الجمعية</a></li>
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
              <!-- Button trigger modal Create New goals -->
          <button data-toggle="modal" data-target="#createVideo" type="button" class="btn text-orange text-white " name="button">  <i class="fa fa-plus "></i> &nbsp;&nbsp; أنشاء </a>
        </div>

      </div>

      <!-- Modal -->
      <div class="modal fade" id="createVideo" tabindex="-1" data-keyboard="false"  data-backdrop="static" aria-labelledby="createVideoLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createVideoLabel"> أضافة  هدف جديد   </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form  id="create-form" enctype="multipart/form-data" method="post" action="{{route('goals.store')}}">
                @csrf
                @method('POST')
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="goal"> الهدف  </label>
                    <input id="goal" type="text" name="goal" class="form-control w-40" placeholder="أكتب الهدف">
                  </div>

                </div>


                <div class="form-row">
                  <div class="col" style="margin-top:8%">
                    <div class="form-check">
                      <label class="form-check-label" for="goalStatus">
                        <input class="form-check-input" type="radio" name="goalStatus" id="goalStatus" value="1"  >
                        تفعيل
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label" for="goalStatus">
                        <input class="form-check-input" type="radio" name="goalStatus" id="goalStatus" value="0"  >
                     الغاء
                      </label>
                    </div>
                </div>
                </div>
            <div class="modal-footer">
              <button type="button" class="btn text-warning btn-main" style="margin-right:10%"  data-dismiss="modal">الغاء</button>
              <button  type="submit" class="btn text-orange text-white "> إضافة <i class="fa fa-plus"></i></button>
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
          <th>  الهدف  </th>
          <th>الحالة   </th>
          <th> أحداث  </th>
        </thead>
        <tbody>
          @foreach ($allgoals as $goal)
            <tr>
              <td>  {{$goal->goalId}} </td>
              <td>{{  $goal->goal }}</td>
              <td class="@if ($goal->goalStatus==1) text-success  @else text-danger   @endif">
                @if ($goal->goalStatus==1)
                  تم التفعيل
                @else
                  غير مفعل
                @endif
              </td>
                <td>
                <form class="form-inline" action="{{route('goals.destroy',$goal->goalId) }}" method="post">
                  @csrf
                  @method("DELETE")
                  <a class="btn  btn-sm ml-1" href="{{route('goals.edit',$goal->goalId)}}" ><i class="fa fa-edit "></i></a>
                  <button   type="submit" class="btn  btn-sm  btn-project"><i class="fa fa-bank "></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
@endsection
