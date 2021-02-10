@extends('dashboard.index')
@section('title','    تعديل  تبرع  ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item " aria-current="page"> <a href="{{route('denoate.index')}}">تفاصيل الدفع  </a></li>
      <li class="breadcrumb-item active">   تعديل تبرع  </li>
    </ol>
    </nav>
    <div class="projects-edit" style="background-color:#FFF;padding:15px">
      {{-- Errors message --}}
      @include('includes.errors')
      @include('includes.success')
      <h5>تعديل تبرع </h5>

      <form  id="edit-form"   method="post" action="{{route('denoate.update',$data->denoateId)}}">
        @csrf
        @method('PATCH')
        <div class="form-row">
          <div class="col">
            <?php
              $projects = App\Models\Projects::all();
              // dd($projects);
            ?>
            <label class="label-control" for="projectTable">إسم المشروع</label>
            <select class="form-control" name="projectTable" >
                <option >أختر المشروع </option>
                @foreach ($projects as $categories)

                      <option     @if($data->projectTable== $categories->projectId ) selected="selected"   @endif class="form-control" value="{{$categories->projectId}}">{{$categories->projectName}}</option>

                @endforeach
            </select>
           </div>
          <div class="col">
            <?php
              $paymethods = App\Models\PaymentMethod::all();
              // dd($projectsCategories);
            ?>
            <label class="label-control" for="paymentMethodTable"> طريقة الدفع  </label>
            <select class="form-control" name="paymentMethodTable" >
                <option >أختر  طريقة الدفع</option>
                @foreach ($paymethods as $pay)

                  <option @if($data->paymentMethodTable== $pay->methodId ) selected="selected"    @endif class="form-control" value="{{$pay->methodId}}">{{$pay->methodName}}</option>

                @endforeach
            </select>
          </div>
          <div class="col">
              <label class="label-control" for="denoateName"> إسم المتبرع</label>
              <input type="text" class="form-control" name="denoateName" value="{{$data->denoateName}}">
            </div>
        </div>
        <div class="form-row mt-3">
          <div class="col">
            <label class="label-control" for="denoatePhone">  رقم الهاتف    </label>
            <input type="text" class="form-control" name="denoatePhone"  value="{{$data->denoatePhone}}">
          </div>


          <div class="col">
            <label class="label-control" for="moneyValue"> مبلغ التبرع  </label>
            <input type="text" name="moneyValue" class="form-control" value="{{$data->moneyValue}}">
          </div>

        </div>
        <div class="form-row">
          <div class="col" style="margin-top:4%;margin-bottom:4%">

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


        <div class="form-row">
 
           <button type="submit" class="btn text-orange text-white "> حفظ التعديلات <i class="fa fa-save"></i></button>
        </div>
    </form>
    </div>

    {{-- End Modal Edit --}}
@endsection
