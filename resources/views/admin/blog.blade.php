@extends("layouts.app")
{{-- elevation worship backgreund:#eeeeef --}}
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

@section("content")
  @include('inc/drawer-admin')
  <br>
   <div class="container">
     <div class="row">
       <div class="col-md-3">
       </div>
       <div class="col-md-9">
         <div class="pull-right">
           <button type="button" class="btn btn-default"><a href="#">Total Post <span class="label label-pill label-success">{{count($blogposts)}}</span> </a></button>
           @if (@isset($create) || @isset($edit) )
             <button type="button" class="btn btn-default"><a href="{{route("admin.dashboard.blog")}}">Back</a></button>
             @else
             <button type="button" class="btn btn-success"><a href="{{route("blog.action",['action'=>'create','id'=>'add'])}}">Add</a></button>
           @endif
         </div>
         <hr>

        @if (@isset($create))
           <div class="panel panel-default">
             <div class="panel-heading">
              <span class="glyphicon glyphicon-shopping-cart"></span> Create Product
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
                       @foreach ($categories as $category)
                         <option value="{{$category->name}}">{{$category->name}}</option>
                       @endforeach
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
          @elseif (@isset($edit))
            <div class="panel panel-default">
              <div class="panel-heading">
               <span class="glyphicon glyphicon-list"></span> Editing
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

               <form method="POST" action="{{ route('storeBlog.update',$blog->id)}}" enctype="multipart/form-data">
                 {{ csrf_field() }}
                 {{ method_field('PATCH') }}
                 <fieldset class="form-group">
                   <label for="title">Post Title Or Testimoneer Name</label>
                   <input value="{{ $blog->title }}" type="text" name="title" class="form-control" id="title" placeholder="Title or testimoneer name">
                   <span class="span">Please enter blog post title or testifier's name </span>
                 </fieldset>

                 <fieldset class="form-group">
                   <label for="body">Body</label>
                   <textarea value="{{ $blog->body }}" id="body" name="body" class="form-control" rows="3" cols="50">{{ $blog->body }}</textarea>
                 </fieldset>
                 <input type="hidden" name="id" value="{{Auth::user()->id}}">
                 <fieldset class="form-group">
                   <select class="form-control" name="category">
                       <option value="{{ $blog->category }}">{{ $blog->category }}</option>
                       @foreach ($categories as $category)
                         <option value="{{$category->name}}">{{$category->name}}</option>
                       @endforeach
                   </select>
                 </fieldset>
                 <fieldset>
                      <div class="">
                        <input value="{{ $blog->tags }}" placeholder='write some tags seperate with comma' type="text" name="tags" class="orm-control" id="tags" >
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
                 <button type="submit" class="btn btn-primary">Update</button>
               </form>
              </div>
            </div>
          @else
            <div class="div product">
              <div class="panel panel-default">
                <div class="panel-heading">
                 <span class="glyphicon glyphicon-list"></span>  Blog listing
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
                    <div class="table-responsive">
                      <table class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th class="text-center">images</th>
                            <th>Blog Title</th>
                            <th class="text-right">Tags</th>
                            <th class="text-right">Author</th>
                            <th>Status</th>
                            <th colspan="2" class="text-right">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                           @foreach ($blogposts as $blogpost)
                             <tr class="parent{{$blogpost->id}}">
                               <td class="text-center"><img class="" src="/storage/uploads/images/{{ $blogpost->preview_image}}" width="100px" height="70px" alt="{{ $blogpost->product_title}}"></td>
                               <td>{{ $blogpost->title}}</td>
                               <td class="text-right">{{ $blogpost->tags}}</td>
                               <td class="text-right">{{ $blogpost->qty}}</td>
                               <td>
                                 @if ($blogpost->status)
                                   <button type='button' class="btn btn-danger permit" data-id='{{$blogpost->id}}' action='Disapprove' data-item='blog'>Disapprove</button>
                                    @else
                                   <button type='button' class="btn btn-success permit" data-id='{{$blogpost->id}}' action='Approve' data-item='blog'>Approve</button>
                                 @endif
                               </td>
                               <td width="15%" class="text-center"><a class="btn btn-primary edit" href="{{route("blog.action",['action'=>'edit','id'=>$blogpost->id])}}"><span class="ti ti-pencil"></span> </a> | <a  href="#" data-id="{{$blogpost->id}}" class="btn btn-danger edit delete" data-item="blog"><span class="ti ti-trash"></span> </a> </td>
                             </tr>
                           @endforeach
                        </tbody>
                        <tfoot>
                          <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan=6>
                              <ul class="pager">
                                {{ $blogposts->links() }}
                              </ul>
                         </td>
                        </tr>
                        </tfoot>
                      </table>
                    </div>
                </div>
              </div>
        @endif


           </div>
         </div>


       </div>
     </div>
   </div>
@endsection("content")
