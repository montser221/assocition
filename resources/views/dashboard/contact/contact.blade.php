@extends('dashboard.index')
@section('title','رسائل التواصل')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item active "  > <a>  رسائل التواصل  </a></li>
     </ol>
    </nav>
    <div class="users">

      <div class="row " style="margin-bottom:15px">
        <div class="col">
          <form class="" action="" method="post">
            <input type="text" class="form-control" name="" value="">
          </form>
        </div>

      </div>

       {{-- Errors message --}}
      @include('includes.errors')
      {{-- success message --}}
      @include('includes.success')

      <table class="table table-hover table-bordered">
        <thead>
          <th>#</th>
          <th>   الاسم </th>
          <th> البريد الالكتروني </th>
          <th> الموضوع</th>
          <th> الرسالة</th>
          <th> نوع الرسالة</th>
          <th> أحداث  </th>
        </thead>
        <tbody>
          @foreach ($allContact as $contact)
            <tr>
              <td>  {{ $contact->contactId }}</td>
              <td>{{  $contact->fullname }}</td>
              <td>{{  $contact->email }}</td>
              <td>{{  $contact->topic }}</td>
              <td>{{  $contact->message }}</td>
              <td>
               @if($contact->msgType=="complaint")
               شكوى
              @elseif($contact->msgType == "suggist")
              إقتراح
              @elseif($contact->msgType == "inquire")
              أستفسار
               @endif
               </td>
              <td>
                <form class="form-inline" action="{{route('contact.destroy',$contact->contactId) }}" method="post">
                  @csrf
                  @method("DELETE")
                  <a style="color: #333" href="{{route('contact.msgDetail',$contact->contactId)}}"><i class="fa fa-eye fa-lg"></i></a>
                  <button   type="submit" class="btn  btn-sm  btn-project"><i class="fa fa-bank "></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $allContact->links() }}
    </div>
@endsection
