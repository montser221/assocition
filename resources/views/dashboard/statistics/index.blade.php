@extends('dashboard.index')
@section('title','لوحة التحكم    ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
    </ol>
    </nav>
    <div class="users">
       {{-- Errors message --}}
      @include('includes.errors')
      {{-- success message --}}
      @include('includes.success')
      <?php
            $payees = \App\Models\Payee::all();
            $volnt = \App\Models\Voluntary::all();
             $totalWebsiteViews = \App\Models\Pages::totalViews();
             $totalPagesViews = \App\Models\Pages::all();
          
        ?>
     <div class="container">
       <div class="row">
       @foreach ($totalPagesViews as $pageViews )
          <div class="col-sm-6 col-md-4 col-lg-3  box">
           <i class="fa fa-user fa-3x d-flex" style="float:left"></i>
           <div class="">
             <?php
               echo $pageViews->totalViews;
              ?>
           </div>
           <small> عدد الزوار في {{ $pageViews->pageName }} </small>
         </div>

       @endforeach
        <div class="col-sm-6 col-md-4 col-lg-3  box">
           <i class="fa fa-user fa-3x d-flex" style="float:left"></i>
           <div class="">
             <?php
               echo $totalWebsiteViews;
              ?>
           </div>
           <small>إجمالي   عدد الزوار </small>
         </div>

         <div class="col-sm-6 col-md-4 col-lg-3  box">
           <i class="fa fa-user fa-3x d-flex" style="float:left"></i>
           <div class="">
             <?php
               echo $payees->count();
              ?>
           </div>
           <small>إجمالي طلب العضوية المتقدمين</small>
         </div>

         <div class="col-sm-6 col-md-4 col-lg-3 box">
           <i class="fa fa-user fa-3x d-flex" style="float:left"></i>
           <div class="">
           {{$volnt->count()}}
           </div>
           <small>إجمالي   المتطوعين المتقدمين</small>
         </div>
         @if($statistics ?? [])
         @foreach($statistics as $stat) 
           <div class="col-sm-6 col-md-4 col-lg-3 box">
           <i class="fa fa-user fa-3x d-flex" style="float:left"></i>
           <div class="">
              {{$stat->sValue}}
           </div>
           <small>  {{$stat->sName}}    </small>
         </div>

         @endforeach
         @endif
       </div>
     </div>
    </div>

@endsection
