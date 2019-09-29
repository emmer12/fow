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
             <h4 class="heading">Contribution</h4>
             @if (session('msg'))
               <div class="alert alert-success" role="alert">
                 <span class="ti ti-control-play"></span>
                 {{ session('msg')}}
               </div>
             @endif
           </div>
           <div class="panel-body">
             @if (count($errors) > 0)
               @foreach ($errors->all() as $error)
                 <div class="alert alert-danger" role="alert">
                   {{ $error }}
                 </div>
               @endforeach

             @endif
             <div class="">
               <div class="well">
                 <div class="alert alert-default" role="alert">
                   <i class="fa fa-share-square" aria-hidden></i>
                   <h4>Click bellow to send a request to contribute to our blog post</h4>
                 </div>
                 <form method="POST" action="{{ route('author.request')}}" enctype="multipart/form-data">
                   {{ csrf_field()}}
                   <input type="hidden" name="type" value="author_request">
                   <button type="submit" class="btn btn-primary">Send Request <span class="ti ti-share"></span> </button>
                 </form>
               </div>
               </div>
             </div>
             {{-- {{ route('author.request')}} --}}
         </div>

       </div>
     </div>
   </div>
@endsection("content")
