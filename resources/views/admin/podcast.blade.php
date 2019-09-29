@extends('layouts.app')

@section("content")
  @include('inc/drawer-admin')
  <br>
   <div class="container">
     <div class="row">
       <div class="col-md-3">
       </div>
       <div class="col-md-9">
         <div class="pull-right">
           <button type="button" class="btn btn-default"><a href="#">Total Post <span class="label label-pill label-success"> {{count($podcasts)}}</span> </a></button>
           @if (@isset($create) || @isset($edit) )
             <button type="button" class="btn btn-default"><a href="{{route("admin.dashboard.podcast",[null,null])}}">Back</a></button>
             @else
             <button type="button" class="btn btn-success"><a href="{{route("podcast.action",['action'=>'create','id'=>'add'])}}">Add</a></button>
           @endif
         </div>
         <hr>

         @if (@isset($create))
           <div class="div podcast">
             <div class="">

               <div class="add-epic well">
                 <button type="button" class="btn btn-primary">Add New Episode <span class="ti ti-plus"></span> </button>
               </div>
               <div class="podcast-e-f">
                 <form class="" action="{{route('create.epic')}}" method="post">
                   {{ csrf_field() }}
                   <fieldset class="form-group">
                     <label for="add-episode">New Episode</label>
                     <input value="{{ old('new-epic') }}" type="text" name="epic_title" class="form-control" id="new-epic" placeholder="Episode Title ">
                   </fieldset>
                   <button type="submit" class="btn btn-success">Add</button>
                 </form>
               </div>
               <hr>
               <div class="panel panel-default">
                 <div class="panel-heading">
                    <span class="glyphicon glyphicon-plus"></span> Create New Podcast
                 </div>
                 <div class="panel-body">
                   <form class="" action="{{route("create.podcast")}}" method="post" enctype="multipart/form-data">
                     {{ csrf_field() }}
                     <fieldset class="form-group">
                       <label for="title">Title</label>
                       <input value="{{ old('title') }}" type="text" name="title" class="form-control" id="title" placeholder="Podcast Title ">
                     </fieldset>
                     <fieldset class="form-group">
                       <label for="description">Podcast Description</label>
                       <textarea value="{{ old('discription') }}" name="description" class="form-control" rows="3" cols="50"></textarea>
                     </fieldset>
                     <fieldset class="form-group">
                       <label for="category">Select Episode</label>
                       <select class="form-control" name="episode">
                         <option value="1.1">Single Podcast</option>
                         @foreach ($episodes as $episode)
                           <option value="{{$episode->id}}">{{$episode->epic_title}}</option>
                         @endforeach
                       </select>
                     </fieldset>
                     <fieldset class="form-group">
                       <label for="author">Author</label>
                       <input value="{{ old('author') }}" type="text" name="author" class="form-control" id="author" placeholder="Author ">
                     </fieldset>
                     <fieldset class="form-group">
                       <label for="author_pic">Author Image</label>
                       <div class="row">
                          <div class="col-lg-4">
                            <input value="{{ old('author_pic') }}" type="file" name="author_pic" class="dropify preview_image" id="author_pic" >
                          </div>
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

                     <fieldset class="form-group">
                       <label for="podcast">Podcast file</label>
                       <div class="row">
                          <div class="col-lg-4">
                            <input value="{{ old('podcast') }}" type="file" name="podcast" class="dropify preview_image" id="podcast" >
                          </div>
                        </div>
                     </fieldset>
                     <button type="submit" class="btn btn-success">Create</button>
                   </form>
                 </div>
               </div>

             </div>
           </div>
         @elseif (@isset($edit))

           <div class="div podcast">
               <div class="panel panel-default">
                 <div class="panel-heading">
                  <span class="glyphicon glyphicon-pencil"></span> Edit Podcast
                 </div>
                 <div class="panel-body">
                   @if (count($errors) > 0)
                     @foreach ($errors->all() as $error)
                       <div class="alert alert-danger" role="alert">
                         {{ $error }}
                       </div>
                     @endforeach
                   @endif
                   <form class="" action="{{route("podcast.update",$podcast->id)}}" method="post" enctype="multipart/form-data">
                     {{ csrf_field() }}
                     {{ method_field("PATCH") }}
                     <fieldset class="form-group">
                       <label for="title">Title</label>
                       <input value="{{$podcast->title}}" type="text" name="title" class="form-control" id="title" placeholder="Podcast Title ">
                     </fieldset>
                     <fieldset class="form-group">
                       <label for="description">Podcast Description</label>
                       <textarea value="{{ old('discription') }}" name="description" class="form-control" rows="3" cols="50">{{$podcast->discription}}</textarea>
                     </fieldset>
                     <fieldset class="form-group">
                       <label for="category">Select Episode</label>
                       <select class="form-control" name="episode">
                         <option value="{{$podcast->id}}">{{ $podcast->episode['epic_title'] }}</option>
                         @foreach ($episodes as $episode)
                           <option value="{{$episode->id}}">{{$episode->epic_title}}</option>
                         @endforeach
                       </select>
                     </fieldset>
                     <fieldset class="form-group">
                       <label for="author">Author</label>
                       <input value="{{ $podcast->author }}" type="text" name="author" class="form-control" id="author" placeholder="Author ">
                     </fieldset>
                     <fieldset class="form-group">
                       <label for="author_pic">Author Image</label>
                       <div class="row">
                          <div class="col-lg-4">
                            <input value="{{ old('author_pic') }}" type="file" name="author_pic" class="dropify preview_image" id="author_pic" >
                          </div>
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

                     <fieldset class="form-group">
                       <label for="podcast">Podcast file</label>
                       <div class="row">
                          <div class="col-lg-4">
                            <input value="{{ old('podcast') }}" type="file" name="podcast" class="dropify preview_image" id="podcast" >
                          </div>
                        </div>
                     </fieldset>
                     <button type="submit" class="btn btn-success">Update</button>
                   </form>
                 </div>
               </div>

             </div>
           </div>

           @else
             <div class="div product">
               <div class="panel panel-default">
                 <div class="panel-heading">
                  <span class="glyphicon glyphicon-list"></span>  Podcast Listing
                 </div>
                 <div class="panel-body">
                     <div class="table-responsive">
                       <table class="table table-bordered table-hover">
                         <thead>
                           <tr>
                             <th class="text-center">images</th>
                             <th>Podcast Title</th>
                             <th class="text-right">Author</th>
                             <th class="text-right">Episode Topic</th>
                             <th class="text-right">Action</th>
                           </tr>
                         </thead>
                         <tbody>
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

                            @foreach ($podcasts as $podcast)
                              <tr class="parent{{$podcast->id}}">
                                <td class="text-center"><img class="" src="/storage/uploads/images/{{ $podcast->preview_image}}" width="100px" height="70px" alt="{{ $podcast->product_title}}"></td>
                                <td>{{ $podcast->title}}</td>
                                <td class="text-right">{{ $podcast->author}}</td>
                                <td class="text-right">{{ $podcast->episode['epic_title']}}</td>
                                <td width="15%" class="text-right"><a class="btn btn-primary edit" href="{{route("podcast.action",['edit',$podcast->id])}}"><span class="ti ti-pencil"></span> </a> <a  href="#" data-id="{{$podcast->id}}" class="btn btn-danger edit delete" data-item="podcast"><span class="ti ti-trash"></span> </a></td>
                              </tr>
                            @endforeach
                         </tbody>
                       </table>
                     </div>
                 </div>
               </div>
         @endif


       </div>
     </div>
   </div>
 </div>
@endsection("content")
