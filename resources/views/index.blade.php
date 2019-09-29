@extends("layouts.app")
{{-- elevation worship backgreund:#eeeeef --}}
<style media="screen">
  #custom-btn{
    border: 3px solid #4a6ea9;
    border-right: 3px solid transparent;
    border-radius: 100%;
    height:50px;
    width: 50px;
    line-height:30px;
    font-weight: bolder;
    transition: 0.3s ease;
  }
    #custom-btn:hover{
      background:rgba(200,200,220,0.5);
      color:#444;
      margin-left: 8px
    }
  .v-form{
    background:white;
    display:none;
    top:0px;
    z-index: 999;
    width: 100%
  }

  .v-form .header{
    background:#073e5d;
    color:white;
    padding: 10px;
  }
  .v-form form{
    padding: 10px;
  }
  .close{
    cursor: pointer;
    padding: 10px;
  }
  .messages img{
    display: none
  }
.info-h-div{
  position:fixed;
  background: rgba(255,250,250, 0.5);
  display:none;
  top:50%;
  left:50%;
  transform: translate(-50%,-50%);
  z-index: 999;
  width:360px;

}
.info-h-div .info-header{
  background:#073e5d;
  color:white;
  padding: 10px;
}
.info-h-div form{
  padding: 10px
}
.worship-btn{
  border-radius: 100%;
}
.indicator:hover.owl-theme .owl-controls .owl-buttons div.owl-next {
    margin-right: 0px !important;
}
.owl-theme .owl-controls .owl-buttons div.owl-prev i,.owl-theme .owl-controls .owl-buttons div.owl-next i {

    display: inline-block;
    font-size: 20px;
    font-weight: bold;
}
div.owl-next i,div.owl-prev i{
  color: white;
  float: left;
  background: #073e5d;
  margin-left: 20px;
  padding: 8px;
  border-radius: 3px;
}
.donate button{
  background: #073e5d;
  color: white;
  font-weight: 700;
  padding: 10px 15px;
  border-radius:3px;
  border:1px solid white;
  border-left: 30px solid white;
  border-right: 30px solid white;
  box-shadow: 0 3px 4px 0 #cacaca;
}
.banner h1,.banner h5{
  color: #333;
  font-family: sans-serif;

}
.banner h5{
  color:#073e5d
}
.banner h1{
  font-weight: bolder;
  font-size:40px;
}
.banner{
  padding-top:50px;
  background:url("images/bg-patterns/pattern-2.png")
}

</style>

@section("content")
   <div id="banner">
     <div class="container">
       <div class="row">
         <div class="col-xs-12 col-md-6">
           <div class="slider">
 					  	<div class="rslides_container">
 							<ul class="rslides" id="slider">
 								<li><img src="/images/b6.jpg" alt=""></li>
 								<li><img src="/images/b7.jpg" alt=""></li>
 								<li><img src="/images/b8.jpg" alt=""></li>
                <li><img src="/images/b9.jpg" alt=""></li>
 							</ul>
 						</div>
 					</div>
         </div>
         <div class="col-xs-12 col-md-6 counter-div">
           <div class="text-center">
              <div class="banner " >
                <h5> <strong>Experiential Worship Season 1</strong> </h5>
                <h1 class="wow bounce">GRACE UNBOUND</h1>
                 <div class="">
                   <div class="item-offer-clock" id="countdown">
                          <ul class="countdown-clock countdown" data-end-date="12/1/2019 12:00:00">
                            <li class="wow bounceInUp" data-wow-delay="0.3s">
                              <span class="days">00</span>
                              <p class="days_ref">days</p>
                            </li>
                            <li class="wow bounceInUp" data-wow-delay="0.6s">
                              <span class="hours">00</span>
                              <p class="hours_ref">hrs</p>
                            </li>
                            <li class="wow bounceInUp" data-wow-delay="0.9s">
                              <span class="minutes">00</span>
                              <p class="minutes_ref">min</p>
                            </li>
                            <li class="wow bounceInUp" data-wow-delay="1.2s">
                              <span class="seconds">00</span>
                              <p class="seconds_ref">sec</p>
                            </li>
                          </ul>
                       </div>
                 </div>
              </div>
           </div>
         </div>
       </div>
     </div>
   </div>
   <br><br>
      <div class="container">
      <div class="row">
        <h4 class="heading" ><span class="ti ti-angle-double-right"></span> Register For The Upcomming</h4>
      </div>
        <div class="row">
          <div class="col-md-6 col-sm-6 add-shadow wow bounceInLeft" data-wow-delay="0.3s">
            <div class="card">
              <a href="/register">
                <img class="card-img-top" width="100%" height="300px" src="/images/img-worshippers.jpg" alt="Card image cap">
              </a>
              <div class="card-block">
                <a href="/register" class="btn" id="custom-btn" >Worshippers Hub</a>
              </div>
            </div>
          </div>

          {{-- {{ Request::url() }} --}}
          <div class="col-md-6 col-sm-6 add-shadow wow bounceInRight">
            <div class="card volunteer">
              <a  href="{{route("blog.category","loud")}}">
                <img class="card-img-top" width="100%" height="300px" src="/images/img-volunteer.jpg" alt="Card image cap">
              </a>
              <div class="card-block">
                <a href="javascript:void()" class="btn" id="custom-btn" >Volunteer Hub</a>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">
              <iframe width="100%" height="432" src="https://www.youtube.com/embed/gaS59ddVkao" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
        </div>
      </div>
      {{-- <div class="container">
        <h4 class="heading">Feel like Giving</h4>
        <div class="donate">
          <button type="button" class="wow tada">Give</button>
        </div>
      </div> --}}
      <br>

    <div class="container">
        <div class="row">
          <div class="">
           <h4 class="heading"><span class="ti ti-angle-double-right"></span>Latest Songs</h4>
          </div>
          <div class="owl-carousel owl-theme">
                  @if (count($audioFeed) < 1)
                    <div class="alert alert-info" role="alert">
                       Posts Not Found
                    </div>
                   @else
                     @foreach ($audioFeed as $audioFeeds)
                       <!--start-single-brand-->
                           <div class="item single-brand">
                               <a href="{{ route("audio-show","$audioFeeds->slug") }}">
                                 <img src="storage/uploads/images/{{ $audioFeeds->preview_image }}"  alt="friends of worship" height="200px" width="100%">
                               </a>
                               <a href="#"><h4 style="color:#073e5d">{{$audioFeeds->title}}</h4></a>
                           </div>
                     @endforeach
                  @endif
          </div>
     </div>
  </div>


  <div class="container">
  <div class="row">
    <div class="">
     <h4 class="heading"><span class="ti ti-angle-double-right"></span>Blog Mirror</h4>
    </div>
  </div>
  <div class="row">
  @if (count($blogPosts) < 1)
    <div class="alert alert-info" role="alert">
       Posts Not Found
    </div>
   @else
     @foreach ($blogPosts as $blogPost)
       <a href="{{route('blog.show',$blogPost->slug)}}">
       <div class="col-md-4 col-sm-6 blog-design shadow1">
         <div class="card">
           @if ($blogPost->preview_image=="default.jpg")
             @else
               <a href="{{route('blog.show',$blogPost->slug)}}">
                 <img class="card-img top" src="/storage/uploads/images/{{ $blogPost->preview_image }}" width="100%" height="250px" alt="Card image cap">
               </a>
           @endif
           <div class="card-block">
             {{-- <a href="#" class="btn btn-color pull-right">Fundraise</a> --}}
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
     </a>
     @endforeach
  @endif
</div>
</div>


<div class="container">
    <div class="row">
      <div class="">
       <h4 class="heading"><span class="ti ti-angle-double-right"></span>Store Products</h4>
      </div>
      <div class="owl-carousel owl-theme">
              @if (count($products) < 1)
                <div class="alert alert-info" role="alert">
                   Posts Not Found
                </div>
               @else
                 @foreach ($products as $product)
                   <!--start-single-brand-->
                       <div class="item single-brand">
                           <a href="{{ route("store-show","$product->slug") }}">
                             <img src="storage/uploads/images/{{ $product->preview_image }}"  alt="friends of worship" height="200px" width="100%">
                           </a>
                           <a href="#"><h4 style="color:#073e5d">{{$product->title}}</h4></a>
                       </div>
                 @endforeach
              @endif
      </div>
 </div>
</div>
      {{-- <div class="our-patron">
        <div class="container text-center">
                        <div class="row">
                            <div class="brands-carousel indicator">

                                @if (count($audioFeed) < 1)
                                  <div class="alert alert-info" role="alert">
                                     Posts Not Found
                                  </div>
                                 @else
                                   @foreach ($audioFeed as $audioFeeds)
                                     <!--start-single-brand-->
                                     <div class="col-md-4" style="background:red">
                                         <div class="single-brand">
                                             <a href="{{ route("audio-show","$audioFeeds->slug") }}">
                                               <img src="storage/uploads/images/{{ $audioFeeds->preview_image }}"  alt="friends of worship" height="200px">
                                             </a>
                                             <a href="#"><h4 style="color:#073e5d">{{$audioFeeds->title}}</h4></a>
                                         </div>
                                     </div>
                                   @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
      </div> --}}
      <div class="news-letter">
        <div class="n-text">
          <h1>Our NewsLetter</h1>
          <h3>News | exclusive | Behind the scenes</h3><br>
          <button type="button" class="btn btn-primary btn-lg"> <a href="#" class="news-l">Opt In</a></button>
        </div>
      </div>
      <div class="container">
      <div class="row">
        <div class="info-h-div">
          <div class="info-header">
            <span class="ti ti-close pull-right close"></span>
             <h4>NewsLetter Sign Up</h4>
          </div>
          <div class="info-body">
            <form class="" action="{{route('newsletter.subscribe')}}" method="post">
              {{ csrf_field() }}
              <input type="email" class="form-control" name="email" value="" placeholder="please enter your email"><br>
              <button type="submit" class="btn btn-default center-block">subscribe</button>
            </form>
          </div>
        </div>
      </div>
    </div>
      <div class="overlay"></div>

      {{-- <!-- Load Facebook SDK for JavaScript -->
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>

  <!-- Your share button code -->
  <div class="fb-share-button"
    data-href="http://www.messo.com.ng"
    data-layout="button_count" data-size="large">
  </div> --}}

      <script type="text/javascript">
        $(".v-form-field").on('submit',function (e) {
          e.preventDefault();
          var firstname=$('#firstname').val()
          var lastname=$('#lastname').val()
          var email=$('#email').val()
          var phoneNo=$('#phoneNo').val()
          var role=$('#role').val()
          if ($('#male')[0].checked==true) {
            var gender="male"
          }else if($('#female')[0].checked==true) {
            var gender="female"
          }
          var urls="{{url('volunteer')}}";
          $.ajax({
            url:urls,
            method:"POST",
            dataType:"json",
            data:{'firstname':firstname,'lastname':lastname,'email':email,'phoneNo':phoneNo,'role':role,'gender':gender,'_token':'{{ csrf_token() }}'},
            beforeSend:function() {
              $('.messages img').fadeIn()
            },
            success:function(data) {
              if (data.errors) {
                  $(".messages").html('')
                $.each(data.errors,function (i,val) {
                  $(".messages").append("<div class='alert alert-danger'>"+val[0]+"</div>");
                  console.log(val[0]);
                })
                $("html,body").animate({
                  scrollTop:$(".messages").offset().top+10
                })
              }else {
                $(".messages").html('')
                $(".messages").append("<div class='alert alert-success'>"+data.success+"</div>");
                $(".v-form-field input").val("")
                $("html,body").animate({
                  scrollTop:$(".messages").offset().top+10
                })


              }
            }
        })
      })
      </script>
      <script type="text/javascript" src="/js/plugins/responsiveslides.js"></script>
@endsection("content")
