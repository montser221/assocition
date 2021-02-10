@extends('dashboard.index')
@section('title','إدارة الشركاء')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item active" aria-current="page"> <a href="{{route('agents.index')}}"> إدارة الشركاء   </a></li>
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
              <!-- Button trigger modal Create New agents -->
          <button data-toggle="modal" data-target="#createagents" type="button" class="btn text-orange text-white " name="button">  <i class="fa fa-plus "></i> &nbsp;&nbsp; أنشاء </button>
        </div>
 
      </div>

      <!-- Modal -->
      <div class="modal fade" id="createagents" tabindex="-1" data-keyboard="false"  data-backdrop="static" aria-labelledby="createagentsLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createagentsLabel">أضافة عميل جديد</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form  id="create-form" enctype="multipart/form-data" method="post" action="{{route('agents.store')}}">
                @csrf
                @method('POST')
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="agentName">إسم العميل </label>
                    <input id="inputagentName" type="text" name="agentName" class="form-control w-40" placeholder="إسم العميل" >
                  </div>
                </div>
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="agentImage">  شعار العميل   </label>
                    <input style="margin-right: 10%;" id="agentImage" type="file" name="agentImage" class="form-control-file w-80" >
                  </div>
                </div>
                <div class="form-row">
                  <div class="col" style="margin-top:8%">
                    <div class="form-check">
                      <label class="form-check-label" for="agentStatus">
                        <input class="form-check-input" type="radio" name="agentStatus" id="agentStatus" value="1"  >
                        تفعيل
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label" for="agentStatus">
                        <input class="form-check-input" type="radio" name="agentStatus" id="agentStatus" value="0"  >
                     الغاء
                      </label>
                    </div>
                  </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn text-warning btn-main mr-5" data-dismiss="modal">الغاء</button>
              <button style="width: 12%;margin: 0 8%;" type="submit" class="btn text-orange text-white "> إضافة <i class="fa fa-plus"></i></button>
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
          <th> إسم العميل </th>
          <th>  شعار العميل   </th>
          <th>  الحالة </th>
          <th> أحداث  </th>
        </thead>
        <tbody>
          @foreach ($allagents as $agent)
            <tr>
              <td>   {{$agent->agentId}} </td>
              <td>{{  $agent->agentName }}</td>
              <td><img class="img-responsive img-thambnail" style="max-width:40px" src="{{  url('uploads/agents/'.$agent->agentImage )}}" alt="" /></td>

              <td class="@if ($agent->agentStatus ==1) text-success  @else text-danger   @endif">
                @if ($agent->agentStatus ==1)
                  تم التفعيل
                @else
                  غير مفعل
                @endif
              </td>
              <td>
                <form class="form-inline" action="{{route('agents.destroy',$agent->agentId) }}" method="post">
                  @csrf
                  @method("DELETE")
                  <a class="btn  btn-sm ml-1" href="{{route('agents.edit',$agent->agentId)}}" ><i class="fa fa-edit "></i></a>
                  <button   type="submit" class="btn  btn-sm  btn-project"><i class="fa fa-bank "></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

 {{--      {{$allagents->links()}} --}}
    </div>
@endsection
