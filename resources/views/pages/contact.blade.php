@extends("layouts.app")
{{-- elevation worship backgreund:#eeeeef --}}
<style media="screen">
  form{
    background: white;
    padding:20px;
    border:1px solid #eee;
  }
</style>
@section("content")
  <div class="container">
    <div class="row">
      <h4 class="heading text-center">Contact</h4>
      <div class="col-md-6" >
  	     <div class="text-center">
           <a href="mailto:hello@friendsofworship.com" class="btn btn-success">Send Us Mail <i class="ti ti-mail"></i> </a>
         </div>
  	</div>
      <div class="col-md-6">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d63321.33009770275!2d5.12573268072074!3d7.288178792707481!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sng!4v1547130127221" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>

    </div>
  </div>
@endsection("content")
