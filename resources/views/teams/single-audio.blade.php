@extends("layouts.app")
{{-- elevation worship backgreund:#eeeeef --}}
<style media="screen">
.m-banner-single{
 background: rgba(0,0,0, 0.5);
 width: 100%;
 padding:10px;
 top: 0px;
 color: white;
 filter: none;
 position: relative;
 margin-top:-200px;
}
.m-banner-single video{
height: 300px;
}
.m-banner-single span{
  cursor: pointer;
  padding: 10px;

}
.m-banner-single .a{
  position:absolute;
  z-index:20;
  font-size:25px;
  color: white;
  font-weight: 700;
  left: -5px;
  top: -80px;
}
.m-banner-single .vid-details{
  background: white;
  color: #636b6f;
  padding: 10px;
}
.video-action span{
  cursor: pointer;
}
.video-action span:nth-child(3){
  color: white;
  background: #4a6ea9;
}
.video-action span:nth-child(2){
  color: white;
  background:#32ddf3;
}
</style>


{{-- var maxlength=120;
 $('.posts').each(function () {
 var mys=$(this).text();
 var id=$(this).attr("data_id")
if($.trim(mys).length>maxlength){
  var news=mys.substring(0,maxlength);
  var removedstr=mys.substring(maxlength,$.trim(mys).length);
  $(this).empty().html(news+'...');
  $(this).append("<a href=article.php?id="+id+" class='btn'>read more..</a>");
}
 });
}); --}}
@section("content")
  @if ($audio_post->count()<1)
    <div class="alert alert-warning" role="alert">
      No Vidio with this name available
    </div>
    <a href="{{ route('home-page')}}"><button type="button" class="btn btn-primary"> <span class="ti ti-arrow-left"></span> Go back To Home </button></a>
    @else
      <div class="">
        <div class="vid-single-banner text-center">
        </div>
        <div class="container">
          <div class="m-banner-single">
            {{-- {{$audio_post->getWorshipper() }} --}}
            <a class="a" href="{{ route('team-page') }}">
              <span class="ti ti-arrow-left"></span>
            </a>
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <div class="vid-details">
                 <div class="artist">
                   <img class="img-thumbnail" width="70px" height="70px"  src="/storage/uploads/images/{{ $artist->profile_picture}}" alt="" >
                   <div class="content">
                     <a href="{{route("artist-profile",'@'.$artist->username )}}">
                     <strong class="text-primary">{{$artist->firstname}} {{$artist->lastname}}</strong>
                     <small style="display:block">@ {{$artist->username}}</small>
                   </div>
                 </a>
                   <hr>
                   <div class="card-title" style="padding:5px;font-weight:700;color:#222">
                     <h4>{{ $audio_post->title}}</h4>
                   </div>
                 </div>
                <img class="" src="/storage/uploads/images/{{ $audio_post->preview_image}}" width="100%" height="300px" alt="">
                <audio  src="/storage/uploads/audios/{{ $audio_post->music }} " class="center-block"  width="100%" height="230px" controls poster="/storage/uploads/images/{{ $audio_post->preview_image }} " class="vid"></audio>
                <h4>Discription</h4>
                <p>{{ $audio_post->discription }}</p>
                <hr>
                <h4>Lyrics</h4>
                <p>
                  @if (strlen($audio_post->lyric)==0)
                    <p class="text-warning">Lyric is not available</p>
                  @else
                    {{ $audio_post->lyric }}
                  @endif
                </p><br>
                  <div class="video-action">
                    <a class="btn btn-success download" data_title="{{$audio_post->slug}}" href="/storage/uploads/audios/{{ $audio_post->music }}" download>DOWNLOAD <span class="ti ti-download"></span> </a>
                  
                    <div class="fb-share-button pull-right"
                          data-size="large"
                          data-href="{{ url()->full() }}"
                          data-layout="button_count">
                    </div>
                  </div>

              </div>
              <div class="col-md-6">

              </div>
            </div>
            </div>
          </div>
        </div>

  @endif
  <br>
@endsection("content")
