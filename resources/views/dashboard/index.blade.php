@extends('layouts.app')
@section('title','لوحة التحكم')
@section('content')
{{-- Start Dashboard --}}
<div class="dashboard">
  <div class="container-fluid">
    <div class="row">
      {{-- start dashboard to --}}
      <div class="col-sm-12 dashboard-top">
        <div class="row ">
          <div class="col-sm-3">
            <img src="{{url('design/dashboard-back.png')}}" class="dashboard-logo" alt="">
          </div>
          <div class="col-sm-6">
            <form class="form-inline" action="#" method="post">
              <input class="form-control" type="text" name="search" value="" placeholder="أبحث عن شيئ">
            </form>
          </div>
          <div class="col-sm-3 user-details">
            {{-- <span class="fa fa-bell fa-lg"></span> --}}
            {{-- <span class="fa fa-comment-o fa-lg"></span> --}}
            <img style="border-radius: 50%;"  class="image-rounded" src=" @if(!empty(Auth::user()->profileImage) ) {{url("uploads/profile/".Auth::user()->profileImage)}} @else {{url('design/avatar-04.jpg')}} @endif" alt="">
            <div class="dropdown">
              <button class="dropdown-toggle" type="" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="d-block mt-2">مرحبا بك</span>
                {{Auth::user()->fullName ?? ''}}
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                {{-- <a class="dropdown-item" href="#">الملف الشخصي</a> --}}
                {{-- <a class="dropdown-item" href="#">  الاعدادات</a> --}}
                <a class="dropdown-item" href="{{route('logout')}}"> تسجيل الخروج </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{--end dashboard top --}}

      {{--start sidebar --}}
      <div class="col-sm-3" style="background-color: #FFF;">
        <div class="list-group" >
          <a class="list-group-item active" href="{{route('statistics.index')}}"><i class="fa fa-home fa-fw" aria-hidden="true"></i>&nbsp; لوحة التحكم</a>
          <a class="list-group-item  " href="{{route('settings.index')}}"><i class="fa fa-cog fa-fw" aria-hidden="true"></i>&nbsp; الاعدادات  </a>
          <a class="list-group-item  " href="{{route('stat')}}"><i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp;  إدارة الاحصائيات  </a>
          <a class="list-group-item  " href="{{route('policies.index')}}"><i class="fa fa-home fa-fw" aria-hidden="true"></i>&nbsp;  إدارة السياسات العامة  </a>
          <a class="list-group-item" href="{{route('users.index')}}"><i class="fa fa-user " aria-hidden="true"></i>&nbsp; إدارة المستخدمين</a>
          <a class="list-group-item" href="{{route('userscategories.index')}}"> <i class="fa fa-user-o fa-fw" aria-hidden="true"></i>&nbsp; مجموعات المستخدمين  </a>
          <a class="list-group-item" href="{{route('members.index')}}"> <i class="fa fa-users fa-fw" aria-hidden="true"></i>&nbsp;  أعضاء مجلس الإدارة    </a>
          <a class="list-group-item" href="{{route('agents.index')}}"><i class="fa fa-user fa-fw" aria-hidden="true"></i>&nbsp;     شركائنا  </a>
          <a class="list-group-item" href="{{route('money.index')}}"><i class="fa fa-dollar fa-fw" aria-hidden="true"></i>&nbsp;  التقارير المالية  </a>
          <a class="list-group-item" href="{{route('denoate.index')}}"><i class="fa fa-dollar fa-fw" aria-hidden="true"></i>&nbsp; تفاصيل الدفع  الفواتير</a>
          <a class="list-group-item" href="{{route('courses.index')}}"><i class="fa fa-desktop" aria-hidden="true"></i>&nbsp;إدارة الدورات التدريبية</a>
          <a class="list-group-item" href="{{route('subscriber')}}"><i class="fa fa-desktop" aria-hidden="true"></i>&nbsp; المشتركين في الدورات التدريبية</a>
          <a class="list-group-item" href="{{route('projects.index')}}"><i class="fa fa-desktop" aria-hidden="true"></i>&nbsp;إدارة المشاريع</a>
          <a class="list-group-item" href="{{route('arrows.index')}}"><i class="fa fa-arrows" aria-hidden="true"></i>&nbsp;إدارة الأسهم</a>
          {{-- <a class="list-group-item" href="{{route('projectcategories.index')}}"> <i class="fa fa-desktop" aria-hidden="true"></i>&nbsp; إدارة فئات المشاريع  </a> --}}
          <a class="list-group-item" href="{{route('paymentmethod.index')}}"><i class="fa fa-credit-card" aria-hidden="true"></i>&nbsp;إدارة طرق الدفع</a>
          <a class="list-group-item" href="{{route('images.index')}}"><i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp; إدارة   البوم الصور      </a>
          <a class="list-group-item" href="{{route('sliderimages.index')}}"><i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp; إدارة    أسلايدر الصور </a>
          <a class="list-group-item" href="{{route('videos.index')}}"><i class="fa fa-film" aria-hidden="true"></i>&nbsp; إدارة  الفيديوهات </a>
          <a class="list-group-item" href="{{route('files.index')}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp; إدارة ملفات    دليل الحوكمة </a>
          <a class="list-group-item" href="{{route('reportfiles.index')}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp; إدارة ملفات  التقارير المالية   </a>
          {{-- <a class="list-group-item" href="#"><i class="fa fa-cog fa-fw" aria-hidden="true"></i>&nbsp; إدارة  محتويات الموقع    </a> --}}
          <a class="list-group-item" href="{{route('aboutassoiation.index')}}"><i class="fa fa-info" aria-hidden="true"></i>&nbsp;  إدارة معلومات حول الجمعية </a>
          <a class="list-group-item" href="{{route('otherfiles.index')}}"><i class="fa fa-info" aria-hidden="true"></i>&nbsp;       أدارة الاعضاء الاخرين   </a>
          <a class="list-group-item" href="{{route('attendace.index')}}"><i class="fa fa-calendar fa-lg" aria-hidden="true"></i>&nbsp;  إدارة أوقات الدوام</a>
          <a class="list-group-item" href="{{route('goals.index')}}"><i class="fa fa-time fa-fw" aria-hidden="true"></i>&nbsp;  إدارة أهداف الجمعية</a>

          <a class="list-group-item" href="{{route('services.index')}}"><i class="fa fa-cog fa-fw" aria-hidden="true"></i>&nbsp;  إدارة  الخدمات     </a>

          {{-- <a class="list-group-item" href="{{route('payees.index')}}"><i class="fa fa-group fa-fw" aria-hidden="true"></i>&nbsp; إدارة   المستفيدين       </a> --}}

          <a class="list-group-item" href="{{route('needy')}}"><i class="fa fa-group fa-fw" aria-hidden="true"></i>&nbsp;   المحتاجين المتقدمين   </a>
          <a class="list-group-item" href="{{route('applicable')}}"><i class="fa fa-group fa-fw" aria-hidden="true"></i>&nbsp;  طلبات العضوية المتقدمين   </a>
          <a class="list-group-item" href="{{route('volnt')}}"><i class="fa fa-group fa-fw" aria-hidden="true"></i>&nbsp;  ال,متطوعين المتقدمين   </a>
          <a class="list-group-item" href="{{route('contact.contact')}}"><i class="fa fa-bell fa-lg" aria-hidden="true"></i>&nbsp;      رسائل التواصل   </a>

        </div>

      </div>

      {{--end sidebar --}}

      {{--Start Content Area --}}

      <div class="col-sm-9">

        @yield('dashboard-content')

      </div>


      {{-- End Content Area --}}

    </div>

  </div>

</div>

{{-- End Dashboard --}}

@endsection





@section('footer')

  <div class="dashboard-footer">

    <div class="container">



    </div>

  </div>

@endsection
