@extends('dashboard.index')

@section('title','تبرعات المبادرة')

@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item  " aria-current="page"> <a href="{{route('money.index')}}">التقارير المالية</a> </li>
      <li class="breadcrumb-item active" aria-current="page"> تقرير المبادرة   </li>
    </ol>
    </nav>
    <div class="projects">
      <div class="h5">تقرير المبادرة</div>
      <div class="row " style="margin-bottom:15px">
        <div class="col">
          <form class="" action="" method="post">
            <input type="text" class="form-control" name="" value="" style="margin-top:2rem;">
          </form>
        </div>
        <?php $id=0 ?>
      @foreach($allDenoate as $d)
      <?php $id=$d->projectTable ?? null ?>
      @endforeach
        @if($id!=0)
        <form  action="{{route('exportToExcel',$id)}}" method="get">
              <input type="hidden" name="id" value="{{ $id }}" />
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

      @else

      @endif
        <div class="col  offset-lg-7">


          {{-- <form action="{{route('exportToExcel',$id)}}" method="get" style="display:-webkit-inline-box; max-width: 190px;margin-left: 15px;" >
              <input type="hidden" name="id" value="{{ $id }}" />
              <input type="date" name="month" class="form-control" style=" margin-right: 10px;"/>
              <button class="btn  border border-dark " name="export" type="submit">  <i class="fa fa-upload fa-lg"></i>  تصدير </button>
          </form> --}}


          {{-- <a type="button" class="btn  border border-dark " name="button"> <i class="fa fa-download fa-lg"></i> استيراد </a> --}}
              <!-- Button trigger modal Create New Projects -->
         {{--  <button data-toggle="modal" data-target="#createProject" type="button" class="btn text-orange text-white " name="button">  <i class="fa fa-plus "></i> &nbsp;&nbsp; أنشاء </a> --}}
        </div>

      </div>
@include('includes.errors')
		<table class="table table-hover table-bordered projectDenoate" >
        <thead>
          <th>#</th>
          <th>   المبادرة</th>
          <th> إسم المتبرع</th>
          <th> رقم الهاتف </th>
          <th>   مبلغ التبرع</th>
          <th> وسيلة الدفع  </th>
          <th> تاريخ الدفع  </th>
          <th> الحالة  </th>

        </thead>
        <tbody>

      	@foreach($allDenoate as $denoate)
      		<tr>
      			<td>{{$denoate->denoateId}}</td>
      			<td>{{$denoate->project->projectName ?? ""}}</td>
      			<td>{{$denoate->denoateName}}</td>
      			<td>{{ $denoate->denoatePhone }}</td>
      			<td>{{$denoate->moneyValue}}</td>
      			<td>{{$denoate->pmethods->methodName}}</td>
      			<td>{{$denoate->created_at }}</td>
      			<td class="@if($denoate->denoateStatus==1) alert alert-success @else alert alert-danger @endif">
      				@if($denoate->denoateStatus==1)
      				 تم الدفع
      				@else
	      				لم يتم الدفع
  					@endif
      			</td>
      		</tr>
      	@endforeach
       </tbody>
      </table>
    </div>
@endsection
