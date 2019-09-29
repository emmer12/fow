
@extends("layouts.app")
{{-- elevation worship backgreund:#eeeeef --}}

@section("content")
   <div class="container">
     <div class="blog-nav">
       <ul class="nav nav-tabs">
         <li class="nav-item">
           <a href="{{route("blog.index")}}" class="nav-link active-ms">All</a>
         </li>
         @foreach ($categories as $category)
           <li class="nav-item">
             <a href="{{route("blog.category",$category->name)}}" class="nav-link">{{$category->name}}</a>
           </li>
         @endforeach
       </ul>
     </div>
     <h4 class="heading">Latest News</h4>
     <div class="row">
       @if (count($blogPostCategory) > 0)
         @foreach ($blogPostCategory as $blogPost)
           <div class="col-md-4 " >
             <div class="card blog-design" style="margin-left:3px;">
               @if ($blogPost->preview_image=="default.jpg")
                 heool
                 @else
                   <a href="{{route('blog.show',$blogPost->slug)}}">
                     <img class="card-img top" src="/storage/uploads/images/{{ $blogPost->preview_image }}" width="100%" height="250px" alt="Card image cap">
                   </a>
               @endif
               <div class="card-block">
                 <a href="{{route('blog.show',$blogPost->slug)}}">
                   <h4 class="card-title">{{$blogPost->title}}</h4>
                 </a>
                 <div class="blog-info-div">
                   <p class="card-text">{{ $blogPost->body }}</p>
                   <span><i class="ti ti-time"> {{ $blogPost->created_at }}</i></span>
                   <span class="pull-right"><a href="{{route('blog.show',$blogPost->slug)}}">read more..</a> </span>
                 </div>

               </div>
             </div>
           </div>
           {{-- @if ( $blogPost->category == "news")
             <div class="col-md-4 blog-design">
               <div class="card">
                 <a href="{{route('blog.show',$blogPost->slug)}}">
                   <img class="card-img top" src="/storage/uploads/images/{{ $blogPost->preview_image }}" width="100%" height="250px" alt="Card image cap">
                 </a>
                 <div class="card-block">
                   <a href="{{route('blog.show',$blogPost->slug)}}">
                     <h4 class="card-title">{{$blogPost->title}}</h4>
                   </a>
                   <div class="blog-info-div">
                     <p class="card-text">{{ $blogPost->body }}</p>
                     <span><i class="ti ti-time"> {{ $blogPost->created_at }}</i></span>
                     <span class="pull-right"><a href="{{route('blog.show',$blogPost->slug)}}">read more..</a> </span>
                   </div>
                 </div>
               </div>
             </div>
           @elseif ($blogPost->category== "fund-raise")
               <div class="col-md-4 blog-design">
                 <div class="card">
                   <a href="{{route('blog.show',$blogPost->slug)}}">
                     <img class="card-img top" src="/storage/uploads/images/{{ $blogPost->preview_image }}" width="100%" height="250px" alt="Card image cap">
                   </a>
                   <div class="card-block">
                     <a href="#" class="btn btn-color pull-right">Fund Raise</a>
                     <a href="{{route('blog.show',$blogPost->slug)}}">
                      <h4 class="card-title">{{$blogPost->title}}</h4>
                     </a>
                     <div class="blog-info-div">
                       <p class="card-text">{{ $blogPost->body }}</p>
                       <span><i class="ti ti-time"> {{ $blogPost->created_at }}</i></span>
                       <span class="pull-right"> <a href="{{route('blog.show',$blogPost->slug)}}">read more..</a> </span>
                     </div>
                   </div>
                 </div>
               </div>
           @endif
         --}}
       @endforeach
         @else
           <div class="alert alert-info" role="alert">
             No Post Under this category
           </div>
       @endif



     </div>
     <nav>
       <ul class="pager">
         {{ $blogPostCategory->links() }}
       </ul>
     </nav>
   </div>
@endsection("content")
