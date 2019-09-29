@extends('layouts.app')

@section("content")
  <div class="podcast-player">
    <div class="podcast-container">
      <audio class="p-play" style="color:#111" src="/storage/uploads/podcasts/{{$podcast->podcast}}" controls></audio>
      <h4 class="main-title">{{$podcast->title}}</h4>
      <img class="podcast-preview" src="/storage/uploads/images/{{$podcast->preview_image}}" height="100%" width="100%" alt="...">
      <div class="podcast-footer">
        <div class="details">
          <div class="p-info-d">
            {{$podcast->discription}}
          </div>
            <img src="/storage/uploads/images/{{$podcast->author_pic}}" width="100%" height="100px" alt="friends Of Worship">
            <div class="dis">
              <b class="main-author">{{$podcast->author}}</b>
          </div>
        </div>
        <div class="controls">
        <ul>
          <li> <span class="ti ti-control-play main-p-play"></span> </li>
          <li> <span class="ti ti-info p-info" title="Podcast Info"></span> </li>
          <style media="screen">
            .p-info-d{
              padding: 10px;
              border-radius: 3px;
              color: white;
              bottom: 100px;
              position:relative;
              width: 100%;
              height: 100px;
              overflow: scroll;
              background: #222;
              display:none
            }
          </style>

          <li><a style="font-size:20px;" class="download-p" href="/storage/uploads/podcasts/{{$podcast->podcast}}" download><span class="ti ti-download"></span></a></li>
        </ul>
      </div>
      </div>

    </div>
  </div>
  <div class="container">
    <div class="row">
      @foreach ($episodes as $episode)
        <a href="{{route("show.details",[$episode->podcast_epic_id,$episode->slug])}}">
          <div class="col-md-4 podcast-list">
            <img src="/storage/uploads/images/{{$episode->preview_image}}" width="100%" height="100px" alt="friends Of Worship">
            <div class="details">
              <h4> <a href="#">{{$episode->title}}</a></h4>
              <h5><b>{{$episode->author}}</b> </h5>
              <span data-podcast="/storage/uploads/podcasts/{{$episode->podcast}}" data-title="{{$episode->title}}" data-author="{{$episode->author}}" data-dp="/storage/uploads/images/{{$episode->preview_image}}" class="ti ti-control-play podcast-play"></span>
            </div>
          </div>
        </a>
      @endforeach

    </div>
  </div>
  <br><br>

  {{-- <div class="container">
    <div class="row">
      <style media="screen">
        .new-readmore{
          position: relative;
          max-height: 100px;
          overflow: hidden;
          background: linear-gradient(to bottom,transparent,grey);
          color: grey;
        }
      </style>
      <div class="col-md-4 new-readmore">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
      <div class="col-md-4">
        One of three columns
      </div>
      <div class="col-md-4">
        One of three columns
      </div>
    </div>
  </div> --}}
  <br><br>

@endsection("content")
