
@extends("layouts.app")
{{-- elevation worship backgreund:#eeeeef --}}
<style media="screen">

  .testimonial{
    text-align:center;
    padding:30px 0 15px
  }
  .testimonial h6{
    font-weight:700
  }
  .testimonial img{
    border-radius:50%;
    margin:5px 0;
    height:60px;
    width:60px;
    box-shadow:0 2px 2px 0 transparent,0 1px 5px 0 rgba(0,0,0,.24),0 3px 1px -2px transparent
  }
   .testimonial .owl-theme .owl-controls .owl-page span{
     width:10px;height:10px
   }
</style>
@section("content")
   <div class="container">
     <div class="blog-nav ">
       <ul class="nav nav-tabs">
         <li class="nav-item">
           <a href="{{ route("blog.index") }}" class="nav-link">News</a>
         </li>
         <li class="nav-item">
           <a href="{{ route("fund-raise.index") }}" class="nav-link ">Found Raise</a>
         </li>
         <li class="nav-item">
           <a href="{{ route("testimonies.index") }}" class="nav-link active-ms">Testimonial</a>
         </li>

       </ul>
     </div>
     <h4>Testimonies</h4>
     <!-- testimonial -->
   	<div class="testimonial app-pages">
   		<div class="container">
        @if (count($testimonies) < 1)
          <div class="alert alert-info" role="alert">
            No post Available
          </div>
          @else
            <div id="testimonial" class="owl-carousel owl-theme">
                @foreach ($testimonies as $testimony)
                <div class="item">
                  <p>{{ $testimony->body }}</p>
                  <img src="/images/testimonial.jpg" alt="">
                  <h6>{{ $testimony->title  }}</h6>
                </div>
              @endforeach
            </div>
        @endif
   		</div>
   	</div>
   	<!-- end testimonial -->
 		</div>
   </div>
@endsection("content")
