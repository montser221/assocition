@extends('layouts.app')

@section('title', "مشروع خاص")
{{-- include header --}}
@include('includes.header')
{{-- include contact page --}}
 
<!-- Start Contact Us -->
<div class=" project-detail">

    <div class="content mt-2">
      <div class="container zakat-fix">
      <div class="row">
      @foreach ($customProject as $custom)
        <div class="col-sm-12">
          <div class="h2 text-center mt-5 main-color">   @if ($custom)   {{$custom->projectName ?? ''}} @endif  </div>
           <div class="text-center center-phone  mb-2"><img src="{{url('design/shape.png')}}"></div>
          
        </div>
        <div class="col-sm-12 mt-5">
          <div class="row">
            <div class="col-md-8 offset-md-2 p-detail">
            
            @if ($custom) 
              <img  style="min-height:350px;border-radius:5px"
               src="{{ url("storage/".$custom->projectImage)}}" class="d-block w-100 fix-ph" alt="">
               <div class="p-name">
                  {{$custom->projectName}}
               </div>
               <p class="p-text">
                        {{$custom->projectText}}
                </p>
              @endif
                <hr>
                <div class="p-down">
                  <div class="p-cost mb-5">
                    <strong class="text-gray"  style="/*margin-left:2rem"  class="d-inline-block">تكلفة المشروع</strong>
                    <button   class="d-inline-block btn btn-active btn-total-cost"  type="button" name="button">  {{$custom->projectCost}} SAR</button>
                  </div>
                  <?php
                  $getAllDenoate = \DB::table('denoate_pay_details')
                                      ->where('projectTable',$custom->projectId)
                                      ->sum('moneyValue');
                                      // ->get();
                    
                  ?>
                  <div class="p-total mb-5">
                    <strong  class="text-gray" style="margin-left:2rem;color:#786e42 !important"  class="d-inline-block"> إجمالي التبرعات  </strong>
                    <span class="main-color" style="font-weight:bold;color:#786e42 !important">  SAR {{ number_format($getAllDenoate,0)}}</span>
                  </div>
                  <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ar_AR/sdk.js#xfbml=1&version=v9.0" nonce="rcB6zvfw"></script>

                  <style type="text/css">
                    .buttons-share a {
                        padding: 11px;
                      }
                       .detail-error {
                     border:1px solid #ff2424 !important 
                     }
                     .detail-success {
                       border:1px solid green !important;
                     }
                       .buttons-share a .fa-facebook {color: #0065bb}
                       .buttons-share a .fa-twitter {color: #3da1f7}
                       .buttons-share a .fa-telegram {color: #509bdc}
                       .buttons-share a .fa-whatsapp {color: #080}
                       @media (max-width:576px){
                        .buttons-share a {padding:0px;}
                         .fa-3x { font-size: 1.8em;}
                       }
                  </style>
                  <div class="buttons-share mb-5 d-flext">
                    {{-- <a href="#">
                      <i class="fa fa-facebook fa-3x"></i>
                    </a>        --}}
                    <a  data-toggle="tooltip"  offset="2" data-placement="top" title="مشاركة" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{route("projectDetail",$custom->projectId)}}&quote=مشروع :- {{$custom->projectText}}" class="fb-xfbml-parse-ignore"
                    >
                        <!--<i class="fa fa-facebook fa-3x"></i> -->
                        <img style="width: 38px;" src="{{url('design/icons/facebook.png')}}" />
                    </a>
                    <a data-toggle="tooltip"  offset="2" data-placement="top" title="مشاركة" target="_blank" href="https://twitter.com/intent/tweet?url={{route('projectDetail',$custom->projectId)}}&text=مشروع :- {{$custom->projectText }}">
                    <!--<i class="fa fa-twitter fa-3x twitter-share-button"></i>-->
                    <img style="width: 38px;" src="{{url('design/icons/twitter.png')}}" />
                    </a>                   
                    <a data-toggle="tooltip"  offset="2" data-placement="top" title="مشاركة" target="_blank" href="https://t.me/share/url?url={{route("projectDetail",$custom->projectId)}}&text={{$custom->projectText }}">
                      <!--<i class="fa fa-telegram fa-3x"></i>-->
                      <img style="width: 38px;" src="{{url('design/icons/telegram.png')}}" />
                    </a>                    
                    <a data-toggle="tooltip"  offset="2" data-placement="top" title="مشاركة" target="_blank" href="https://api.whatsapp.com/send?text={{route("projectDetail",$custom->projectId)}} مشروع :- {{$custom->projectText }} " data-action="share/whatsapp/share">
                      <!--<i class="fa fa-whatsapp fa-3x"></i>-->
                        <img style="width: 38px;" src="{{url('design/icons/whatsapp.png')}}" />
                    </a>
                  </div>
                  <div class="progress mb-5" data-toggle="tooltip"  offset="2" data-placement="bottom" title="{{ number_format( $getAllDenoate ,0)}} ">

                    <div class="progress-bar" role="progressbar"

                         style="width: {{round($getAllDenoate / $custom->projectCost * 100)}}%;    background-color: #89c64f; " aria-valuenow="25"

                         aria-valuemin="0" aria-valuemax="100"

                          >

                          {{ round($getAllDenoate / $custom->projectCost * 100)}}%</div>

                  </div>

                  <div class="p-buttons">
                          
                          <div class="arrows  ">
                            <?php
                          foreach($custom->arrow as $a)
                          {?>
                            
                          <div class="arrow">
         
                            @csrf
                            @method('post')
                            <button  type="submit" class="custom-input custom-project-detail">
                                {{ $a->arrowName }} / {{ $a->arrowValue }} ريال
                              <input class="arrVal" type="hidden"  value="{{ $a->arrowValue }}" />
                            </button> 
                            </div>
                        <?php
                        }
                      ?>
                        </div>
                      
                    <form class="d-inline customDetailForm" action="{{ route('addToCart',$custom->projectId) }}" method="post">
                      <input  
                     class="custom-input text-center input_denoate custom-project_denoate customprojectdetailvalue @if($errors->has('dnow') || $errors->has('denoate') ) detail-error  @endif"  
            
                     type="number" 
                     name="denoate" 
                     placeholder="آخرى"
                     />
                    
                      @csrf
                      @method('post')
                      <input type="hidden"  value="true" name="customproject"/>
                      <button  id="add-to-basket-detail"  type="submit"
                      style="border:none;padding:10px" class="bs btn-basket"
                      data-toggle="tooltip"  data-placement="bottom" title="إضافة الى السلة">
                          <i class="fa fa-shopping-basket"></i>
                         </button>
                    </form>
                  </div>
     
                </div>
                <form class="d-inline-flex dnow-form" action="{{route('addToCartNow',$custom->projectId)}}" method="post">
                  @csrf
                  @method('post')
                  <input type="hidden"  name="dnow"  class="dnow" value="">

                  <button id="btn-basket" style="border:0" class="btn-denoate customProjectdetail" 
                  type="submit">تبرع الآن </button>
                </form>
                <!--<div class="basket">-->
                <!--    <a id="btn-basket" class="btn back-main " href="{{route('cart')}}">تبرع الآن</a>-->
                <!--</div>-->

            </div>
          </div>
        </div>
        @endforeach
      </div>

    </div>
  </div>
  @if (!empty($custom->whatsapp))
  <div class="whatsapp-icon">
    <a target="_blank" href="https://wa.me/{{$custom->whatsapp}}&text">
      <!--<i class="fa fa-whatsapp fa-3x"> </i>-->
       <img style="width: 50px;" src="{{url('design/icons/whatsapp.png')}}" />
    </a>
  </div>
@endif


</div>
<!-- End Contact Us -->
{{-- @include('includes.ourlocation') --}}

{{-- include footer --}}
@include('includes.footer')
