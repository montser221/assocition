<?php
$data = \App\Models\Settings::find(1);
 ?>
<!-- Start Footer  -->
<div class="footer">
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        <p class="about">
            {{ $data->foundationName ?? ' ' }}    
            نص يمكن ان يستبدل باي نص 
        </p>
        <div class="social">
          <div class="h6"> تابعنا عبر وسائل التواصل الاجتماعي:</div>
          <a href="#"><img src="{{url('design/facebook.png')}}"></a>
          <a href="#"><img src="{{url('design/twitter.png')}}"></a>
          <a href="#"><img src="{{url('design/instagram.png')}}"></a>
          <a href="#"><img src="{{url('design/linkedin.png')}}"></a>
          
        </div>
      </div>
      <div class="col-sm-3">
        <div class="contact-info fix-footer"> معلومات التواصل</div>
        <ul class="list-unstyled">

          <li ><a href="tel:+055 283-1282" dir="ltr">الهاتف:  {{$data->phoneNumber ?? ''}}</a></li>
          <li class="d-block">العنوان: {{$data->foundationTitle ?? ''}}  </li>
        </ul>
        <div class="pay-by">
          <div class="h6"> نقبل الدفع بواسطة</div>
          <a href="#" data-toggle="tooltip"  offset="2" data-placement="bottom" title="Amazon" ><i class="fa fa-amazon fa-lg"></i></a>
          <a href="#" data-toggle="tooltip"  offset="2" data-placement="bottom" title="Visa"><i class="fa fa-cc-visa fa-lg" aria-hidden="true"></i></a>
          <a href="#" data-toggle="tooltip"  offset="2" data-placement="bottom" title="Paypal"><i class="fa fa-cc-paypal fa-lg"></i></a>
          <a href="#" data-toggle="tooltip"  offset="2" data-placement="bottom" title="Creditcard"><i class="fa fa-credit-card fa-lg" aria-hidden="true"></i></i></a>
          <a href="#" data-toggle="tooltip"  offset="2" data-placement="bottom" title="Mastercard"> <i class="fa fa-cc-mastercard fa-lg" aria-hidden="true"></i></a>
        </div>
        </div>
        <div class="col-sm-3">
          <div class="d-flex fix-footer menu-phone">القائمة </div>
          <ul class="list-unstyled">
            <li>
              <a href="{{url('aboutus')}}">من نحن</a>
            </li>
            <li>
              <a href="{{url('ourproject')}}">مبادراتنا</a>
            </li>
            <li>
              <a href="{{url('paymethod')}}" >طرق التبرع</a>
            </li>
            <li>
              <a href="{{url('jobs')}}">وظائف</a>
            </li>
            <li>
              <a href="{{url('contact')}}" > الاتصال بالجمعية  </a>
            </li>
          </ul>
        </div>

        <div class="col-sm-3">
					<div class="d-flex fix-footer menu-phone">مركز المساعدة </div>
					<ul class="list-unstyled">
            <li>
              <a href="#">شروط وسياسة التبرع</a>
            </li>
            <li>
              <!--<a href="#" >ارجاع واسترداد المنتجات  </a>-->
            </li>
            <li>
              <a href="#">سياسة الخصوصية</a>
            </li>
            <li>
              <a href="#" >  الدليل الارشادي</a>
            </li>
          </ul>
        </div>
    </div>
    <hr style="border-bottom:2px solid #DDD"/>
    <div class="copyright">
      <div class="footer-left">
          جميع الحقوق محفوظة لدى  {{ $data->foundationName ?? ' ' }}             
       </div>
      <div class="footer-right">
        {{date('Y')}}
      </div>
    </div>
  </div>
</div>

<!-- End Footer  -->
