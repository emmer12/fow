@extends("layouts.app")
{{-- elevation worship backgreund:#eeeeef --}}
<style media="screen">
.m-banner-single{
 background: rgba(0,0,0, 0.5);
 width: 100%;
 padding: 20px;
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
.m-banner-single a{
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
@section("content")
  @if ($video_post->count()<1)
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
            <a href="{{ route('video-page') }}">
              <span class="ti ti-arrow-left"></span>
            </a>
            <video src="/storage/uploads/videos/{{ $video_post->video }} " width="100%" height="230px" controls poster="/storage/uploads/images/{{ $video_post->preview_image }} " class="vid"></video>
            <div class="vid-details">
              <h4>{{ $video_post->title}}</h4>
              <div class="panel panel-default">
                <div class="panel-heading">
                  Discription <span class="opener ti ti-angle-down pull-right"></span>
                </div>
                <div class="panel-body mobile-sub-menu">
                  <p>{{ $video_post->discription }}</p>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  Lyrics <span class="opener ti ti-angle-down pull-right"></span>
                </div>
                <div class="panel-body mobile-sub-menu">
                  <p>
                    @if (strlen($video_post->lyric)==0)
                      Lyric is not available
                    @else
                      {{ $video_post->lyric }}
                    @endif
                  </p>
                </div>
              </div>
              <div class="video-action">
                <button type="button" class="btn btn-success">DOWNLOAD <span class="ti ti-download"></span> </button>
                <span class="ti ti-twitter pull-right"></span><span class="ti ti-facebook pull-right"></span>
              </div>
            </div>
          </div>
        </div>

  @endif
  <br>
@endsection("content")
