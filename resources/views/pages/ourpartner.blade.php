<?php $show = 0 ?>
@foreach ($agents as $agen)
  @if ($agen->agentStatus==1)
    <?php $show = 1 ?>
  @endif
@endforeach
@if ($show)
<div class="our-partner">
  <div class="container">


<div class="h2 text-center">من  شركائنا</div>
 <div class="text-center mt-1 mb-4 line-design"></div>
<div id="carouselAgentsIndicators" class="carousel slide" data-ride="carousel" data-interval="false">    
        <?php $i=-1; ?>
      <ol class="carousel-indicators">
     @foreach ($agents->chunk(5) as $agent)
      <?php $i++; ?>
        <li data-target="#carouselAgentsIndicators" data-slide-to="{{$i}}" class="@if($i==0) active @else @endif" ></li>
    @endforeach
      </ol>
    <div class="carousel-inner">
      <div class="row">

    @foreach ($agents->chunk(5) as $agent)
      <div id="partner-slide" class="carousel-item    {{ $loop->first ? 'active' :'' }} ">
        @foreach ($agent as $agen)

        <div class="d-flex">
          <img class="partner-image" src="{{ url("uploads/agents/".$agen->agentImage) }}" alt="1" />
          </div>
      @endforeach

    </div>

      @endforeach
  </div>

    </div>
 
  </div> <!-- end Carousel -->
 
  </div> <!--End container -->
</div>
  @endif
{{-- End Our Projects --}}