@extends('dashboard.index')
@section('title',' التقارير المالية')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item active" aria-current="page"> التقارير المالية   </li>
    </ol>
    </nav>
    <div class="projects">
      <div class="h5"> التقارير المالية  </div>
      <div class="row " style="margin-bottom:15px">
        <div class="col">
          <form class="" action="" method="post">
            <input type="text" class="form-control" name="" value="">
          </form>
        </div>

        <div class="col offset-md-8">
          {{-- <a type="button" class="btn  border border-dark " name="button">  <i class="fa fa-upload fa-lg"></i>  تصدير </a>
          <a type="button" class="btn  border border-dark " name="button"> <i class="fa fa-download fa-lg"></i> استيراد </a> --}}
              <!-- Button trigger modal Create New Projects -->
          {{-- <button data-toggle="modal" data-target="#createProject" type="button" class="btn text-orange text-white " name="button">  <i class="fa fa-plus "></i> &nbsp;&nbsp; أنشاء </a> --}}
        </div>

      </div>

       

      <table class="table table-hover table-bordered">
        <thead>
          <th>#</th>
          <th>   المبادرة</th>
          <th>   التكلفة</th>
          <th> الواتساب</th>
          <th> أحداث  </th>
        </thead>
        <tbody>
            <?php
                $ids = 0;
            ?>
          @foreach ($allprojects as $project)
          <?php
          $ids++;
          ?>
            <tr>
              <td> رقم {{$ids  }} </td>
              <td>{{$project->projectName}}</td>
              <td>{{$project->projectCost}}</td>
              <td>{{$project->whatsapp}}</td>
              
              <td>
                  <a class="btn  btn-sm ml-1" href="{{route('dDetail',$project->projectId)}}" > <i class=" mr-1 ml-1 fa fa-eye "></i> تقرير</a>
                {{-- <form class="form-inline" action="{{route('projects.destroy',$project->projectId) }}" method="post">
                  @csrf
                  @method("DELETE")
                 
                  <button   type="submit" class="btn  btn-sm  btn-project"><i class="fa fa-bank "></i></button>
                </form> --}}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
       
          
         {{$allprojects->links() ?? null }}
    </div>
@endsection
