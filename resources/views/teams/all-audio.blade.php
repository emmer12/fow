@extends("layouts.app")
{{-- elevation worship backgreund:#eeeeef --}}
<style media="screen">
.play-time{
  top: -80px;
}


</style>
@section("content")
   <div class="">
     <div class="m-banner text-center">
       <div class="m-banner-c">
         <span class="glyphicon glyphicon-music "></span>
         <h4>MUSIC</h4>
       </div>
     </div>
   </div>
   <br>
     <div class="container">
       <ul class="list-inline teams-cat-nav">
         <div class="row">
           <form class="search-form storeSearch text-right" action="{{route("audio.search")}}" method="post">
             {{ csrf_field() }}
             <input type="text" name="search" class=""  value="{{old('search')}}" placeholder="search..." >
             <input type="submit" name="submit" value="GO" >
           </form>
         </div>
         <li><a class="btn btn-t active-team"  href="{{ route('team-page')}}">Audio</a></button></li>
           <li><a class="btn btn-t" style="color:inherit" href="{{ route('video-page')}}">Video</a></button></li>
       </ul>
       <div class="row">
         @forelse($music_posts as $music_post)
           <div class="col-md-4 col-sm-6">
             <div class="m-div player">
               <a href="{{ route("audio-show","$music_post->slug") }}" style="color:inherit">
                 <img src="/storage/uploads/images/{{ $music_post->preview_image }}" alt="">
               </a>
               <audio src="/storage/uploads/audios/{{ $music_post->music }}" ids="{{ $music_post->id }}" class='audio-{{ $music_post->id}}' ></audio>
               <div class="pull-right audeo-title" id="title">
                 <a href="{{ route("audio-show","$music_post->slug") }}" style="color:inherit">
                   <h4>{{ $music_post->title }}</h4>
                 </a>
               </div>
               <div class="audio-cont" style="position:absolute;right:30px;top:75px" >
                 <small class="name-artist" data-id='{{ $music_post->id }}'>{{ $music_post->user->firstname }} {{ $music_post->user->lastname }}</small>
                 <span class="ti ti-control-play audio-p" data-id='{{ $music_post->id }}'></span>
                 <span class="duration{{ $music_post->id }}"></span>
               </div>
             </div>


             <div class="artist-info artist-info-{{$music_post->id }}">
               <span class="ti ti-close pull-right close"></span>
               <div class="header">
                 <img src="/storage/uploads/images/{{  $music_post->user->profile_picture }}" height="50px" width="50px"   alt="">
               </div>
               <div class="details">
                 <strong >@ {{ $music_post->user->username }}</strong><br><br>
                 <a href="{{route("artist-profile",'@'.$music_post->user->username )}}" class="btn btn-success">Details</a>
               </div>
             </div>

           </div>
         @empty
         @endforelse

       </div>
     </div>
     <nav>
       <ul class="pager-custom">
         {{ $music_posts->links() }}
       </ul>
     </nav>
   {{-- <nav>
     <ul class="pager">
       <li><a href="#">Previous</a></li>
       <li><a href="#">Next</a></li>
     </ul>
   </nav> --}}
    <script type="text/javascript">
      $(document).ready(function () {
        var aud=$('audio');
        $.each(aud,function(x,y) {
          $("audio")[x].addEventListener('loadedmetadata',function() {
          var id=$(this).attr("ids");
          var duration_min=Math.floor($('.audio-'+id)[0].duration/60)
          var duration_sec=Math.floor($('.audio-'+id)[0].duration-duration_min * 60)
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
      })
    </script>

@endsection("content")
