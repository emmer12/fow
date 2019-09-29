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
           <button type="button" class="btn btn-default"><a href="#">Total Post<span class="label label-pill label-success">{{count($audios)}}</span> </a></button>
           @if (@isset($create) || @isset($edit) )
             <button type="button" class="btn btn-default"><a href="{{route("admin.dashboard.audio")}}">Back</a></button>
             @else
             <button type="button" class="btn btn-success"><a href="{{route("audio.action",['action'=>"create","id"=>'add'])}}">Add</a></button>
           @endif
         </div>
         <hr>

         @if (@isset($create))
           <div class="panel panel-default video-form">
             <div class="panel-heading" id="p-headg">
               <span class="glyphicon glyphicon-plus"></span> Create Audio
             </div>
             <div class="panel-body">
                 <form method="POST" action="{{ route('admin-storeAudio')}}" enctype="multipart/form-data">
                   {{ csrf_field() }}
                   <fieldset class="form-group">
                     <label for="title">Audio Title</label>
                     <input value="{{ old('title') }}" type="text" name="title" class="form-control" id="title" placeholder="Audio Title ">
                   </fieldset>
                   <fieldset class="form-group">
                     <label for="discription">Audio Discription</label>
                     <textarea value="{{ old('discription') }}" name="discription" class="form-control" rows="3" cols="50"></textarea>
                   </fieldset>
                   <fieldset class="form-group">
                     <label for="lyrics">Lyrics</label>
                     <textarea value="{{ old('lyrics') }}" name="lyrics" class="form-control" rows="6" cols="60"></textarea>
                   </fieldset>
                   <fieldset class="form-group">
                     <label for="artist_name">Airtist Name</label>
                     <input value="{{ old('artist_name') }}" type="text" name="artist_name" class="form-control" id="artist_name" placeholder="Video Title ">
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
                     <label for="video">Audio</label>
                     <div class="row">
                        <div class="col-lg-4">
                          <input value="{{ old('audio') }}" type="file" name="audio" id="audio" class="dropify video" >
                        </div>
                      </div>
                   </fieldset>
                   <button type="submit" class="btn btn-primary">POST</button>
                 </form>
               </div>
             </div>
           @elseif (@isset($edit))
             <div class="panel panel-default">
               <div class="panel-heading" id="">
                <span class="glyphicon glyphicon-pencil"></span>Edit Audio
               </div>
               <div class="panel-body">
                 @if (count($errors)>0)
                   @foreach ($errors->all() as $error)
                     <div class="alert alert-danger" role="alert">
                       {{ $error }}
                     </div>
                   @endforeach
                 @endif
                     <form method="POST" action="{{ route('audio.update',$audio->id)}}" enctype="multipart/form-data">
                       {{ csrf_field() }}
                       {{ method_field("PATCH") }}
                       <fieldset class="form-group">
                         <label for="title">Audio Title</label>
                         <input value="{{ $audio->title }}" type="text" name="title" class="form-control" id="title" placeholder="Audio Title ">
                       </fieldset>
                       <fieldset class="form-group">
                         <label for="discription">Audio Discription</label>
                         <textarea value="{{ old('discription') }}" name="discription" class="form-control" rows="3" cols="50">{{$audio->discription}}</textarea>
                       </fieldset>
                       <fieldset class="form-group">
                         <label for="lyrics">Lyrics</label>
                         <textarea value="{{ old('lyrics') }}" name="lyrics" class="form-control" rows="6" cols="60">{{$audio->lyric}}</textarea>
                       </fieldset>
                       <fieldset class="form-group">
                         <label for="artist_name">Airtist Name</label>
                         <input value="{{ $audio->artist_name }}" type="text" name="artist_name" class="form-control" id="artist_name" placeholder="Video Title ">
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
                         <label for="video">Audio</label>
                         <div class="row">
                            <div class="col-lg-4">
                              <input value="{{ old('audio') }}" type="file" name="audio" id="audio" class="dropify video" >
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
                      <span class="glyphicon glyphicon-list"></span>  Audio Listing
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
                                 <th>Title</th>
                                 <th class="text-center">Audio</th>
                                 <th class="text-center">Artist</th>
                                 <th class="text-center">Status</th>
                                 <th class="text-center">Action</th>
                               </tr>
                             </thead>
                             <tbody>

                                @foreach ($audios as $audio)
                                  <tr class="parent{{$audio->id}}">
                                    <td class="text-center"><img class="" src="/storage/uploads/images/{{ $audio->preview_image}}" width="100px" height="70px" alt="{{ $audio->product_title}}"></td>
                                    <td>{{ $audio->title}}</td>
                                    <td> <audio src="/storage/uploads/audios/{{ $audio->music}}" controls></audio> </td>
                                    <td class="text-center">{{ $audio->artist_name}}</td>
                                    <td class="text-center">
                                      @if ($audio->status)
                                        <button type='button' class="btn btn-danger permit" data-id='{{$audio->id}}' action='Disapprove' data-item='audio'>Disapprove</button>
                                         @else
                                        <button type='button' class="btn btn-success permit" data-id='{{$audio->id}}' action='Approve' data-item='audio'>Approve</button>
                                      @endif
                                    </td>
                                    <td width="15%" class="text-center"><a class="btn btn-primary edit" href="{{route("audio.action",['edit',$audio->id])}}"><span class="ti ti-pencil"></span> </a> | <a  href="#" data-id="{{$audio->id}}" class="btn btn-danger edit delete" data-item="audio"><span class="ti ti-trash"></span> </a></td>
                                  </tr>
                                @endforeach
                             </tbody>
                           </table>
                         </div>
                     </div>
                   </div>
                 </div>
      @endif
       </div>
     </div>
   </div>
@endsection("content")
