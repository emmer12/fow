
@extends("layouts.app")
{{-- elevation worship backgreund:#eeeeef --}}
<style media="screen">
  .s-socials{
    background: #eff;
    padding: 10px;
    margin-top:20px;
  }
  .s-socials span:first-child{
    padding: 10px 5px;
    background: #32ddf3;
    color: whitesmoke;
  }
  .s-socials span:last-child{
    padding:10px 5px;
    background: #4a6ea9;
    color:whitesmoke;
  }
  .well h4 span{
    font-size: 14px;
  }
</style>
@section("content")
  <br>
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="s-blog">
          @if (!Auth::guest())
            @if (Auth::user()->id == $blogPost->user_id || in_array("Admin",$userRole))
              @if (in_array("Admin",$userRole) || in_array("Author",$userRole))
                <div class="admin-action pull-right">
                  <button type="button" class="btn btn-primary"><span class="ti ti-change"></span>Edit</button>
                  <button type="button" class="btn btn-danger"> <span class="ti ti-trash"></span> Delete</button>
                </div>
              @endif
            @endif
          @endif
            <div class="blog-heading">
              <div class="blog-title ">
                <h1 class="center">Deploying Larael 5 applications on Shared hosting</h1>
              </div><br>
               <div class="author-info">
                 <a href="{{route('blog.show',$blogPost->slug)}}">
                   <img src="/storage/uploads/images/{{$blogPost->author()->profile_picture}}" class="avata" width="50px;" height="50px" alt="friends of worship">
                 </a>
                 <span style="font-weight:bolder">{{$blogPost->author()->firstname}} {{$blogPost->author()->lastname}}</span><br>
                  <p>Updated on <i><b>{{ $blogPost->created_at }}</b></i></p>
                 <div class="tags">
              <?php
                     $tags=explode(',', $blogPost->tags);
                     $last=array_pop($tags);
                     foreach ($tags as $tag) {
                       echo '<a href="'.route("blog.tag",$tag).'">'.$tag.'</a>';
                     };
               ?>
                 </div>

                 <div class="s-socials">
                   <span class="ti ti-twitter">Twitter</span>
                   <div class="fb-share-button"
                         data-size="large"
                         data-href="{{ url()->full() }}"
                         data-layout="button_count">
                   </div>
                   {{-- <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" ><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div> --}}
                 </div>
               </div>

               <div class="blog-body">
                 <img src="/storage/uploads/images/{{ $blogPost->preview_image }}" width="100%" alt="friends of worship">
                 <br><br>
                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
               </div>

             </div>
          </div>
      </div>
      <div class="col-md-4">
        <div class="">
         <h4 class="heading"><span class="ti ti-angle-double-right"></span>Recommended Reading</h4>
        </div>
         @foreach ($relatedposts as $relate)
           <div class="card recommended">
             <a href="{{route('blog.show',$relate->slug)}}">
               <img class="card-img-top" src="/storage/uploads/images/{{ $relate->preview_image }}" alt="Friends of worship" width="100%" height="100%">
               <div class="card-block">
                 <h4 class="card-title">{{$relate->title}}</h4>
               </div>
             </a>
           </div>
         @endforeach
        <div class="related-category">
          <div class="">
            <h4 class="heading"><span class="ti ti-angle-double-right"></span>Categories</h4>
          </div>

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
            <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->full() }}" class="social-button " id=""><span class="ti ti-facebook"></span></a></li>
      </div>
    </div>
    </div>
  </div>


<br>
<br>
@endsection("content")
