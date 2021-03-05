@extends('dashboard.index')

@section('title','تبرعات المبادرة')

@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item active" aria-current="page"> تقرير المبادرة   </li>
    </ol>
    </nav>
    <div class="projects">
      <div class="h5">تقرير المبادرة</div>
      <div class="row " style="margin-bottom:15px">
        <div class="col">
          <form class="" action="" method="post">
            <input type="text" class="form-control" name="" value="">
          </form>
        </div>

        <div class="col  offset-lg-7">
        	@foreach($allDenoate as $d)
        	<?php $id=$d->projectTable ?>

        	@endforeach
        	<input type="hidden" name="id" value="1">
          <a href="{{route('exportToExcel',$id)}}" class="btn  border border-dark " name="button">  <i class="fa fa-upload fa-lg"></i>  تصدير </a>

          {{-- <a type="button" class="btn  border border-dark " name="button"> <i class="fa fa-download fa-lg"></i> استيراد </a> --}}
              <!-- Button trigger modal Create New Projects -->
         {{--  <button data-toggle="modal" data-target="#createProject" type="button" class="btn text-orange text-white " name="button">  <i class="fa fa-plus "></i> &nbsp;&nbsp; أنشاء </a> --}}
        </div>

      </div>

		<table class="table table-hover table-bordered projectDenoate" >
        <thead>
          <th>#</th>
          <th>   المبادرة</th>
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
      			<td>{{$denoate->projects->projectName}}</td>
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

