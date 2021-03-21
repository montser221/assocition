@extends('layouts.app')

@section('title','سلة التبرعات')

@include('includes.header')
<!--Banner-->
<div class="cart">
  <div class="container-fluid px-0 banner" id="basket-banner">
             <div class="container">
                 <div class="page-path">
                     <p><a href="{{route('home')}}"> الرئيسية </a>/ السلة </p>
                 </div>
             </div>
         </div>


         <!--//Banner-->
{{-- {{dd(session()->get('cart'))}} --}}

         <!--Content-->

         <div class="content  ">
          <div class="text-center">
            <img class="visa" src="{{url('design/visa.png')}}">
            <img class="mada" src="{{url('design/mada.jpg')}}">
            <img class="master" src="{{url('design/master.png')}}">
          </div>
           <div class="container cart-fix" id="basket-container">
           <h3 class="text-center mt-5">سلة التبرعات</h3>
            <div class="text-center mt-1 mb-4 line-design"></div>
           {{-- <div class="text-center mt-3 mb-4"><img src="{{url('design/shape.png')}}"></div> --}}

           <div class="container order-fix mt-3" id="inner-container">

            @if (\Session::has('error'))
            <div class="alert alert-danger error">
                <ul>
                    <li>
                        {!! \Session::get('error') !!}
                        </li>
                </ul>
            </div>
        @endif
   
        @if (\Session::has('success'))
         <div class="alert alert-success success">
             <ul>
                 <li>
                     {!! \Session::get('success') !!}
                     </li>
             </ul>
         </div>
         @endif

                @if (\Session::has('cart'))
                  <table class="table">
                    <thead>
                      
                      <th> المشروع</th>
                      <th> القيمة </th>
                      <th> حذف</th>
                    </thead>
                    <hr>
                    <tbody>
                      <?php
                      $count = 0;
                      $total = 0;
                      $i = 0;
                      ?>
                  @foreach (\Session::get('cart') as $cart)
                    <?php   $count++; ?>
                    @if(is_array($cart))
                      @foreach ($cart as $c)
                        <tr>
                         
                          <td style="font-size: 14px;">   {{ ($c['projectName'])  }}  </td>

                            <td> <form class=""  method="post" action="#test">
                              <?php

                              if(!intval($c['den'])) 
                              {
                                  $c['den'] = 0;
                              }
                              else 
                              {
                                  for ($i=0; $i  < $count; $i++) {
                                  $total += $c['den'];
                                  }
                              }

                              ?>
                              <div class="prices">
                              <input type="number"  name="vals[]" value="{{($c['den'])}}"   class="form-control cartinput w-55" >
                              </div>
                            </form>
                            </td>

                          <td>

                            <form class="_cart_form" action="{{ route('cart.destory',$c['projectId']) }}" method="post">
                            <div class="trash" >
                                @csrf
                                @method('delete')
                                <button type="submit"  class="del" style="    display: contents;color:#959393">
                                  <i class="fa fa-trash" aria-hidden="true"  ></i>
                                </button>
                              </form>
                            </div>
                          </td>
                  
                        </tr>
                      @endforeach
                    @endif
                  @endforeach
                @else
                  <div class="container">
                    عفواً لم تضف عناصر للسلة
                  </div>
                @endif
               </tbody>
             </table>
             @if(session()->has('cart'))
             @foreach (\Session::get('cart') as $cart)
               {{-- {{dd(\Session::get('cart'))}} --}}
               @if(is_array($cart))
               @endif
             @endforeach
             @endif

          <?php
          // if ($_REQUEST['inputVals'])
          // {
            // $vals = $_POS  T['inputVals'];
            // var_dump($vals);
            // var_dump(file_get_contents('php://input'));
          // }
           ?>
             <div class="col col-md-6 offset-md-6 text-gray mt-5 ">
            
               إجمالي التبرع
               <span class="main-color mr-130"> <span class="total"> {{$total ?? 0}} </span> ر.س </span>
               <hr>
             </div>


           <div class="proced-denoate lead text-center">
            <h3>يمكنك إكمال التبرع بالتحويل في حساب  المنظمة بمصرف الانماء</h3>
            <img src="{{ url('design/bankaccount.jpg') }}" alt="">
          </div>
        
       </div>
     </div>
</div>
 <script src="{{url('js/jquery.min.js')}}"></script>
{{-- @include('includes.ourlocation') --}}
@include('includes.footer')
<script>
$('.cartinput').change(function () {
    var sum = 0;
    $('.cartinput').each(function() {
        sum += Number($(this).val());
    });
    $('.total').text(sum);
     $('.amount').val(parseFloat($('.total').text())*100)
});
$('.amount').val(parseFloat($('.total').text())*100)
</script>
