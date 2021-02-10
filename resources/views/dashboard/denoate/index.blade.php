@extends('dashboard.index')
@section('title',' تفاصيل الدفع ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item active" aria-current="page">  تفاصيل الدفع الفواتير     </li>
    </ol>
    </nav>
    <div class="projects">
      <div class="h5"> تفاصيل الدفع  الفواتير  لكل المشاريع </div>
      <div class="row " style="margin-bottom:15px">
        <div class="col">
          <form class="" action="" method="post">
            <input type="text" class="form-control" name="" value="" style="margin-top:2rem;">
          </form>
        </div>
        <form  action="{{route('exportAllDenoate')}}" method="get">
          <div class="form-row">
            <div class="col">
              <label for="endDate" class="label-control ">
                  تاريخ النهاية
              </label>
              <input class="form-control" type="date" name="endDate" id="enddate"  value="{{old('endDate')}}" >
            </div>
            <div class="col">
              <label for="startdate" class="label-control">
                 تاريخ البداية
              </label>
              <input class="form-control" type="date" name="startDate"  id="startdate" value="{{old('startdate')}}">
            </div>
            <div class="col">
                <button type="submit"  class="btn  border border-dark ml-2 "  style="margin-top:2rem"  name="exportAllDenoate"><i class="fa fa-upload fa-lg"></i> تصدير </button>
            </div>
          </div>

        </form>
          <button data-toggle="modal" data-target="#createProject" type="button" class="btn text-orange text-white ml-2 " style="margin-top:2rem" name="button">  <i class="fa fa-plus "></i> &nbsp;&nbsp;  تبرع جديد </button>
        {{-- <div class="col offset-lg-6"> --}}

          {{-- <a href="{{route('exportAllDenoate')}}" class="btn  border border-dark " name="button">  <i class="fa fa-upload fa-lg"></i>  تصدير </a> --}}

          {{-- <a type="button" class="btn  border border-dark " name="button"> <i class="fa fa-download fa-lg"></i> استيراد </a> --}}
              <!-- Button trigger modal Create New Projects -->

        {{-- </div> --}}

      </div>

      <!-- Modal -->
      <div class="modal fade" id="createProject" tabindex="-1" data-keyboard="false"  data-backdrop="static" aria-labelledby="createProjectLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createProjectLabel">أنشاء تبرع جديد</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form  id="create-form" enctype="multipart/form-data" method="post" action="{{route('denoate.store')}}">
                @csrf
                @method('POST')
                <div class="form-row">
                  <div class="col">
                    <?php
                      $projects = App\Models\Projects::all();
                      // dd($projects);
                    ?>
                    <label class="label-control" for="projectTable">إسم المشروع</label>
                    <select class="form-control p-0" name="projectTable" >
                        <option >أختر المشروع </option>
                        @foreach ($projects as $categories)
                          <option  class="form-control" value="{{$categories->projectId}}">{{$categories->projectName}}</option>
                        @endforeach
                    </select>
                   </div>
                  <div class="col">
                    <?php
                      $paymethods = App\Models\PaymentMethod::all();
                      // dd($projectsCategories);
                    ?>
                    <label class="label-control" for="paymentMethodTable"> طريقة الدفع  </label>
                    <select class="form-control p-0" name="paymentMethodTable" >
                        <option >أختر  طريقة الدفع</option>
                        @foreach ($paymethods as $pay)
                          <option  class="form-control" value="{{$pay->methodId}}">{{$pay->methodName}}</option>
                        @endforeach
                    </select>
                  </div>
                   <div class="col">
                    <label class="label-control" for="denoateName"> إسم المتبرع</label>
                    <input type="text" class="form-control" name="denoateName" placeholder="إسم المتبرع">
                  </div>

                </div>
                <div class="form-row mt-3">
                  <div class="col">
                    <label class="label-control" for="denoatePhone">  رقم الهاتف    </label>
                    <input type="text" class="form-control" name="denoatePhone" placeholder=" رقم الهاتف  ">
                  </div>


                  <div class="col">
                    <label class="label-control" for="moneyValue"> مبلغ التبرع  </label>
                    <input type="text" name="moneyValue" class="form-control" placeholder=" 200000 SAR  ">
                  </div>
                </div>
                <div class="form-row">


                  <div class="col" style="margin-top:8%">

                    <div class="form-check">

                      <label class="form-check-label" for="denoateStatus">

                        <input class="form-check-input" type="radio" name="denoateStatus" id="denoateStatus" value="1"  >

                        تفعيل

                      </label>

                    </div>

                    <div class="form-check">

                      <label class="form-check-label" for="denoateStatus">

                        <input class="form-check-input" type="radio" name="denoateStatus" id="denoateStatus" value="0"  >

                     حظر

                      </label>

                    </div>

                </div>


                </div>


            </div>
            <div class="modal-footer d-block">
              <button type="button" class="btn text-warning btn-main" data-dismiss="modal">الغاء</button>
              <button type="submit" class="btn text-orange text-white "> إضافة تبرع <i class="fa fa-plus"></i></button>
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
          <th>   المشروع</th>
          <th>  إسم  المتبرع </th>
          <th> رقم الهاتف </th>
          <th>   مبلغ التبرع</th>
          <th> وسيلة الدفع  </th>
          <th> تاريخ الدفع  </th>
          <th> الحالة  </th>
          <th> أحداث  </th>
        </thead>
        <tbody>
          @foreach ($allDenoate as $denoate)
            <tr>
              <td> رقم  {{$denoate->denoateId}}  </td>
              <td>{{\App\Models\Projects::find($denoate->projectTable)->projectName}}</td>
              <td>{{  $denoate->denoateName}}</td>
              <td>{{$denoate->denoatePhone}}</td>
              <td>{{$denoate->moneyValue}} <span>SAR</span> </td>
              <td>{{\App\Models\PaymentMethod::find($denoate->paymentMethodTable)->methodName}}</td>
              <td>{{$denoate->created_at}}</td>
              <td class="@if ($denoate->denoateStatus==1) text-success  @else text-danger   @endif">
                @if ($denoate->denoateStatus==1)
                  تم الدفع
                @else
                   لم يتم الدفع
                @endif
              </td>
              <td>
                <form class="form-inline" action="{{route('denoate.destroy',$denoate->denoateId) }}" method="post">
                  @csrf
                  @method("DELETE")
                  <a class="btn  btn-sm ml-1" href="{{route('denoate.edit',$denoate->denoateId)}}" ><i class="fa fa-edit "></i></a>
                  <button   type="submit" class="btn  btn-sm  btn-project"><i class="fa fa-bank "></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $allDenoate->links() }}
    </div>
@endsection
