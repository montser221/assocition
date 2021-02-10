@extends('dashboard.index')
@section('title',' المتطوعين ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item active "  > <a> إدارة المتطوعين المتقدمين  </a></li>
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
        </div>
      </div>

      @include('includes.success')
      @include('includes.errors')
      <table class="table table-hover table-bordered table-responsive">
        <thead>
          <th>#</th>
          <th> الإسم </th>
          <th> إسم الاب </th>
          <th> إسم الجد </th>
          <th> الإسم الاخير </th>
          <th> ح إجتماعية </th>
          <th>ر . الهوية</th>
          <th>  الجنسية </th>
          <th>  الجنس </th>
          <th> الوظيفة </th>
          <th> جهة العمل </th>
          <th>السكن   </th>
          <th>ت الميلاد   </th>
          <th>الجوال   </th>
          <th>وقت التواصل   </th>
          <th> الايمل  </th>
          <th> أحداث  </th>
        </thead>
        <tbody>
          <?php $i=1; ?>
          @foreach ($allvolnt as $volnt)
            <tr>
              <td> رقم  {{$volnt->voluntaryId}} </td>
              <td>{{  $volnt->firstName }}</td>
              <td>{{  $volnt->fatherName }}</td>
              <td>{{  $volnt->grandFatherName }}</td>
              <td>{{  $volnt->lastName }}</td>
               <td class="@if ($volnt->socialState == 'married') text-success  @else text-danger   @endif">
                @if ($volnt->socialState == 'married')
                <span class="  alert-success">
                  متزوج
                </span>
                @else
           
          أعزب
                @endif
              </td>
              <td>{{  $volnt->ssnNumber }}</td>
              <td>{{  $volnt->natonality }}</td>

              <td>
              @if ($volnt->gender == "male")
                ذكر
              @else
                أنثى
              @endif</td>
              <td>{{  $volnt->jobTitle }}</td>
              <td>{{  $volnt->jobEmployer }}</td>
              <td>{{  $volnt->address }}</td>
              
              <td>{{  $volnt->birthDate }}</td>
              <td>{{  $volnt->phone }}</td>
              <td>{{  $volnt->bestContactTime }}</td>
              <td>{{  $volnt->email }}</td>
             
               <td>
                <form class="form-inline" action="{{route('volnt.destroy',$volnt->voluntaryId) }}" method="post">
                  @csrf
                  @method("DELETE")
                  <button   type="submit" class="btn  btn-sm  btn-project"><i class="fa fa-bank "></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{$allvolnt->links()}}
    </div>
@endsection
