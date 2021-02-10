@extends('dashboard.index')
@section('title',' المحتاجين  المتقدمين ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item active "  > <a>  المحتاجين  </a></li>
     </ol>
    </nav>
    <div class="users">

      <div class="row " style="margin-bottom:15px">
        <div class="col-sm-6">
          <form class="" action="" method="post">
            <input type="text" class="form-control" name="" value="">
          </form>
        </div>

      </div>

       {{-- Errors message --}}
      @include('includes.errors')
      {{-- success message --}}
      @include('includes.success')

      <table class="table table-hover table-bordered">
        <thead>
          <th>#</th>
          <th>   الاسم </th>
          <th>    الجوال </th>
          <th>  العنوان</th>
          <th> إسم المحتاج</th>
          <th> التفاصيل  </th>
          <th>أحداث</th>
        </thead>
        <tbody>
  
          @foreach ($allneedy as $needy)
            <tr>
              <td> رقم {{ $needy->dulniId }}</td>
              <td>{{  $needy->name }}</td>
              <td>{{  $needy->phone }}</td>
              <td>{{  $needy->address }}</td>
              <td>{{  $needy->needy }}</td>
              <td>{{  $needy->details }}</td>
              <td>
              <form class="form-inline" action="{{route('dulni.destroy',$needy->dulniId) }}" method="post">
                  @csrf
                  @method("DELETE")
                  <a class="btn  btn-sm ml-1" href="{{route('dulni.show',$needy->dulniId)}}" ><i class="fa fa-eye "></i></a>
                  <button   type="submit" class="btn  btn-sm  btn-project"><i class="fa fa-bank "></i></button>

                </form>
                </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
@endsection
