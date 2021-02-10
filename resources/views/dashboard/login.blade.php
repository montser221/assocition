<!DOCTYPE html>
<html>
 <head>
  <title>لوحة التحكم</title>
  <link rel="stylesheet" href="{{url('css/bootstrap-rtl.min.css')}}">
  <link rel="stylesheet" href="{{ url('css/font-awesome.css') }}" >
  {{-- <link rel="stylesheet" href="{{ url('css/style.css') }}" > --}}
  <style type="text/css">
   .box{
       width: 401px;
       margin: 50 auto;
       margin-top: 4%;
       padding: 35px;
       border-radius: 10px;
       box-shadow: 0px 0px 12px -6px;
   }
  </style>
 </head>
 <body>
  <br />
  <div class="container box">
    {{-- <i class="fa fa-user fa-2x"></i>  --}}
   <h3 align="center" style="color:#9ca2a9;"> تسجيل الدخول  </h3><br />

   @if(isset(Auth::user()->email) )
    <script>
        // var elem = document.createElement('div');
        // var text = document.createTextNode("You Will Redirect After " + 3 +" seconds");
        // elem.appendChild(text);
        // elem.addClass('alert alert-success ');
        // body.appendChild(elem);
    </script>
    {{-- <script>window.location="/project/public/admin";</script> --}}
    @endif

   @if ($message = Session::get('error'))
   <div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
   </div>
   @endif

   @if (count($errors) > 0)
    <div >
     <ul class="list-unstyled">
     @foreach($errors->all() as $error)
      <li class="alert alert-danger"> {{ $error }}</li>
     @endforeach
     </ul>
    </div>
   @endif

   <form method="post" action="{{ route('checklogin') }}">
    {{ csrf_field() }}
    <div class="form-group">
     <label> البريد الالكتروني  </label>
     <input type="email" name="email" class="form-control" autofocus="autofocus" /> <i class="fa fa-email"></i>
    </div>
    <div class="form-group">
     <label> كلمة المرور  </label>
     <input type="password" name="password" class="form-control" />
    </div>
    <div class="form-group">
     <input type="submit" name="login" class="btn btn-primary" value="دخــــــــــول" />
    </div>
   </form>
  </div>
  <script src="{{url('js/jquery.min.js')}}"></script>
  <script src="{{url('js/popper.min.js')}}"></script>

  <script src="{{url("js/bootstrap.bundle.min.js")}}"></script>
  <script src="{{url("js/main.js")}}"></script>
  <!-- <script src="{{url("js/jquery.animateNumber.min.js") }}"></script> -->
 </body>
</html>
