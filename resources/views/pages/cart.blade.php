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


           <!--Bill Details-->
            <div id="bill-details">
               <p>تفاصيل الفاتورة</p>
               <hr>
               <p class="d-inline-block ml-4" id="payment-method">طريقة الدفع:</p>
               <div class="form-check form-check-inline">
                   <input class="form-check-input" type="radio" name="pay-opt" id="pay-opt1" value="credit-card">
                   <label class="form-check-label" for="pay-opt1">بطاقة ائتمانية</label>
               </div>
               <div class="form-check form-check-inline">
                   <input class="form-check-input" type="radio" name="pay-opt" id="pay-opt2" value="payment-account">
                   <label class="form-check-label" for="pay-opt2">حساب سداد</label>
               </div>
           </div>

           <form  method="post" id="card-form" class="" action="https://api.moyasar.com/v1/payments.html">
             @csrf
             @method('post')
              {{-- <input type="hidden" name="publishable_api_key" value="sk_test_AXmiaohnBADcySyDJjPsChNwbiGPaAYZmgg2Vdnf">
              --}}
            <input type="hidden" name="publishable_api_key" value="sk_live_qXRKzZaXCSnnRZXr9TnNYbr5jm2ZcdyUYSbQJZHy">
             <input type="hidden" name="amount" class="amount"  />
             <input type="hidden" name="source[type]" value="creditcard" />
             <input type="hidden" name="callback_url" value="{{url('payments')}}" />


             <div class="form-row mb-3 mt-2">
               <div class="col-md-6 mb-2">
                 <input class="form-control " required type="text" name="source[name]" placeholder="الإسم على البطاقة">
               </div>
               <div class="col-md-6 mb-2">
                  <input class="form-control " required type="number" name="source[number]" placeholder="رقم البطاقة">
               </div>
            </div>
            <div class="form-row">
              <div class="col-md-6">
                  <div class="row mb-2">
                      <Select  name="source[month]" class="form-control col-5 p-0 mr-3"    >
                      <option   selected > الشهر</option>
                      @for ($i=1 ; $i <= 12; $i++)
                      <option value="@if($i <= 9){{ 0 }}@endif{{$i}}"> {{ $i }}</option>
                      @endfor
                    </Select>
                     <Select name="source[year]" class="form-control col-5 p-0 mr-4"    >
                      <option   selected > السنة</option>
                      @for ($i=2021 ; $i <= 2031; $i++)
                      <option value="{{$i}}"> {{ $i }}</option>
                      @endfor
                    </Select>
                    <!--<input class="form-control col-5" required type="text" name="source[month]" placeholder="MM" style="margin-right: 20px;margin-bottom: 10px;">-->
                    <!--<input class="form-control col-5" required type="text" name="source[year]" placeholder="YY" style="margin-right: 20px;margin-bottom: 10px;">-->
                  </div>
              </div>
               <div class="col-md-6">
                 <input class="form-control " required type="password" name="source[cvc]" placeholder="الرمز السري">
               </div>
             </div>
             <button class="btn  btn-main-color back-main position-fix cart-p-fix   mx-auto" type="submit">تبرع الآن</button>
           </form>

           <form  id="sdad-form" class="hide" method="post" action="https://api.moyasar.com/v1/payments.html">
             @csrf
             @method('post')
             {{-- <input type="hidden" name="publishable_api_key" value="sk_test_AXmiaohnBADcySyDJjPsChNwbiGPaAYZmgg2Vdnf">
             --}}
             <input type="hidden" name="publishable_api_key" value="sk_live_qXRKzZaXCSnnRZXr9TnNYbr5jm2ZcdyUYSbQJZHy">
             <input type="hidden" name="amount" class="amount"  />
             <input type="hidden" name="callback_url" value="{{url('payments')}}" />
             <input type="hidden" name="source[type]" value="sadad" />

             <input type="text" class="form-control mt-3" name="source[username]" placeholder="الاسم على سداد">
                <button class="btn btn-main-color  back-main position-fix cart-p-fix   mx-auto" type="submit">تبرع الآن</button>
           </form>
           </div>
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
