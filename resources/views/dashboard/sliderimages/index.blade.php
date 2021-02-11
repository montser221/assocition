@extends('dashboard.index')
@section('title', ' إدارة ملفات الاسلايدر ')
@section('dashboard-content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">لوحة التحكم</a></li>
            <li class="breadcrumb-item active" aria-current="page">إدارة ملفات الاسلايدر</li>
        </ol>
    </nav>
    <div class="sliderimages">
        <div class="h5">إدارة ملفات الاسلايدر</div>
        <div class="row " style="margin-bottom:15px">
            <div class="col">
                <form class="" action="" method="post">
                    <input type="text" class="form-control" name="" value="">
                </form>
            </div>
            <div class="col offset-md-8">
                {{-- <a type="button" class="btn  border border-dark " name="button">  <i class="fa fa-upload fa-lg"></i>  تصدير </a>
          <a type="button" class="btn  border border-dark " name="button"> <i class="fa fa-download fa-lg"></i> استيراد </a> --}}
                <!-- Button trigger modal Create New Projects -->
                <button data-toggle="modal" data-target="#sliderImage" type="button" class="btn text-orange text-white "
                    name="button"> <i class="fa fa-plus "></i> &nbsp;&nbsp; أنشاء </a>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="sliderImage" tabindex="-1" data-keyboard="false" data-backdrop="static"
            aria-labelledby="sliderImageLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="sliderImageLabel">أنشاء ملف جديد</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- sliderTitle
sliderImage
sliderText
sliderLink
sliderStatus --}}
                        <form id="create-form" enctype="multipart/form-data" method="post"
                            action="{{ route('sliderimages.store') }}">
                            @csrf
                            @method('POST')
                            <div class="form-row">
                                <div class="col">
                                    <label class="label-control" for="sliderTitle"> العنوان </label>
                                    <input id="inputProjectName" type="text" name="sliderTitle" شعautofocus
                                        class="form-control" placeholder="أكتب    عنوان الملف">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col">
                                    <label class="label-control" for="sliderLink"> الرابط </label>
                                    <input type="text" class="form-control" name="sliderLink" placeholder="نص مختصر">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="label-control" for="sliderImage">صورة مميزة</label>
                                    <input type="file" name="sliderImage" class="form-control">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col">
                                    <label class="label-control" for="sliderText">نص مختصر</label>
                                    <textarea name="sliderText" class="form-control" rows="6"
                                        placeholder="أكتب المحتوى هنا"></textarea>
                                </div>
                            </div>

                            <div class="form-row mt-3">
                                <div class="col">
                                    <div class="form-group form-check">
                                        <input class="form-check-input" type="checkbox" id="sliderStatus"
                                            name="sliderStatus">
                                        <label class="form-check-label" for="sliderStatus"> تفعيل الملف</label>
                                    </div>
                                </div>

                            </div>

                    </div>
                    <div class="modal-footer d-block">
                        <button type="button" class="btn text-warning btn-main" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn text-orange text-white "> إضافة <i class="fa fa-plus"></i></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- End Modal Create --}}
        {{-- Errors message --}}
        @include('includes.errors')
        {{-- success message --}}
        @include('includes.success')
        <table class="table table-hover table-bordered">
            <thead>
                <th>#</th>
                <th> العنوان</th>
                <th> نص مختصر</th>
                <th> الرابط</th>
                <th>الصورة المميزة</th>
                <th> الحالة </th>
                <th> أحداث </th>
            </thead>
            <tbody>
                <?php $ids = 0; ?>
                @foreach ($allsliderimages as $slider)
                    <?php $ids = 0; ?>
                    <tr>
                        <td> {{ $ids }} </td>
                        <td>{{ $slider->sliderTitle }}</td>
                        <td>{{ $slider->sliderText }}</td>
                        <td>{{ $slider->sliderLink }}</td>
                        <td> <img style="max-width:40px;max-height:40px" src="{{ url('storage/' . $slider->sliderIcon) }}"
                                class="icon" alt="" /></i> </td>
                        <td>نعم</td>
                    <td class="@if ($slider->sliderStatus == 1) text-success @else
                            text-danger @endif">
                            @if ($slider->sliderStatus == 1)
                                تم التفعيل
                            @else
                                غير مفعل
                            @endif
                        </td>
                        <td>
                            <form class="form-inline" action="{{ route('sliderimages.destroy', $slider->sliderId) }}"
                                method="post">
                                @csrf
                                @method("DELETE")

                                <a class="btn  btn-sm ml-1" href="{{ route('sliderimages.edit', $slider->sliderId) }}"><i
                                        class="fa fa-edit "></i></a>
                                <button type="submit" class="btn  btn-sm  btn-slider"><i class="fa fa-bank "></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="container">
            {{ $allsliderimages->links() }}
        </div>
    </div>
@endsection
