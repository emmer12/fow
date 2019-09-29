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
           <div class="panel-heading" id="p-heading">
             <h4><strong>Volunteers</strong></h4>
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
              @if (count($volunteers) < 1)
                <div class="alert alert-info" role="alert">
                  No Voluntered Users
                </div>
               @else
                 <h5>{{ count($volunteers) }} has Voluntered</h5>

                 <ul class="list-group">
                @foreach ($volunteers as $volunteer)
                    <li class="list-group-item" style="margin:5px">{{ $volunteer->firstname}} <span style="background:#ddd;padding:10px;border-radius:100%" class="opener-multi ti ti-angle-down pull-right" data-id="{{ $volunteer->id }}"></span> </li>
                    <div class="mobile-sub-menu mobile-sub-menu{{$volunteer->id}}">
                      <div class="text-center">
                        <img src="/images/testimonial.jpg"   alt="">
                        <hr>
                        <strong>Firstname::</strong>{{ $volunteer->firstname}}<br>
                        <strong>Lastname::</strong>{{ $volunteer->lastname}}<br>
                        <strong>Email Address::</strong> <a href="mail:{{ $volunteer->email}}">{{ $volunteer->email}}</a><br>
                        <strong>Phone Number::</strong> <a href="tel:{{ $volunteer->phoneNo}}">{{ $volunteer->phoneNo}}</a> <br>
                        <strong>Interested Role::</strong>{{ $volunteer->role}}<br>
                        <strong> Gender::</strong>{{ $volunteer->gender}}<br>
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
