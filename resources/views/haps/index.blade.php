
@extends("layouts.app")
{{-- elevation worship backgreund:#eeeeef --}}

@section("content")
   <div class="container">
     <h4 class="heading">Latest Haps</h4>
     <div class="row hasModel">
       @if (count($haps) > 0)
         @foreach ($haps as $hap)
           <div class="col-md-4 " >
             <div class="card blog-design" style="margin-left:3px;">
               @if ($hap->display_pic=="default.jpg")
                 heool
                 @else
                   <a href="{{$hap->link}}" target="_blank" >
                     <img class="card-img top" src="/storage/uploads/images/{{ $hap->display_pic }}" width="100%" height="250px" alt="Card image cap">
                   </a>
               @endif
               <div class="card-block">
                 <a href="#">
                   <h4 class="card-title">{{$hap->title}}</h4>
                 </a>
                 <div class="blog-info-div">
                   <p class="card-text">{{ $hap->body }}</p>
                   <span><i class="ti ti-time"> {{ $hap->date }} {{ $hap->time}}</i></span>
                   <span class="pull-right"> <b>&#x20A6; {{$hap->price}}</b> </span>
                 </div>
                 <hr>
                 <button type="button" class="btn btn-default show-model" data-id="{{$hap->id}}"><span class="ti ti-eye"></span> View Details</button>
                 <a href="{{$hap->link}}" target="_blank" class="btn btn-success pull-right"> Book Now</a>
               </div>
             </div>
           </div>


           <div id="myModal" style="overflow:scroll" class="modal modal-custom-dynamic modal{{$hap->id}}"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
             <div class="modal-dialog modal-lg" >
               <div class="modal-content">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                   <h4 class="modal-title" id="myModalLabel">{{$hap->title}}</h4>
                 </div>
                 <div class="modal-body">
                   <div class="" style="height:150px;width:100%">
                     <a href="{{$hap->link}}" target="_blank" >
                       <img class="card-img top" src="/storage/uploads/images/{{ $hap->display_pic }}" width="100%" height="250px" alt="Card image cap">
                     </a>
                   </div>
                   <h4><span class="ti ti-layout-grid2"></span> Description</h4>
                   {{ $hap->description }}
                   <hr>
                   <h4><span class="ti ti-location-pin"></span> Venue</h4>
                   {{$hap->venue}}
                   <hr>
                   <h4><span class="ti ti-time"></span> date & time</h4>
                   {{ $hap->date }} {{ $hap->time}}
                   <hr>
                   <h4><span class="ti ti-money"></span> Price</h4>
                   <b>&#x20A6; {{$hap->price}}</b>
                 </div>
                 <div class="modal-footer">
                   <a href="{{$hap->link}}" target="_blank" class="btn btn-success">Book now</a>
                 </div>
               </div>
             </div>
           </div>

       @endforeach
         @else
           <div class="alert alert-info" role="alert">
             No Haps Found
           </div>
       @endif



     </div>
     <nav>
       <ul class="pager">
         {{ $haps->links() }}
       </ul>
     </nav>
   </div>
   <div class="overlay"></div>
@endsection("content")
