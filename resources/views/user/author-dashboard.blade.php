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
        <div class="panel panel-default video-form">
          <div class="panel-heading" id="p-heading">
            <h4><strong> Post To Blog</strong> </h4>
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
            <style media="screen">
              .span{
                position: absolute;
                background: #222;
                padding:5px 10px;
                margin-top:3px;
                border-radius: 10px;
                color: white;
                //display: none;
                right: 0px
              }
              .span::before{
                content: '';
                position: absolute;
                border-left: 5px solid transparent;
                border-right: 5px solid transparent;
                border-top: 10px solid #222;
                transform: rotate(130deg);
                top: -4px;
                left: -3px;
              }
            </style>
            <form method="POST" action="{{ route('create.blog')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
              <fieldset class="form-group">
                <label for="title">Post Title Or Testimoneer Name</label>
                <input value="{{ old('title') }}" type="text" name="title" class="form-control" id="title" placeholder="Title or testimoneer name">
                <span class="span">Please enter blog post title or testifier's name </span>
              </fieldset>

              <fieldset class="form-group">
                <label for="body">Body</label>
                <textarea value="{{ old('body') }}" id="body" name="body" class="form-control" rows="3" cols="50"></textarea>
              </fieldset>
              <input type="hidden" name="id" value="{{Auth::user()->id}}">
              <fieldset class="form-group">
                <select class="form-control" name="category">
                    <option value="">Select Category</option>
                    <option value="News">News</option>
                    <option value="Profiling">Profileing</option>
                    <option value="Goal">Goal</option>
                    <option value="Storyteller">Storyteller</option>
                    <option value="New Song Alert">New song Alert[NSA]</option>
                    <option value="fund-raise">Merchandise</option>
                </select>
              </fieldset>
              <fieldset>
                   <div class="">
                     <input value="{{ old('tags') }}" placeholder='write some tags seperate with comma' type="text" name="tags" class="orm-control" id="tags" >
                   </div>
              </fieldset>
              <fieldset class="form-group">
                <label for="p-image">Preview Image</label>
                <div class="row">
                   <div class="col-lg-4">
                     <input value="{{ old('preview_image') }}" type="file" name="preview_image" class="dropify preview_image" id="p-image" >
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

  <script type="text/javascript">
    $(document).ready(function () {
      $('input').on('focus',function () {
        var parent=$(this).parent();
        parent.find('.span').fadeIn()
      })
      $('input').on('blur',function () {
        var parent=$(this).parent();
        parent.find('.span').fadeOut()
      })
    })
  </script>
@endsection("content")
