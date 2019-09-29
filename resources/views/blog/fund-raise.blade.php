
@extends("layouts.app")
{{-- elevation worship backgreund:#eeeeef --}}

@section("content")
   <div class="container">
     <div class="blog-nav ">
       <ul class="nav nav-tabs">
         <li class="nav-item">
           <a href="{{ route("blog.index") }}" class="nav-link">News</a>
         </li>
         <li class="nav-item">
           <a href="{{ route("fund-raise.index") }}" class="nav-link active-ms">Found Raise</a>
         </li>
         <li class="nav-item">
           <a href="{{ route("testimonies.index") }}" class="nav-link">Testimonial</a>
         </li>

       </ul>
     </div>
     <h4 class="heading"> Fund Raise</h4>
     <div class="row">
     @if (count($fund_raise) < 1)
       <div class="alert alert-info" role="alert">
          Posts Not Found
       </div>
      @else
        @foreach ($fund_raise as $fund_raise)
          <div class="col-md-4 blog-design">
            <div class="card">
              <a href="{{route('blog.show',$fund_raise->slug)}}">
                <img class="card-img top" src="/storage/uploads/images/{{ $fund_raise->preview_image }}" width="100%" height="250px" alt="Card image cap">
              </a>
              <div class="card-block">
                <a href="#" class="btn btn-color pull-right">Fund Raise</a>
                <a href="{{route('blog.show',$fund_raise->slug)}}">
                 <h4 class="card-title">{{$fund_raise->title}}</h4>
                </a>
                <div class="blog-info-div">
                  <p class="card-text">{{ $fund_raise->body }}</p>
                  <span><i class="ti ti-time"> {{ $fund_raise->created_at }}</i></span>
                  <span class="pull-right"> <a href="{{route('blog.show',$fund_raise->slug)}}">read more..</a> </span>
                </div>
              </div>
            </div>
          </div>
        @endforeach
     @endif
   </div>

 </div>
@endsection("content")
