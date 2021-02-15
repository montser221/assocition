<!-- Start Contact Us -->
<div class="container">
  <div class="contactus">
    <!--Start Banner-->
          <!-- End Banner-->
    <div class="row">
      <div class="col-sm-6 center-phone">
        <div class="h2 text-right main-color center-phone">تواصل معنا  </div>
        <div class="word-title text-center">
        <div class="text-center mt-1 mb-4 line-design-right"></div>
        </div>
        <div class="short-text text-gray mb-3">
          تواصل معنا لأي استفسار على الخدمات التكافلية الخيرية  

        </div>
      </div>
      <div class="col-sm-6 center-phone" >
        <form class="form-contact" action="{{route('contact.store')}}" method="post">
          @csrf
          @method('POST')
          {{-- <input type="hidden" name="contact_home"> --}}
            <div class="form-group">
              <Select name="msgType" class="form-control p-0"   >
                <option disabled selected >نوع الرسالة</option>
                <option @if (old('msgType') =="complaint") selected @endif  value="complaint"> شكوى</option>
                <option @if (old('msgType') == "suggist") selected @endif value="suggist">إقتراح</option>
                <option @if (old('msgType') == "inquire") selected @endif value="inquire">استفسار</option>
              </Select>
               @error('msgType')
              <div class="alert alert-danger mt-2">
                {{$message}}
              </div>
            @enderror
            </div>
          <div class="form-inline" style="display: flex;justify-content: space-between;">
            <input 
                  class="form-control  ml-1 mb-2 fullname" 
                  type="text" 
                  placeholder="الاسم الكامل"  
                  value="{{old('fullname')}}" 
                  name="fullName" 
                  @error('fullName') style="width: 100%"  @enderror  >
                  @error('fullName')
              <div class="alert alert-danger w-100">
                {{$message}}
              </div>
            @enderror
            <input class="form-control  mb-2 email " type="text" placeholder="البريد الالكتروني" value="{{old('email')}}" name="email"  @error('email') style="width: 100%  !important;"  @enderror   >
            @error('email')
              <div class="alert alert-danger w-100">
                {{$message}}
              </div>
            @enderror
          </div>
          <div class="form-group">
            <input class="form-control  mb-3" type="text" placeholder="الموضوع" value="{{old('topic')}}" name="topic"  >
              @error('topic')
              <div class="alert alert-danger">
                {{$message}}
              </div>
            @enderror
          </div>
          <div class="form-group">
            <textarea class="form-control mb-3" name="msg" placeholder="اكتب الرسالة هنا..." rows="" cols="">{{old('msg')}}</textarea>
            @error('msg')
              <div class="alert alert-danger ">
                {{$message}}
              </div>
            @enderror
          </div>
          <input type="submit" class="btn btn-main-color btn-lg c-btn c-sm" name="" value="إرسال">
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Contact Us -->
