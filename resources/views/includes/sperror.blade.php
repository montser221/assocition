@extends('layouts.app')
@section('title','   خطأ')
@section('content')
<div class='alert alert-danger text-center' style="font-weight:bold;font-size:2rem"  >
 حدد التاريخ من فضلك 
 </div>
 <?php  
    $id =  request()->id;
 ?>
 <div class="text-center" style="width:30%;    margin: 0 auto;">
 <a href="{{ route('dDetail',$id) }}" class="btn btn-main-color btn-block"> عودة</a>
 </div>
 @endsection