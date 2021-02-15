@extends('dashboard.index')
@section('title','    المشتركين في الدورات التدريبية  ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item active" aria-current="page">المشتركين في الدورات التدريبية   </li>
    </ol>
    </nav>
    <div class="projects">
      <div class="h5">المشتركين في الدورات التدريبية   </div>
      <div class="row " style="margin-bottom:15px">
        <div class="col">
          <form class="" action="" method="post" style="width:50%">
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
          <th>   الاسم</th>
          <th> الايمل</th>
          <th> تاريخ الميلاد</th>
          <th>   الهاتف</th>
          <th>   الدورة </th>
           <th>  كرت العائلة</th>
           <th>     الايصال</th>
           <th>تاريخ التقديم</th>
          <th> أحداث  </th>
        </thead>
        <tbody>
        <?php $ids = 0?>
          @foreach ($alltrainner as $trainner)
            <?php $ids++?>
            <tr>
              <td>  {{$ids}}  </td>
              <td>{{$trainner->subscriberName  }}</td>
              <td>{{$trainner->subscriberEmail}}</td>
              <td>{{$trainner->subscriberBirthOfDate}}</td>
              <td>{{$trainner->subscriberPhone}}</td>
              <td>{{ \App\Models\TrainningCourses::find($trainner->trainningCourseId )->courseName}}</td>
              <td data-toggle="tooltip"  offset="2" data-placement="top" title="أضغط لعرض الصورة"> <a target="_blank"   href="{{url("storage/".$trainner->subscriberFamilyCard)}}" > <img style="max-width:40px;max-height:40px" src="{{url("storage/".$trainner->subscriberFamilyCard)}}" class="viewImage" alt="" /></i> </a></td>
              {{-- @if() --}}
              <td data-toggle="tooltip"  offset="2" data-placement="top" title="أضغط لعرض الصورة"> <a target="_blank"   href="{{url("storage/".$trainner->subscriberMoneyStatement ?? '')}}" > <img style="max-width:40px;max-height:40px" src="{{url("storage/".$trainner->subscriberMoneyStatement ?? '')}}" class="viewImage" alt="" /></i> </a></td>
              {{-- @endif --}}
              <td>{{ $trainner->subscriberBirthOfDate }}</td>
              <td>
                <form class="form-inline" action="{{route('subscribenow.destroy',$trainner->subscriberId ) }}" method="post">
                  @csrf
                  @method("DELETE")
                  {{-- <a class="btn  btn-sm ml-1" href="{{route('subscribenow.show',$trainner->subscriberId )}}" ><i class="fa fa-eye "></i></a> --}}
                  <button   type="submit" class="btn  btn-sm  btn-trainner"><i class="fa fa-bank "></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="container">
          {{$alltrainner->links()}}
      </div>
    </div>
@endsection
