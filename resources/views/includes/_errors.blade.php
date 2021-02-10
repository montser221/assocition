@if ($errors->any())
<div  class="mt-5">
    <ul class="list-unstyled">
        @foreach ($errors->all() as $error)
            <li class="alert alert-danger">{{ $error }}</li>
        @endforeach
    </ul>
    <div class="rm-after-delete" style="margin-bottom:160px;margin-top:40px">

    </div>
</div>
@endif
