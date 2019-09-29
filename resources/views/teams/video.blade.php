@extends("layouts.app")
   {{-- elevation worship backgreund:#eeeeef --}}
@section("content")
  <div class="overlay">

  </div>
   <div class="">
     <div class="v-banner text-center">
       <div class="m-banner-c">
         <span class="glyphicon glyphicon-camera "></span>
         <h4>Video</h4>
       </div>
     </div>
   </div>
   <br>
     <div class="container">
       <ul class="list-inline teams-cat-nav">
         <li><a class="btn btn-t" style="color:inherit" href="{{ route('fow.all.tracks')}}">Audio</a></li>
         <li><a class="btn btn-t active-team"  href="{{ route('video-page')}}">Video</a></li>
       </ul>
       <div class="row">
         @if ($video_posts->count() < 1)
           <div class="alert alert-warning" role="alert">
             No Video is avalable
           </div><br>
           <a href="{{ route('home-page')}}"><button type="button" class="btn btn-primary"> <span class="ti ti-arrow-left"></span> Go back To Home </button></a>
           @else
             {{-- Video Template --}}

             @foreach ($video_posts as $video_post)
               <style media="screen">
                 .v-div .details{
                   padding: 10px;
                   font-size: 14px;
                   font-weight: bolder;

                 }
               </style>
               <div class="col-md-4">
                 <div class="v-div">
                   <a class="" href="{{ route("video-show","$video_post->slug") }}" style="color:inherit">
                     <img src="/storage/uploads/images/{{ $video_post->preview_image }}" alt="">
                   </a>
                   <div class="details">
                     <a href="{{ route("video-show","$video_post->slug") }}" style="color:inherit">
                       <span>{{$video_post->title}}</span>
                     </a>
                     <div class="play-time pull-right">
                       <span class="ti ti-control-play video-p"  data-id="vid-{{$video_post->id}}"></span>
                       <span class="duration{{ $video_post->id }}"></span>
                     </div>
                   </div>
                 </div>
                 <div class="vid-display-con vid-display-con-vid-{{$video_post->id}}">
                   <video  src="/storage/uploads/videos/{{ $video_post->video }}" ids="{{ $video_post->id}}" class="video-vid-{{$video_post->id}}" loop style="position:absolute;width:100%;height:340px" ></video>
                   <div class="control">
                     <h4>{{$video_post->title}}</h4>
                     <div class="dis-play-time pull-right">
                       <span class="ti ti-control-play video-p" data-id='vid-{{$video_post->id}}'></span>
                       <span class="duration{{ $video_post->id }}"></span>
                       <span class="ti ti-close close-vid" ></span>
                     </div>
                   </div>
                 </div>
               </div>

             @endforeach


             {{-- video template end  --}}



         @endif



       </div>
     </div>
   <nav>
     <ul class="pager-custom">
       {{ $video_posts->links() }}
     </ul>
   </nav>

   <script type="text/javascript">
   $(document).ready(function () {
    // window.setInterval(function (i) {
    //    if ($('video').readyState >0 ) {
    // .     var minute=parseInt($('video').duration)
    //      var seconds=$('video').duration % 60;
    //      console.log(minute);
    //
    //      clearInterval(i)
    //    }
    //  },200)

      var vid=$('video');
      $.each(vid,function (x,y) {
        $("video")[x].addEventListener('loadedmetadata',function() {
        var id=$(this).attr("ids");
        var duration_min=Math.floor($('.video-vid-'+id)[0].duration/60)
        var duration_sec=Math.floor($('.video-vid-'+id)[0].duration-duration_min * 60)
        if (duration_min < 10) {
          duration_min = "0" + duration_min
        }
        if (duration_sec < 10) {
          duration_sec = "0" + duration_sec
        }
        console.log(duration_min);
        var timeft=duration_min + ":" + duration_sec
        $(".duration"+id).html(timeft)
    })
  })
     // })
     // function time(vid,time){
     //   var getMin=Math.floor(vid.duration/60);
     //   var getSec=Math.floor(vid.duration-getMin*60);
     //   time.innerHTML=getMin+":"+getSec;
     // }
     // var time=$("video");
     // if (time) {
     //
     // }
     // console.log(time[0].duration);
     // for (var i = 0; i < time.length; i++) {
     // }
   //})
 });

   </script>

@endsection("content")
