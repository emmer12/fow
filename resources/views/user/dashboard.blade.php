@extends("layouts.app")
{{-- elevation worship backgreund:#eeeeef --}}
<style media="screen">

</style>
@section("content")
  @include('inc/drawer-user')
  <br>
   <div class="container">
     <div class="row">
       <div class="col-md-3">
       </div>
       <div class="col-md-9">
          <div class="jumbotron">
            <h2 class="display-1 wow fadeInUp">You are welcome {{ Auth::user()->firstname }} {{Auth::user()->lastname}} </h2>
            <p class="lead">.</p>
            <hr class="m-y-md">
            <p class="wow fadeInUp">You can now beging to post your songs,books in pdf format,your article etc..Plese do well by complete your profile settings .</p>
            <p class="lead wow fadeInUp">
              <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </p>
          </div>
       </div>
     </div>
   </div>
@endsection("content")
