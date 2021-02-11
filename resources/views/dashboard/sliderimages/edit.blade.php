@extends('dashboard.index')
@section('title', ' تعديل ملف الاسلايدر ')
@section('dashboard-content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">لوحة التحكم</a></li>
            <li class="breadcrumb-item " aria-current="page"> <a href="{{ route('sliderimages.index') }}">إدارة المشاريع </a>
            </li>
            <li class="breadcrumb-item active">  تعديل ملف الاسلايدر    </li>
        </ol>
    </nav>
    <div class="projects-edit" style="background-color:#FFF;padding:15px">
        {{-- Errors message --}}
        @include('includes.errors')
        @include('includes.success')
        <h5>   تعديل ملف الاسلايدر  </h5>
        <form id="edit-form" enctype="multipart/form-data" method="post"
            action="{{ route('sliderimages.update', $data->sliderId) }}">
            @csrf
            @method('PATCH')
            <div class="form-row">
                <div class="col">
                    <label class="label-control" for="sliderTitle"> العنوان </label>
                    <input   
                      type="text" 
                      name="sliderTitle"  
                      autoFocus 
                      class="form-control"
                      value="{{ $data->sliderTitle }}"
                      >
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <label class="label-control" for="sliderLink"> الرابط </label>
                    <input 
                      type="text"
                      class="form-control"
                        name="sliderLink"
                        value="{{ $data->sliderLink }}"
                        >
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <label class="label-control" for="sliderImage">صورة مميزة</label>
                    <input 
                        type="file" 
                        name="sliderImage" 
                        class="form-control"
                        >
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <label class="label-control" for="sliderText">نص مختصر</label>
                    <textarea 
                        name="sliderText" 
                        class="form-control" 
                        rows="6" 
                          >{{ $data->sliderText }}</textarea>
                </div>
            </div>
            <div class="form-row mt-3">
                <div class="col">
                    <div class="form-group form-check">
                        <input 
                          class="form-check-input" 
                          type="checkbox" 
                          id="sliderStatus" 
                          name="sliderStatus"
                          @if($data->sliderStatus == 1) checked="checked" @else  @endif
                          >
                        <label class="form-check-label" for="sliderStatus"> تفعيل الملف</label>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <button type="submit" class="btn text-orange text-white "> حفظ التعديلات <i class="fa fa-save"></i></button>
            </div>
        </form>
    </div>
    {{-- Start Modal Edit --}}
    {{-- End Modal Edit --}}
@endsection