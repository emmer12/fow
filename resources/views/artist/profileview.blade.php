@extends("layouts.app")
{{-- elevation worship backgreund:#eeeeef --}}

@section("content")
   <div class="">
     <div class="m-banner text-center">
       <div class="m-banner-c">
         <span class="glyphicon glyphicon-user "></span>
         <h4>Profile</h4>
       </div>
     </div>
   </div>
   <br>
     <div class="container">
       <div class="artist-profile">
         <img src="/storage/uploads/images/{{$artist->profile_picture}}" class="img-thumbnail top-img" width="100px" height="100px" alt="">
         <div class="row">
           <div class="col-md-8">
             <div class="well" >
               <div class="text-center">
                 <img src="/storage/uploads/images/{{$artist->profile_picture}}" alt="" class="pro-img" width="350px" height="200px">
               </div>
               <hr>
               <ul class="list-group">
                 <h5><b>Fullname</b></h5>
                 <li> {{$artist->firstname}} {{$artist->lastname}}</li>
                 <h5><b>Username</b></h5>
                 <li>{{$artist->username}}</li>
                 <h5><b>Contact</b></h5>
                 <li><span class="ti ti-phone"></span>{{$artist->phoneNo}}</li>
                 <h5><b>About</b></h5>
                 <li>{{$artist->bio }} </li>
                 <hr>
                 <h5><b>Follow</b></h5>
                 <ul class="list-inline">
                   @if ($artist->facebook_link)
                     <li> <span class="ti ti-facebook">Follow</span> </li>
                   @endif
                   @if ($artist->twitter_username)
                     <li> <span class="ti ti-twitter"> Tweet</span> </li>
                   @endif
                 </ul>
               </ul>
                <hr>

                <div class="well">
                  <button type="button" class="btn btn-primary pop">All Tracks</button>
                </div>
                <div class="pop-model">
                   <div class="header">
                     <span class="ti ti-close pull-right close"></span>
                     <h4>({{count($artist->audios)}}) Track</h4>
                   </div><br>
                   <div class="body">
                     @foreach ($artist->audios as $music_post)
                       <div class="pop-dev player">
                         <a href="{{ route("audio-show","$music_post->slug") }}" style="color:inherit">
                           <img src="/storage/uploads/images/{{ $music_post->preview_image }}" alt="">
                         </a>
                         <audio src="/storage/uploads/audios/{{ $music_post->music }}" ids="{{ $music_post->id }}" class='audio-{{ $music_post->id}}' ></audio>
                         <div id="content">
                           <a class="audeo-title" href="{{ route("audio-show","$music_post->slug") }}" style="color:inherit">
                             <h4>{{ $music_post->title }}</h4>
                           </a>
                           <div class="audio-cont" style="position:absolute;right:20px;top:65px" >
                             <span class="ti ti-control-play audio-p" data-id='{{ $music_post->id }}'></span>
                             <span class="duration{{ $music_post->id }}"></span>
                           </div>
                         </div>
                       </div><br>
                       @endforeach
                   </div>
                </div>

             </div>
           </div>
           <div class="col-md-4">
             {{-- <div class="achived-list">
               <a href="#">
               <img src="/images/banner-2.jpg" width="100px" height="100px" alt="">
               <div class="content">
                 <strong class="text-primary">This is the title of the song This is the title of the song</strong>
               </div>
             </a>
             </div>

             <div class="achived-list">
               <a href="#">
               <img src="/images/banner-2.jpg" width="100px" height="100px" alt="">
               <div class="content">
                 <strong class="text-primary">This is the title of the song This is the title of the song</strong>
               </div>
             </a>
             </div> --}}
           </div>
         </div>
       </div>

       </div>
       <div class="overlay">

       </div>




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
