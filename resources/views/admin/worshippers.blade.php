@extends("layouts.app")
{{-- elevation worship backgreund:#eeeeef --}}
<style media="screen">

</style>
@section("content")
  @include('inc/drawer')

  <br>
   <div class="container">
     <div class="row">
       <div class="col-md-3">
       </div>
       <div class="col-md-9">
         <div class="panel panel-default video-form">
           <div class="panel-heading " id="p-heading">
             <h4 class=""> <strong>Worshippers</strong> </h4>
           </div>
           <div class="panel-body">
             @if (session('success'))
               <div class="alert alert-success" role="alert">
                {{ session('success')}}
               </div>
             @endif
             @if (count($errors) > 0)
               @foreach ($errors->all() as $error)
                 <div class="alert alert-danger" role="alert">
                   {{ $error }}
                 </div>
               @endforeach

             @endif
            <div class="">
              @if (count($worshipers) < 1)
                <div class="alert alert-info" role="alert">
                  No Worshippers Yet
                </div>
               @else
                 <h5>{{ count($worshipers) }} has Worshippers</h5>

                 <ul class="list-group">
                @foreach ($worshipers as $worsipper)
                    <li class="list-group-item" style="margin:5px">{{ $worsipper->name}} <span style="background:#ddd;padding:10px;border-radius:100%" class="opener-multi ti ti-angle-down pull-right" data-id="{{ $worsipper->id }}"></span> </li>
                    <div class="mobile-sub-menu mobile-sub-menu{{$worsipper->id}}">
                      <div class="text-center">
                        <img src="/storage/uploads/images/{{ $worsipper->profile_image}}" class="avater"  alt="">
                        <hr>
                        <strong>Name::</strong>{{ $worsipper->name}}<br>
                        <strong>Email Address::</strong> <a href="mail:{{ $worsipper->email}}">{{ $worsipper->email}}</a><br>
                        <strong>Phone Number::</strong> <a href="tel:{{ $worsipper->phoneNo}}">{{ $worsipper->phoneNo}}</a> <br>
                        <strong>Location::</strong>{{ $worsipper->location}}<br>
                        <strong>Date of birth::</strong>{{ $worsipper->b_date}}<br>
                        <strong> about::</strong>{{ $worsipper->about}}<br>
                        <hr>
                        <h4>Track</h4>
                        <audio src="/storage/uploads/audios/{{ $worsipper->track}}" controls preload='auto'></audio>
                      </div>
                    </div>
                @endforeach
              </ul>
              @endif
            </div>
           </div>
         </div>

       </div>
     </div>
   </div>
@endsection("content")
