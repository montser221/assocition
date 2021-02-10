@extends('dashboard.index')

@section('title','    معلومات حول  الجمعية')

@section('dashboard-content')

  <nav aria-label="breadcrumb">

    <ol class="breadcrumb">

      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>

      <li class="breadcrumb-item  active" aria-current="page"> <a href="{{route('aboutassoiation.index')}}">إدارة معلومات حول الجمعية </a></li>

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

              <!-- Button trigger modal Create New aboutassoiation -->

           <?php $check = 0 ?>
              @foreach ($allaboutassoiation  as $about)
               @if ($about->associationId == 1)
                  <?php $check = 1 ?>
               @else

               @endif
              @endforeach
          @if($check ==1)

          @else

          <button data-toggle="modal" data-target="#createPaymentMethod" type="button" class="btn text-orange text-white " name="button">  <i class="fa fa-plus "></i> &nbsp;&nbsp; أنشاء </a>
          @endif

        </div>



      </div>



      <!-- Modal -->

      <div class="modal fade" id="createPaymentMethod" tabindex="-1" data-keyboard="false"  data-backdrop="static" aria-labelledby="createPaymentMethodLabel" aria-hidden="true">

        <div class="modal-dialog  modal-lg">

          <div class="modal-content">

            <div class="modal-header">

              <h5 class="modal-title text-right" id="createPaymentMethodLabel">أنشاء معلومات الجمعية    </h5>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

              </button>

            </div>

            <div class="modal-body">

{{-- // 'associationTitle','managerWord','showInHome','managerName','associationIcon' --}}

              <form  id="create-form" enctype="multipart/form-data" method="post" action="{{route('aboutassoiation.store')}}">

                @csrf

                @method('POST')

                <div class="form-row">

                  <div class="col">

                    <label class="label-control" for="associationTitle">  العنوان  </label>

                    <input id="inputmethodName" type="text" name="associationTitle" class="form-control w-40" placeholder="أكتب العنوان ">

                  </div>

                  <div class="col">

                    <label class="label-control" for="managerName">  الرئيس  </label>

                    <input id="inputmethodName" type="text" name="managerName" class="form-control w-40" placeholder="أكتب إسم رئيس الجمعية ">

                  </div>

                </div>

                <div class="form-row">

                  <div class="col">

                    <label class="label-control" for="managerWord"> كلمة الرئيس   </label>

                  <textarea class="form-control" name="managerWord" rows="5" cols="80" placeholder="أكتب كلمة الرئيس هنا"></textarea>

                  </div>

                  <div class="col">

                    <label class="label-control" for="associationIcon"> الايقونة   </label>

                    <input class="form-control-file" style="margin-right: 10%;" id="associationIcon" type="file" name="associationIcon" class="form-control w-80"  >

                  </div>

                </div>

                <div class="form-row">

                  <div class="col">

                    <label class="label-control" for="vison">  الرؤية  </label>

                    <textarea class="form-control" name="vison" rows="5" cols="40" placeholder="أكتب الرؤية هنا"></textarea>

                  </div>

                  <div class="col">

                    <label class="label-control" for="message">  الرسالة  </label>

                    <textarea class="form-control" name="message" rows="5" cols="40" placeholder="اكتب الرسالة هنا"></textarea>

                  </div>

                </div>



                <div class="form-row">

                  <div class="col">

                    <label class="label-control mt-2" for="messageIcon">  ايقونة الرسالة </label>

                   <input class="form-control-file" style="margin-right: 10%;" id="messageIcon" type="file" name="messageIcon" class="form-control w-80"  >

                  </div>

                  <div class="col">

                    <label class="label-control mt-2" for="visonIcon"> ايقونة الرؤية   </label>

                    <input class="form-control-file" style="margin-right: 10%;" id="visonIcon" type="file" name="visonIcon" class="form-control w-80"  >

                  </div>

                </div>

                <div class="form-row">

                  <div class="col" style="margin-top:8%">

                    <div class="form-check">

                      <label class="form-check-label" for="userStatus">

                        <input class="form-check-input" type="radio" name="associationStatus" id="associationStatus" value="1"  >

                           تفعيل

                      </label>

                    </div>

                    <div class="form-check">

                      <label class="form-check-label" for="userStatus">

                        <input class="form-check-input" type="radio" name="associationStatus" id="associationStatus" value="0"  >

                        الغاء

                      </label>

                    </div>

                </div>

                <div class="col">

                  <div class="form-group form-check">

                    <input class="form-check-input mr-3" type="checkbox" id="showInHome" name="showInHome" >

                    <label class="form-check-label" for="showInHome"  > عرض في الرئسية  </label>

                  </div>

                </div>

                </div>



            <div class="modal-footer">

                <button type="button" class="btn text-warning btn-main" data-dismiss="modal">الغاء</button>

              <button style="margin: 0 4%;" type="submit" class="btn text-orange text-white "> إضافة <i class="fa fa-plus"></i></button>

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

          <th>  العنوان</th>

          <th>  الايقونة   </th>

          <th>  ايقونة الرؤية   </th>

          <th>  إيقونة الرسالة   </th>

          <th>  الرئيس</th>

          {{-- <th>  ظهور في الرئسية</th> --}}

          <th>الحالة</th>

          <th> أحداث  </th>

        </thead>

        <tbody>

          @foreach ($allaboutassoiation as $about)

            <tr>

              <td>   {{$about->associationId}}  </td>

              <td>{{  $about->associationTitle }}</td>

              <td><img class="img-responsive img-thambnail" style="max-width:40px" src="{{  url('uploads/aboutassoiation/'.$about->associationIcon )}}" alt="" /></td>

              <td><img class="img-responsive img-thambnail" style="max-width:40px" src="{{  url('uploads/aboutassoiation/'.$about->visonIcon )}}" alt="" /></td>

              <td><img class="img-responsive img-thambnail" style="max-width:40px" src="{{  url('uploads/aboutassoiation/'.$about->messageIcon )}}" alt="" /></td>

              <td>{{  $about->managerName }}</td>

              <td   class="@if ( $about->showInHome ==1) text-success  @else text-danger @endif">

                @if ( $about->showInHome ==1)

                  نعم

                @else

                  لا

                @endif

              </td>

              <td   class="@if ( $about->associationStatus ==1) text-success  @else text-danger @endif">

                @if ( $about->associationStatus ==1)

                  تم التفعيل

                @else

                  غير مفعلة

                @endif

              </td>



              <td>

                <form class="form-inline" action="{{route('aboutassoiation.destroy',$about->associationId) }}" method="post">

                  @csrf

                  @method("DELETE")

                  <a class="btn  btn-sm ml-1" href="{{route('aboutassoiation.edit',$about->associationId)}}" ><i class="fa fa-edit "></i></a>

                  {{-- <button   type="submit" class="btn  btn-sm  btn-project"><i class="fa fa-bank "></i></button> --}}

                </form>

              </td>

            </tr>

          @endforeach

        </tbody>

      </table>

    </div>

@endsection
