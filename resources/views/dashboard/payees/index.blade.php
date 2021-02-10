@extends('dashboard.index')

@section('title','إدارة  ألمستفيدين ')

@section('dashboard-content')

  <nav aria-label="breadcrumb">

    <ol class="breadcrumb">

      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>

      <li class="breadcrumb-item active "  > <a href="{{route('payees.index')}}"> إدارة المستفيدين  </a></li>

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

              <!-- Button trigger modal Create New payees -->

          <button data-toggle="modal" data-target="#createmembers" type="button" class="btn text-orange text-white " name="button">  <i class="fa fa-plus "></i> &nbsp;&nbsp; أنشاء </a>

        </div>



      </div>



      <!-- Modal -->

      <div class="modal fade" id="createmembers" tabindex="-1" data-keyboard="false"  data-backdrop="static" aria-labelledby="createmembersLabel" aria-hidden="true">

        <div class="modal-dialog  modal-lg">

          <div class="modal-content">

            <div class="modal-header">

              <h5 class="modal-title" id="createmembersLabel"> أضافة مستفيد   </h5>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

              </button>

            </div>

            <div class="modal-body">



              <form  id="create-form" enctype="multipart/form-data" method="post" action="{{route('payees.store')}}">

                @csrf

                @method('POST')

                <div class="form-row">

                  <div class="col">

                    <label class="label-control" for="pName"> الاسم  </label>

                    <input id="pName" type="text" name="pName" class="form-control w-40" value="{{old('pName')}}" placeholder="أكتب  الاسم     ">

                  </div>



                </div>

                <div class="form-row">

                  <div class="col">

                    <label class="label-control" for="healthState">  الحالة الصحية </label>

                    <input style="margin-right: 10%;" id="healthState" type="text" name="healthState" value="{{old('healthState')}}"  placeholder="أدخل الحالة الصحية" class="form-control w-80"  >

                  </div>

                </div>

                <div class="form-row">

                  <div class="col">

                    <label class="label-control" for="ssnNumber">  رقم الهوية   </label>

                    <input style="margin-right: 10%;" id="ssnNumber" type="text" name="ssnNumber" value="{{old('ssnNumber')}}" placeholder="أدخل رقم الهوية"   class="form-control w-80"  >

                  </div>

                </div>

                <div class="form-row">

                  <label  class="label-control" for="ssnNumber"> أختر الجنس</label>



                  <select class="form-control mb-3" name="gender" style="padding:0 8px 0 0;">

                    <option class=""  required>الجنس</option>

                    @if (old('gender') ==  "male")  @endif

                    <option class="" value="male"     @if (old('gender') ==  "male")  selected @endif>ذكر</option>

                    <option class="" value="female"   @if (old('gender') ==  "female") selected @endif>أنثى</option>

                  </select>

                </div>

                {{-- <div class="form-row">

                  <div class="col">

                    <label class="label-control" for="ssnNumber">     </label>

                    <input style="margin-right: 10%;" type="file" name="pImage" class="form-control-file">

                  </div>

                </div> --}}

                <div class="form-row">

                  <div class="col" style="margin-top:8%">

                    <div class="form-check">

                      <label class="form-check-label" for="pStatus">

                        <input class="form-check-input" type="radio" name="pStatus" id="pStatus" value="1"    >

                        تفعيل

                      </label>

                    </div>

                    <div class="form-check">

                      <label class="form-check-label" for="pStatus">

                        <input class="form-check-input" type="radio" name="pStatus" id="pStatus" value="0"    >

                     الغاء

                      </label>

                    </div>

                  </div>

                </div>

            <div class="modal-footer">

              <button type="button" style="margin-right:10%" class="btn text-warning btn-main" data-dismiss="modal">الغاء</button>

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

          <th> الإسم </th>

          <th>  الحالة الصحية </th>

          <th> رقم الهوية الوطنية</th>

          <th>الجنس</th>

          <th>الحالة   </th>

          <th> أحداث  </th>

        </thead>

        <tbody>

          @foreach ($allpayees as $payees)

            <tr>

              <td>  رقم {{$payees->payeeId}} </td>

              <td>{{  $payees->pName }}</td>

              <td>{{  $payees->healthState }}</td>

              <td>{{  $payees->ssnNumber }}</td>

              <td>

              @if ($payees->gender == "male")

                ذكر

              @else

                أنثى

              @endif</td>



              <td class="@if ($payees->pStatus ==1) text-success  @else text-danger   @endif">

                @if ($payees->pStatus ==1)

                <span class="  alert-success">  تم التفعيل</span>

                @else

                  غير مفعل

                @endif

              </td>

               <td>

                <form class="form-inline" action="{{route('payees.destroy',$payees->pId) }}" method="post">

                  @csrf

                  @method("DELETE")

                  <a class="btn  btn-sm ml-1" href="{{route('payees.edit',$payees->pId)}}" ><i class="fa fa-edit "></i></a>

                  <button   type="submit" class="btn  btn-sm  btn-project"><i class="fa fa-bank "></i></button>

                </form>

              </td>

            </tr>

          @endforeach

        </tbody>

      </table>

      {{$allpayees->links()}}

    </div>

@endsection
