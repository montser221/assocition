@extends('dashboard.index')

@section('title','  الاحصائيات    ')

@section('dashboard-content')

  <nav aria-label="breadcrumb">

    <ol class="breadcrumb">

      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item"><a > الاحصائيات  </a></li>

 
    </ol>

    </nav>

    <div class="users">

      <div class="h5"> الاحصائيات  </div>

      <div class="row " style="margin-bottom:15px">

        <div class="col">

          <form class="" action="" method="post">

            <input type="text" class="form-control" name="" value="">

          </form>

        </div>
        <div class="col offset-lg-8">
          {{-- <a type="button" class="btn  border border-dark " name="button">  <i class="fa fa-upload fa-lg"></i>  تصدير </a>
          <a type="button" class="btn   border border-dark" name="button"> <i class="fa fa-download fa-lg"></i> استيراد </a> --}}
              <!-- Button trigger modal Create New users -->
         <button data-toggle="modal" data-target="#createStat" type="button" class="btn text-orange text-white " name="button">  <i class="fa fa-plus "></i> &nbsp;&nbsp; أنشاء </a> 
        </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="createStat" tabindex="-1" data-keyboard="false"  data-backdrop="static" aria-labelledby="createStatLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createStatLabel">أنشاء  أحصائية جديدة  </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form  id="user-create-form" enctype="multipart/form-data" method="post" action="{{route("statistics.store")}}">
                @csrf
                @method('POST')
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="sName"> الاحصائية</label>

                    <input id="sName" type="text" name="sName" class="form-control" placeholder="أكتب إسم الاحصائية  ">

                  </div>

            
                </div>

                <div class="form-row">

                  <div class="col">

                    <label class="label-control" for="sValue">  القيمة  </label>

                    <input type="text" class="form-control" name="sValue" placeholder="أكتب القيمة">

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

                        <input class="form-check-input" type="radio" name="sStatus" id="sStatus" value="0"  >

                     حظر  

                      </label>

                    </div>

                </div>
               </div>

            </div>

            <div class="modal-footer">

              <button type="button" class="btn main-color " data-dismiss="modal">الغاء</button>

              <button type="submit" class="btn text-orange text-white "> إضافة <i class="fa fa-plus"></i></button>

            </div>

                </form>

          </div>

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
          <th>إسم الاحصائية  </th>
          <th> القيمة  </th>
          <th> تاريخ الانشاء  </th>
          <th> الحالة </th>
          <th>   أحداث  </th>
        </thead>
        <tbody>
         @foreach($statistics as $stat) 
            <tr>
              <td> رقم {{$stat->sId}}  </td>
              <td>{{  $stat->sName }}</td>
              <td>{{  $stat->sValue }}</td>
              <td>{{  $stat->created_at }}</td>
               
              <td class="@if ( $stat->sStatus ==1) text-success  @else text-danger @endif" >
                @if ( $stat->sStatus == 1)
                  تم التفعيل
                @else
                  غير مفعلة
                @endif
              </td>
              <td>
                <form class="form-inline" action="{{route('statistics.destroy',$stat->sId) }}" method="post">
                  @csrf
                  @method("DELETE")
                  <a class="btn  btn-sm ml-1" href="{{route('statistics.edit',$stat->sId)}}" ><i class="fa fa-edit "></i></a>
                  <button   type="submit" class="btn  btn-sm  btn-project"><i class="fa fa-bank "></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

       
         
  
@endsection
