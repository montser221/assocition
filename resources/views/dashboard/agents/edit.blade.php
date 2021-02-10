@extends('dashboard.index')

@section('title','  تعديل  العميل   ')

@section('dashboard-content')

  <nav aria-label="breadcrumb">

    <ol class="breadcrumb">

      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>

      <li class="breadcrumb-item " aria-current="page"> <a href="{{route('projects.index')}}">إدارة  العملاء </a></li>

      <li class="breadcrumb-item active">   تعديل بيانات العميل    </li>

    </ol>

    </nav>

    <div class="paymentmethod-edit" style="background-color:#FFF;padding:15px">



      {{-- Errors message --}}

      @include('includes.errors')

      @include('includes.success')

      <h5 class="text-right" style="margin-right:10%">تعديل  بيانات العميل </h5>



      <form  id="user-edit-form" enctype="multipart/form-data"  method="post" action="{{route('agents.update',$data->agentId)}}">

        @csrf

          @method('PATCH')

          <div class="form-row">

            <div class="col">

              <label class="label-control" for="agentName">إسم العميل </label>

              <input id="inputagentName" type="text" name="agentName" class="form-control w-40" value="{{$data->agentName ?? ''}}" >

            </div>

          </div>

          <div class="form-row">

            <div class="col">

              <label class="label-control" for="agentImage">  شعار العميل   </label>

              <input style="margin-right: 10%;" id="agentImage" type="file" name="agentImage" class="form-control w-80"  >

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

        <div class="form-row">

            <button type="submit" class="btn text-orange text-white mt-3 " style="width:17%"> حفظ التعديلات <i class="fa fa-save"></i></button>

        </div>

    </form>

    </div>



@endsection

