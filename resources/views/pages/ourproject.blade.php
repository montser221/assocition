@extends('layouts.app')

@section('title','مبادراتنا')

@section('header')
    @include('includes.header')
@stop

@section('content')

{{-- Start Our Projects --}}

<div class="our-projects mt-5">

  <div class="container">

<?php $show = 0 ?>

@foreach ($allprojects as $project)

  @if ($project->projectStatus==1)

    <?php $show = 1 ?>

  @endif

@endforeach

<style type="text/css">
.our-projects .all-projects 
{

    padding-bottom: 10px;
    padding-bottom: 30px;
    box-shadow: 0px 0px 1px 0px;
    background-color: #FFF;
    box-shadow: #a7a7a766 0px 5px 20px 0px;
    border-radius: 10px;
    margin-top: 5px;
    margin-bottom: 15px;
    margin-left: 15px;
    padding-top: 11px;
    max-width: 30% !important;
}  

 
.our-projects .all-projects img 
{
      max-width: 100%;
} 

.our-projects   .denoate-now
{
  margin-top: 50px;
}
.our-projects   .btn-denoate
{
    background-color: #BAA342;
    color: #FFF;
    padding: 6px;
    font-size: 13px;
    border-radius: 6px;
    padding-left: 12px;
    padding-right: 15px;
}
.our-projects   .to-basket 
{
    border: none;
    padding: 12px;
    background-color: #BAA342;
    color: #FFF;
     padding: 8px; 
    font-size: 13px;
    border-radius: 6px;
}
.our-projects   .input-denoate 
{
  padding-bottom: 5px !important;
    border-radius: 5px;
    text-align: center;
    /* padding: 4px !important; */
    padding-top: 10px !important;
    /* max-width: 91px; */
    font-size: 8px !important;
    border: 0px solid #DDDDDC;
    padding-bottom: 10px !important;
    box-shadow: #9b9b9b8f 0px 9px 9px -5px;
    border: 1px solid #ececec;
}

.our-projects .project-buttons button
{
    margin-right:8%;
      margin-top: 2px;
   border-radius: 30px !important;
    color: #2fa89c;
    background-color: #E6E6E6;
    margin-bottom: 10px;
    padding: 7px;
    min-width: 256px;
    border: 1px solid #786E42 !important;
}

@media (max-width:576px)
 {
 
.our-projects .all-projects {
    max-width: 95% !important;
    margin-right: 10px !important;
  }

}


@media(min-width: 768px) and (max-width: 991px)

{
  .our-projects .project-buttons button 
  {
      margin-top: 2px;
      border-radius: 30px !important;
      color: #2fa89c;
      background-color: #E6E6E6;
      margin-bottom: 10px;
      padding: 6px;
      min-width: 186px;
      border: 1px solid #2fa89c;
      font-size: 12px;
  }

  .our-projects .input-denoate {
    width: 83px
  }
.our-projects .btn-denoate
{
      padding-left: 7px;
    padding-right: 8px;
}

}


</style>

@if ($show)

    <div class="h2 text-center">من مبادراتنا</div>
 <div class="text-center mt-1 mb-4 line-design"></div>
    <div class="text-center p-fix">مجموعة المبادرات التطوعية التي قامت بها المؤسسة</div>

  {{--   <div class="p-buttons">

      <button class="btn btn-light btn-urgent">المبادرات العاجلة</button>

      <button class="btn btn-light">أخترنا لكم </button>

      <button class="btn btn-light"> آخر المبادرات  </button>

    </div> --}}

  @endif

 

      <div class="row">
  
        @foreach ($allprojects as $project)

  

        <div class="all-projects col-md-4 col-sm-6">

          <a href="{{route('projectDetail',$project->projectId)}}">
          <img style=" "  src="{{ url("storage/".$project->projectImage) }}" class="" alt="1" />

          <span class="d-block text-center main-color mt-3 mb-3">{{$project->projectName ?? ''}}</span>
        </a>

         <p style="font-size:15px;    max-height: 50px; overflow: hidden;">

          {{$project->projectText ?? ''}}

          </p>

          <hr>

          <div class="text-center  mb-3 mt-3  ">

            تكلفة المبادرة

          </div>

          <div class="btn  btn-lg d-block button-custom btn-active " style="direction: ltr;">

 
            </strong> {{number_format($project->projectCost,0) ?? 0}} </strong>  <strong> SAR</strong> 

     
          </div>



          <span   class="d-total-text mt-3"  >إجمالي التبرعات</span>

                <div class="denoate-total">
             <strong style="display: inline-block">SAR</strong>
             <strong>
            <?php
            $getAllDenoate = \DB::table('denoate_pay_details')
                                ->where('projectTable',$project->projectId)
                                ->sum('moneyValue');
                                // ->get();
            //echo( number_format($getAllDenoate,0));
            ?>
           @if($getAllDenoate >= $project->projectCost ) {{number_format( $project->projectCost ,0)}} @else  {{ number_format( $getAllDenoate ,0)}} @endif

            </strong>
          </div>

         <div class="remain mb-2"  >
            <span style="font-size: 12px; margin-left: 10px;">باقي للتبرع:</span>
             <small style="margin-left: 5px"> SAR</small>
              <small style="margin-left: 5px">  @if($getAllDenoate >= $project->projectCost ) 0 @else {{ $project->projectCost - $getAllDenoate }} @endif </small>
              {{-- <small style="margin-left: 5px"> {{ $project->projectCost - $getAllDenoate }}  </small> --}}
          </div>


         
           <div class="progress mb-5"  data-toggle="tooltip"  offset="2" data-placement="top" title="@if($getAllDenoate >= $project->projectCost ) {{  $project->projectCost }} @else  {{ number_format( $getAllDenoate ,0)}} @endif SAR ">
                    <div class="progress-bar" role="progressbar"

                 style="@if($getAllDenoate > 0)  background-color:#BAA342 !important; @else  background-color:#e9ecef;width:15% !important;  @endif @if($getAllDenoate >= $project->projectCost ) width:100%;  @else  width: {{  round($getAllDenoate / $project->projectCost * 100)  }}%; @endif" aria-valuenow="25"
                 aria-valuemin="0" aria-valuemax="100"
                > @if($getAllDenoate >= $project->projectCost ) 100% @else
                <small     style="color:#32353c;  font-size: 15px;position: absolute;right: 50%;">
                
                 {{  round($getAllDenoate / $project->projectCost * 100) }}% @endif</div>
                </small>
          </div>
          <div class="project-buttons" id="our-projects-buttons">
            <small class="d-block text-gray mb-2 mt-4"> أختيار مبلغ التبرع </small>
            <?php 
                $arr = \App\Models\Arrow::all()->where('projectTable',$project->projectId)->where('arrowStatus',1);

                $count_arr = $arr->count();
              
                ?>
                @if($count_arr <= 0)

                @else
                 <?php
                  foreach($arr as $a)
     
                  {?>
              <button    class="c-b btn-active">
                  {{ $a->arrowName }} / {{ $a->arrowValue }} ريال
                <input class="ourArrVal" type="hidden"  value="{{ $a->arrowValue }}" />
              </button> 
             <?php
              }
              ?>
              
            @endif
           
          </div>


          <form class="our-projects-form" action="{{route('addToCart',$project->projectId)}}" method="post">

          <div class="denoate-now">

              @csrf

              @method('post')

              <input required="required" type="number" id="_input_denoate" name="denoate"  class="input-denoate ourprojectnowvalue" placeholder="ضع قيمة التبرع هنا">


            <button  id="add-to-basket" type="submit" style="border:none;padding:10px" class="to-basket" data-toggle="tooltip"  data-placement="bottom" title="إضافة الى السلة">  <i class="fa fa-shopping-basket"></i> </button>

            </form>

   <form class="d-inline-flex dnow-form" action="{{route('addToCartNow',$project->projectId)}}" method="post">
          @csrf
          @method('post')
          <input type="hidden"  name="dnow"  class="dnow" value="" >

          <button  style="padding:10px;border:0" class="btn-denoate oprojecstnow" 
          type="submit">تبرع الآن </button>
        </form>

          </div>

        </div>

      @endforeach

    </div>
 
 {{$allprojects->links()}}

  </div> <!--End container -->

</div>

 

{{-- End Our Projects --}}
 

@stop

@section('footer')
 

  @include('includes.footer')

@stop

