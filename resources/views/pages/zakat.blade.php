@extends('layouts.app')
@section('title', __('messages.zakat') )
{{-- include header --}}
@include('includes.header')
{{-- include contact page --}}

<!-- Start Contact Us -->
<div class="zakat">
  <div class=" px-0 banner" id="basket-banner">
    <div class="z-inner">
     <div class="container">
       <div class="page-path">
           <p><a href="{{route('home')}}"> الرئيسية / </a> {{__('messages.zakat') }}   </p>
           <div class="h2" style="padding-bottom: 100px !important;">
            {{ __('messages.zakat') }}
           </div>
       </div>
     </div>
   </div>
   </div>
   <!--//Banner-->
    <div class="content">
      <div class="container zakat-fix">
      <div class="row">
        <div class="col-sm-12 ">
          <div class="h2 text-center main-color"> احسب زكاتك الآن! </div>
         <div class="text-center mt-1 mb-4 line-design"></div>          <div class="text-center text-gray mb-5">
          الآن يمكنك دفع الزكاة الخاصة بك عن طريق موقع جمعية
          </div>
        </div>

        <div class="col-sm-12 ">
          <form class="form-contact" action="{{route('addToCart',28)}}" method="post">
            @csrf
            @method('post')
            <input type="hidden" name="zakat" value="true"/>
            <div class="mx-auto w-100">
              <div class="text-center mb-3 z-title-fix" style="">
                المبلغ ر.س

              </div>

              <input id="zkat" class="form-control w-70 mb-5" type="text" placeholder="المبلغ الذي تريد حسابه" >
              <div class="total text-center mb-5">
                <input type="hidden" name="denoate" id="_zkatResult">
                إجمالي زكاتك <span id="zkatResult">0 <span class="">SAR</span></span>
              </div>
            </div>
            <button  type="submit"  id="add-to-basket-zakat" type="submit" style="border:none" class="btn-basket zakat-basket" data-toggle="tooltip"  data-placement="bottom" title="إضافة الى السلة">
                <i class="fa fa-shopping-basket"></i>
               </button>
            <a class="btn zakat-btn btn-lg btn-fix" href="{{route('cart')}}">     أخرج زكاتك</a>
          </form>
        </div> 
      </div>
    </div>
  </div>
</div>
<!-- End Contact Us -->
{{-- @include('includes.ourlocation') --}}
{{-- include footer --}}
@include('includes.footer')
