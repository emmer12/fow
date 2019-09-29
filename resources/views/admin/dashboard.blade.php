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
             <h4> <strong>Post Videos</strong></h4>
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
             <form method="POST" action="{{ route('admin-storeVideo') }}" enctype="multipart/form-data">
               {{ csrf_field() }}
               <fieldset class="form-group">
                 <label for="title">Video Title</label>
                 <input value="{{ old('title') }}" type="text" name="title" class="form-control" id="title" placeholder="Video Title ">
               </fieldset>
               <fieldset class="form-group">
                 <label for="formGroupExampleInput2">Video Discription</label>
                 <textarea value="{{ old('discription') }}" name="discription" class="form-control" rows="3" cols="50"></textarea>
               </fieldset>
               <fieldset class="form-group">
                 <label for="formGroupExampleInput2">Lyrics</label>
                 <textarea value="{{ old('lyrics') }}" name="lyrics" class="form-control" rows="6" cols="60"></textarea>
               </fieldset>
               <fieldset class="form-group">
                 <label for="p-image">Preview Image</label>
                 <div class="row">
                    <div class="col-lg-4">
                      <input value="{{ old('preview_image') }}" type="file" name="preview_image" class="dropify preview_image" id="p-image" >
                    </div>
                  </div>
               </fieldset>
               <fieldset class="form-group">
                 <label for="video">Video</label>
                 <div class="row">
                    <div class="col-lg-4">
                      <input value="{{ old('video') }}" type="file" name="video" id="video" class="dropify video" >
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
