@extends('layouts.app')

@section("content")
  <div class="">
    <div class="pod-banner text-center">
      <div class="m-banner-c">
        <span class="glyphicon glyphicon-plus"></span>
        <h4>PODCAST</h4>
      </div>
    </div>
  </div>
  <br>
  <div class="container">
    <div class="row">
      @forelse ($groups as $group)
        @if ($group[0]->podcast_epic_id==1.1)
          <a href="{{route("show.details",[$group[0]->podcast_epic_id,$group[0]->slug])}}">
            <div class="col-md-4 podcast-list">
              <img src="/storage/uploads/images/{{$group[0]->preview_image}}" width="100%" height="100px" alt="friends Of Worship">
              <div class="details">
                <h4> <a href="{{route("show.details",[$group[0]->podcast_epic_id,$group[0]->slug])}}">This is the title say it again and again</a></h4>
                <b>{{$group[0]->author}}</b>
                <a href="{{route("show.details",[$group[0]->podcast_epic_id,$group[0]->slug])}}"><span class="ti ti-angle-right"></span></a>
              </div>
            </div>
          </a>
           @else
             <a href="{{route("show.details",[$group[0]->podcast_epic_id,$group[0]->slug])}}">
               <div class="col-md-4 podcast-list p-group">
                 <img src="/storage/uploads/images/{{$group[0]->preview_image}}" width="100%" height="100px" alt="friends Of Worship">
                 <div class="details">
                   <h4> <a href="{{route("show.details",[$group[0]->podcast_epic_id,$group[0]->slug])}}">This is the title say it again and again</a></h4>
                   <b>{{$group[0]->author}}</b>
                   <a href="{{route("show.details",[$group[0]->podcast_epic_id,$group[0]->slug])}}"><span class="ti ti-angle-right"></span></a>
                 </div>
               </div>
             </a>
        @endif
      @empty
        <div class="alert alert-info" role="alert">
          No Post Found
        </div>
      @endforelse

    </div>
  </div>
  <br><br>
  {{-- <ul class="list-group">
  </ul> --}}
@endsection("content")
