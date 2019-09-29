@extends("layouts.app")
{{-- elevation worship backgreund:#eeeeef --}}
<style media="screen">
   .list-post{
     cursor: pointer;
   }
</style>
@section("content")
  @include('inc/drawer')
  @include('inc/messages')
  <br>
   <div class="container">
     <div class="row">
       <div class="col-md-3">
       </div>
       <div class="col-md-9">
         <div class="panel panel-default video-form">
           <div class="panel-heading" id="p-heading">
             <h4> <strong>Video Management</strong></h4>
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
              @if (count($videos) < 1)
                <div class="alert alert-info" role="alert">
                  No Video Posts
                </div>
               @else
                 <h5>{{ count($videos) }} Video post(s)</h5>

                 <ul class="list-group">
                @foreach ($videos as $video)
                    <li class="list-group-item list-post " style="margin:5px">{{ $video->title}} <span style="background:#ddd;padding:10px;border-radius:100%" class="delete_post ti ti-close pull-right" data-table="VideoPost" data-id="{{ $video->id }}" ></span> </li>
                @endforeach
              </ul>
              @endif
            </div>
           </div>
         </div>

       </div>
     </div>

     <div class="row">
       <div class="col-md-3">
       </div>
       <div class="col-md-9">
         <div class="panel panel-default video-form">
           <div class="panel-heading">
             <h4>Audio Management</h4>
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
              @if (count($audios) < 1)
                <div class="alert alert-info" role="alert">
                  No Audio post(s)
                </div>
               @else
                 <h5>{{ count($audios) }} Audio posts</h5>

                 <ul class="list-group">
                @foreach ($audios as $audio)
                    <li class="list-group-item list-post" style="margin:5px">{{ $audio->title}} <span style="background:#ddd;padding:10px;border-radius:100%" class="delete_post ti ti-close pull-right" data-table="MusicPost" data-id="{{ $audio->id }}"></span> </li>
                @endforeach
              </ul>
              @endif
            </div>
           </div>
         </div>

       </div>
     </div>

     <div class="row">
       <div class="col-md-3">
       </div>
       <div class="col-md-9">
         <div class="panel panel-default video-form">
           <div class="panel-heading">
             <h4>Blog Management</h4>
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
              @if (count($blogs) < 1)
                <div class="alert alert-info" role="alert">
                  No Blog Post(s)
                </div>
               @else
                 <h5>{{ count($blogs) }} Blog post(s)</h5>

                 <ul class="list-group">
                @foreach ($blogs as $blog)
                    <li class="list-group-item list-post" style="margin:5px">{{ $blog->title}} <span style="background:#ddd;padding:10px;border-radius:100%" class="delete_post ti ti-close pull-right" data-table="BlogPosts" data-id="{{ $blog->id }}"></span> </li>
                @endforeach
              </ul>
              @endif
            </div>
           </div>
         </div>

       </div>
     </div>

     <div class="row">
       <div class="col-md-3">
       </div>
       <div class="col-md-9">
         <div class="panel panel-default video-form">
           <div class="panel-heading">
             <h4>Product Management</h4>
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
              @if (count($products) < 1)
                <div class="alert alert-info" role="alert">
                  No Product Post(s)
                </div>
               @else
                 <h5>{{ count($products) }} Product Post(s)</h5>

                 <ul class="list-group">
                @foreach ($products as $product)
                    <li class="list-group-item list-post" style="margin:5px">{{ $product->product_title}} <span style="background:#ddd;padding:10px;border-radius:100%" class="delete_post ti ti-close pull-right" data-table="Product" data-id="{{ $product->id }}"></span> </li>
                @endforeach
              </ul>
              @endif
            </div>
           </div>
         </div>

       </div>
     </div>

   </div>
   <script type="text/javascript">
       $(document).ready(function(){
         $('.delete_post').click(function() {
           var shouldDelete=confirm("Are Sure You Want To Delete this post");
           if (shouldDelete) {
             var currentElement=$(this);
             var table=$(this).attr('data-table');
             var id=$(this).attr('data-id');
             var urls="{{route('post.destroy')}}";
             $.ajax({
               url:urls,
               method:'POST',
               data:{'id':id,'table':table,'_token':'{{ csrf_token() }}'},
               success:function(data) {
                 if (data.success) {
                   $('.custum-msg-success').addClass("animated fadeInRight").fadeIn().text(data.success)
                   currentElement.parent().css({"background":"#ccc"})
                   currentElement.parent().addClass("animated Shake").fadeOut(3000)
                   setTimeout(function() {
                     $('.custum-msg-success').removeClass("animated fadeInRight")
                     $('.custum-msg-success').addClass("animated fadeOutRight")
                   },7000)
                 }
               }
             })
           }else {
             return
           }
         })
     })

     </script>
@endsection("content")
