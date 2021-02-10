@extends('layouts.app')

@section('title','  التقارير المالية   ')

@include('includes.header')
<div class="dulni">
  <!--Start Banner-->
  <div class="  px-0 banner" id="dulani-banner">
    <div class="dulni-inner">
      <div class="container">
        <div class="page-path">
          <p><a href="{{url("/")}}"> الرئيسية </a>/  التقارير المالية </p>
        </div>
      </div>
    </div>

  </div>
        <!-- End Banner-->

      <!-- Start Dullani Form-->
        <div class="allfiles mx-auto">
          <div class="container" id="dulani-form-container">
            
            <h3 class="text-center mt-5 mb-2"> التقارير المالية </h3>
            <div class="text-center mt-1 mb-4 line-design"></div>
              <div class="row mb-5">
{{-- //  `ReportId`, `reportTitle`, `reportImageFile`, `reportPdfFile`, `reportStatus`, `created_at`, `updated_at` --}}
                
                @foreach ($reportFiles as $file)
                  <div class="col-sm-12 col-md-4 4 mt-5 center-phone">
                    <a target="_blank" class="d-block" href="{{url('uploads/reportFiles/'.$file->reportPdfFile)}}">
                    <img src="{{url("uploads/reportFiles/".$file->reportImageFile)}}" alt="">
                  
                    <span class="video-title" style=" display: block; margin-right: 15px; margin-top: 14px; margin-bottom: 15px;">{{$file->reportTitle}} </span>
                      </a>
                    <span class="video-shows-count"> <i class="fa fa-eye"></i>
                    <span>0</span>
                    <span class="video-date">{{ $file->created_at->format('Y-m-d')}}</span>
                    </span>
                    <br>  
                  </div>     
                @endforeach
              </div>
         
          
          </div>
      </div>
    </div>
</div>
{{-- @include('includes.ourlocation') --}}
@include('includes.footer')
