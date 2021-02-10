@extends('dashboard.index')

@section('title','   تعديل معلومات حول  الجمعية ')

@section('dashboard-content')

  <nav aria-label="breadcrumb">

    <ol class="breadcrumb">

      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>

      <li class="breadcrumb-item   " aria-current="page"> <a href="{{route('aboutassoiation.index')}}">إدارة معلومات حول الجمعية </a></li>

      <li class="breadcrumb-item active">   تعديل معلومات حول  الجمعية    </li>

    </ol>

    </nav>

    <div class="aboutassoiation-edit" style="background-color:#FFF;padding:15px">



      {{-- Errors message --}}

      @include('includes.errors')

      @include('includes.success')

      <h5 class="text-right mr-3"  > تعديل معلومات حول  الجمعية  </h5>



      <form  id="user-edit-form" enctype="multipart/form-data"  method="post" action="{{route('aboutassoiation.update',$data->associationId)}}">

        @csrf

        @method('PATCH')

        <div class="form-row">

          <div class="col">

            <label class="label-control" for="associationTitle">  العنوان  </label>

            <input id="inputmethodName" type="text" name="associationTitle" class="form-control w-40" value="{{$data->associationTitle ?? ''}}">

          </div>

          <div class="col">

            <label class="label-control" for="managerName">  الرئيس  </label>

            <input id="inputmethodName" type="text" name="managerName" class="form-control w-40" value="{{$data->managerName ?? ''}}">

          </div>

        </div>

        <div class="form-row">

          <div class="col">

            <label class="label-control" for="managerWord"> كلمة الرئيس   </label>

          <textarea class="form-control" name="managerWord" rows="4" cols="40"> {{$data->managerWord ?? ''}}</textarea>

          </div>

          <div class="col">

            <label class="label-control" for="associationIcon"> الايقونة   </label>

            <input class="form-control-file"   id="associationIcon" type="file" name="associationIcon" class="form-control w-80"  >

          </div>

        </div>



        <div class="form-row">

          <div class="col">

            <label class="label-control" for="vison">  الرؤية  </label>

            <textarea    class="form-control" name="vison" rows="5" cols="40" placeholder="أكتب الرؤية هنا"> {{$data->vison ?? ''}} </textarea>

          </div>

          <div class="col">

            <label class="label-control" for="message">  الرسالة  </label>

            <textarea   class="form-control" name="message" rows="5" cols="40" placeholder="اكتب الرسالة هنا"> {{$data->message ?? ''}}</textarea>

          </div>

        </div>



        <div class="form-row">

          <div class="col">

            <label class="label-control mt-2" for="messageIcon">  ايقونة الرسالة </label>

           <input class="form-control-file"   id="messageIcon" type="file" name="messageIcon" class="form-control w-80"  >

          </div>

          <div class="col">

            <label class="label-control mt-2" for="visonIcon"> ايقونة الرؤية   </label>

            <input class="form-control-file"   id="visonIcon" type="file" name="visonIcon" class="form-control w-80"  >

          </div>

        </div>



        <div class="form-row mt-4 mb-3">

          <div class="col"   >

            <div class="form-check">

              <label class="form-check-label" for="associationStatus">

                <input class="form-check-input" type="radio" name="associationStatus" id="associationStatus" value="1"  >

                   تفعيل

              </label>

            </div>

            <div class="form-check">

              <label class="form-check-label" for="associationStatus">

                <input class="form-check-input" type="radio" name="associationStatus" id="associationStatus" value="0"  >

                الغاء

              </label>

            </div>

        </div>

        <div class="col">

          <div class="form-group form-check">

            <input class="form-check-input" type="checkbox" id="showInHome" name="showInHome"  @if ($data->showInHome==1) checked="checked" @else  @endif  value="{{$data->showInHome  ?? ''}}">

            <label class="form-check-label" for="showInHome" > عرض في الرئسية  </label>

          </div>

        </div>

        </div>



        <button class="btn text-orange text-white " type="submit" name="button"><i class="fa fa-plus"> </i>حفظ</button>

  </form>

</div>

@endsection

