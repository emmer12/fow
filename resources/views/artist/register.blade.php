@extends('layouts.app')

@section("content")
  <br>
   <div class="container">
     <div class="row">
       <div class="col-md-3">
       </div>
       <div class="col-md-5">
         <div class="panel panel-default video-form">
           <div class="panel-heading">
             <h4 class="heading">Worshippers Registration</h4>
           </div>
           <div class="panel-body">
             @if (count($errors) > 0)
               @foreach ($errors->all() as $error)
                 <div class="alert alert-danger" role="alert">
                   {{ $error }}
                 </div>
               @endforeach

             @endif
             <form method="POST" action="{{ route('worshipers.store')}}" enctype="multipart/form-data">
               {{ csrf_field() }}
               <fieldset class="form-group">
                 <label for="name">Name</label>
                 <input value="{{ old('name') }}" type="text" name="name" class="form-control" id="name" placeholder="Name">
               </fieldset>
               <fieldset class="form-group">
                 <label for="date">date of birth</label>
                 <input type="date" value="{{ old('d-birth') }}" name="b-date" class="form-control" >
               </fieldset>
               <fieldset class="form-group">
                 <label for="email">Email Address</label>
                 <input value="{{ old('email') }}" type="email" name="email" class="form-control" id="email" placeholder="Email Address">
               </fieldset>
               <fieldset class="form-group">
                 <label for="phoneNo">Phone Number</label>
                 <span>["Google Allo Working"]</span>
                 <input value="{{ old('phoneNo') }}" type="number" name="phoneNo" class="form-control" id="phoneNo" placeholder="Phone Number">
               </fieldset>
               <fieldset class="form-group">
                 <label for="location">Location</label>
                 <input value="{{ old('lyrics') }}" name="location" class="form-control" type="text" placeholder="Enter location" />
               </fieldset>
               <fieldset class="form-group">
                 <label for="location">Brief Discription About Self</label>
                 <textarea class="form-control" value="{{ old('about') }}" name="about" rows="4" cols="40"></textarea>
               </fieldset>
               <fieldset class="form-group">
                 <label for="p-image">Profile Image</label>
                 <div class="row">
                    <div class="col-lg-12">
                      <input value="{{ old('profile_image') }}" type="file" name="profile_image" class="dropify preview_image" id="p-image" >
                    </div>
                  </div>
               </fieldset>
               <fieldset class="form-group">
                 <label for="p-image">Track</label>
                  <span>Please enter your Audio track</span>
                 <div class="row">
                    <div class="col-lg-12">
                      <input value="{{ old('track') }}" type="file" name="track" class="dropify preview_image" id="p-image" >
                    </div>
                  </div>
               </fieldset>
               <button type="submit" class="btn btn-primary">POST</button>
             </form>
           </div>
         </div>

       </div>
     </div>
   </div>
@endsection("content")
