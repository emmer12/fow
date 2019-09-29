@extends("layouts.app")
{{-- elevation worship backgreund:#eeeeef --}}
<style media="screen">
.play-time{
  top: -80px;
}
.custom-modal{
  display:none;
  position:absolute;
  top:0px;
  width:100%;
  z-index: 999;
}
.modal-dialog{
//  background: white
}
.team-i-details{
  background: rgba(255, 250, 255,0.9);
  padding: 10px;
  margin: 15px;
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
       {{-- <ul class="list-inline teams-cat-nav">
         <li><a class="btn btn-t active-team"  href="{{ route('music-page')}}">Audio</a></button></li>
         <li><a class="btn btn-t" style="color:inherit" href="{{ route('video-page')}}">Video</a></button></li>
       </ul> --}}
       <div class="row">
        @foreach ($worshipers as $worshiper)
          <div class="col-md-3">
              <a href="{{route('fow.tracks',$worshiper->id)}}">
                <div class="team-div">
                  <img src="/storage/uploads/images/{{$worshiper->profile_picture}}" height="200px" width="100%" alt="">
                   <div class="team-details">
                    <a href="#"><h5> <strong>@ {{$worshiper->username}}</strong></h5></a>
                    <button type="button" class="btn btn-primary show-tracks" data-id="{{ $worshiper->id }}"> <span class="ti ti-link"></span> </button>
                   </div>
                </div>
              </a>
                <div class="custom-modal" id="modal-{{$worshiper->id }}">
                  <div class="modal-dialog"  role="document">
                    <div class="modal-content" style="background: rgba(245, 245, 245,1)">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title text-center">{{ $worshiper->name }}</h4>
                      </div>
                      <div class="modal-body">
                        <div class="">
                          <img src="/storage/uploads/images/{{$worshiper->profile_image}}" height="200px" width="100%" alt="">
                          <hr>
                          <div class="team-i-details">
                            <strong>Worhipper Name</strong><p>{{$worshiper->name}}</p><br>
                            <strong>About Worshipper</strong><p>{{$worshiper->about}}</p><br>
                          </div>
                          <h4 class="heading">({{ count($worshiper->audios) }}) Tracks</h4>
                          @foreach ($worshiper->audios as $music_post)
                            <div class="col-md-12">
                              <div class="m-div">
                                <a href="{{ route("audio-show","$music_post->slug") }}" style="color:inherit">
                                  <img src="/storage/uploads/images/{{ $music_post->preview_image }}" alt="">
                                </a>
                                <audio src="/storage/uploads/audios/{{ $music_post->music }}" ids="{{ $music_post->id }}" class='audio-{{ $music_post->id}}' ></audio>
                                <div class="pull-right" id="title">
                                  <a href="{{ route("audio-show","$music_post->slug") }}" style="color:inherit">
                                    <h4>{{ $music_post->title }}</h4>
                                  </a>
                                </div>
                                <div class="audio-cont" style="position:absolute;right:30px;top:75px" >
                                  <span class="ti ti-control-play audio-p" data-id='{{ $music_post->id }}'></span>
                                  <span class="duration{{ $music_post->id }}"></span>
                                </div>
                              </div>
                            </div>
                          @endforeach
                        </div>
                      </div>
                      <div class="modal-footer">
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            {{-- @endif --}}

          </div>
        @endforeach

         {{-- @foreach ($music_posts as $music_post)
           <div class="col-md-4">
             <div class="m-div">
               <a href="{{ route("audio-show","$music_post->slug") }}" style="color:inherit">
                 <img src="/storage/uploads/images/{{ $music_post->preview_image }}" alt="">
               </a>
               <audio src="/storage/uploads/audios/{{ $music_post->music }}" ids="{{ $music_post->id }}" class='audio-{{ $music_post->id}}' ></audio>
               <div class="pull-right" id="title">
                 <a href="{{ route("audio-show","$music_post->slug") }}" style="color:inherit">
                   <h4>{{ $music_post->title }}</h4>
                 </a>
               </div>
               <div class="audio-cont" style="position:absolute;right:30px;top:75px" >
                 <span class="ti ti-control-play audio-p" data-id='{{ $music_post->id }}'></span>
                 <span class="duration{{ $music_post->id }}"></span>
               </div>
             </div>
           </div>
         @endforeach --}}

       </div>
     </div>
     <br>
     <div class="overlay">

     </div>
     {{-- <nav>
       <ul class="pager-custom">
         {{ $music_posts->links() }}
       </ul>
     </nav> --}}
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
