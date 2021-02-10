@extends('dashboard.index')
@section('title','إدارة  أعضاء مجلس الادارة')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item active "  > <a href="{{route('members.index')}}"> إدارة   أعضاء مجلس الادارة  </a></li>
     </ol>
    </nav>
    <div class="users">

      <div class="row " style="margin-bottom:15px">
        <div class="col">
          <form class="" action="" method="post">
            <input type="text" class="form-control" name="" value="">
          </form>
        </div>

        <div class="col offset-lg-8">
          {{-- <a type="button" class="btn border border-dark  " name="button">  <i class="fa fa-upload fa-lg"></i>  تصدير </a>
          <a type="button" class="btn border border-dark " name="button"> <i class="fa fa-download fa-lg"></i> استيراد </a> --}}
              <!-- Button trigger modal Create New members -->
          <button data-toggle="modal" data-target="#createmembers" type="button" class="btn text-orange text-white " name="button">  <i class="fa fa-plus "></i> &nbsp;&nbsp; أنشاء </a>
        </div>

      </div>

      <!-- Modal -->
      <div class="modal fade" id="createmembers" tabindex="-1" data-keyboard="false"  data-backdrop="static" aria-labelledby="createmembersLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createmembersLabel"> أضافة  أعضاء مجلس الادارة   </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form  id="create-form" enctype="multipart/form-data" method="post" action="{{route('members.store')}}">
                @csrf
                @method('POST')
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="memberName"> الاسم  </label>
                    <input id="memberName" type="text" name="memberName" class="form-control w-40" value="{{old('memberName')}}" placeholder="أكتب  الاسم     ">
                  </div>

                </div>
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="shortText"> نص  مختصر </label>
                    <input style="margin-right: 10%;" id="shortText" type="text" name="shortText" value="{{old('shortText')}}"  placeholder=" نص مختصر  " class="form-control w-80"  >
                  </div>
                </div>
                {{-- memberEmail','memberPhone --}}
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="memberEmail">    الايمل </label>
                    <input style="margin-right: 10%;" 
                    id="memberEmail" 
                    type="text" 
                    name="memberEmail" 
                    value="{{old('memberEmail')}}"  
                    placeholder="  الايمل " 
                    class="form-control w-80"  >
                  </div>
                </div>
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="memberPhone">  رقم الواتساب   </label>
                    <input style="margin-right: 10%;" 
                    id="memberPhone" 
                    type="text" 
                    name="memberPhone" 
                    value="{{old('memberPhone')}}"  
                    placeholder=" رقم الواتساب " 
                    class="form-control w-80"  >
                  </div>
                </div>
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="shortText"> الصورة الشخصية </label>
                    <input style="margin-right: 10%;" id="memberImage" type="file" name="memberImage"   class="form-control-file w-80"  >
                  </div>
                </div>
                <div class="form-row">
                  <div class="col" style="margin-top:8%">
                    <div class="form-check">
                      <label class="form-check-label" for="memberStatus">
                        <input class="form-check-input" type="radio" name="memberStatus" id="memberStatus" value="1"  >
                        تفعيل
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label" for="memberStatus">
                        <input class="form-check-input" type="radio" name="memberStatus" id="memberStatus" value="0"  >
                     الغاء
                      </label>
                    </div>
                  </div>
                </div>
            <div class="modal-footer">
              <button type="button" class="btn text-warning btn-main" data-dismiss="modal">الغاء</button>
              <button style="margin: 0 8%;" type="submit" class="btn text-orange text-white "> إضافة <i class="fa fa-plus"></i></button>
            </div>
          </form>
          </div>
        </div>
      </div
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
          <th> الإسم </th>
          <th>  نص مختصر   </th>
          <th> الايمل</th>
          <th>   رقم الواتساب </th>
          <th>الصورة الشخصية </th>
          <th>الحالة   </th>
          <th> أحداث  </th>
        </thead>
        <tbody>
          @foreach ($allmembers as $members)
            <tr>
              <td>  {{$members->memberId}}</td>
              <td>{{  $members->memberName }}</td>
              <td>{{  $members->shortText }}</td>
              <td>{{  $members->memberEmail }}</td>
              <td>{{  $members->memberPhone }}</td>
              <td><img style="width: 50px; height: 50px;" src="{{url('uploads/members/'. $members->memberImage )}}" alt="" /></td>

              <td class="@if ($members->memberStatus ==1) text-success  @else text-danger   @endif">
                @if ($members->memberStatus ==1)
                  تم التفعيل
                @else
                  غير مفعل
                @endif
              </td>
               <td>
                <form class="form-inline" action="{{route('members.destroy',$members->memberId) }}" method="post">
                  @csrf
                  @method("DELETE")
                  <a class="btn  btn-sm ml-1" href="{{route('members.edit',$members->memberId)}}" ><i class="fa fa-edit "></i></a>
                  <button   type="submit" class="btn  btn-sm  btn-project"><i class="fa fa-bank "></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
@endsection
