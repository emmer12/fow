@extends('layouts.app')
@section("content")
  <style media="screen">
    .down-success img+.content{
      display:inline-block;
      width: auto;
      padding: 20px;
    }
    .down-success h2{
      color: #444
    }

  </style>
  <div class="container">
    <div class="well down-success">
      <img src="/images/congrat.png" alt="friends of worship:congrat">
      <div class="content">
        <h2 class="display-3">Thanks For Downloading</h2>
        <h3 class="display-3">{{$title}}</h3>
        <a class="a" href="{{ route('team-page') }}">
          <button type="button" class="btn btn-primary">Download More</button>
        </a>
      </div>
    </div>
  </div>
@endsection("content")
