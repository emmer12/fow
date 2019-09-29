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
           <button type="button" class="btn btn-default"><a href="#">Total Post <span class="label label-pill label-success"> {{count($haps)}}</span> </a></button>
           @if (@isset($create) || @isset($edit) )
             <button type="button" class="btn btn-default"><a href="{{route("admin.dashboard.blog")}}">Back</a></button>
             @else
             <button type="button" class="btn btn-success"><a href="{{route("haps.action",['action'=>'create','id'=>'add'])}}">Add</a></button>
           @endif
         </div>
         <hr>

        @if (@isset($create))
           <div class="panel panel-default">
             <div class="panel-heading">
              <span class="glyphicon glyphicon-shopping-cart"></span>Create Haps
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
               <form method="POST" action="{{ route('create.haps')}}" enctype="multipart/form-data">
                 {{ csrf_field() }}
                 <fieldset class="form-group">
                   <label for="title">Title</label>
                   <input value="{{ old('title') }}" type="text" name="title" class="form-control" id="title" placeholder="Title">
                 </fieldset>

                 <fieldset class="form-group">
                   <label for="description">Description</label>
                   <textarea value="{{ old('description') }}" id="description" name="description" class="form-control" rows="3" cols="50"></textarea>
                 </fieldset>
                 <input type="hidden" name="id" value="{{Auth::user()->id}}">

                 <fieldset class="form-group">
                   <label for="description">Price</label>
                   <input value="{{ old('price') }}" placeholder='price' type="number" name="price" class="form-control" id="price" >
                 </fieldset>
                 <fieldset class="form-group">
                   <label for="venue">Venue</label>
                   <input type="text" name="venue" value="{{old('venue')}}" class="form-control" placeholder="venue">
                 </fieldset>
                 <fieldset class="form-group">
                   <label for="date">Date</label>
                   <input type="date" name="date" value="{{old('date')}}" class="form-control"  placeholder="Date">
                 </fieldset>
                 <fieldset class="form-group">
                   <label for="time">Time</label>
                   <input type="time" name="time" value="{{old('time')}}" class="form-control" placeholder="Time">
                 </fieldset>
                 <fieldset class="form-group">
                   <label for="link">Link</label>
                   <input type="link" name="link" value="{{old('link')}}" class="form-control" placeholder="Link">
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
              <h1>Edit Mode</h1>
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
                            <th>Title</th>
                            <th class="text-right">Venue</th>
                            <th class="text-right">Link</th>
                            <th colspan="2" class="text-right">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                           @foreach ($haps as $hap)
                             <tr class="parent{{$hap->id}}">
                               <td class="text-center"><img class="" src="/storage/uploads/images/{{ $hap->display_pic}}" width="100px" height="70px" alt="{{ $hap->product_title}}"></td>
                               <td>{{ $hap->title}}</td>
                               <td class="text-right">{{ $hap->venue}}</td>
                               <td class="text-right">{{ $hap->link}}</td>
                               <td width="15%" class="text-center "><a  href="#" data-id="{{$hap->id}}" class="btn btn-danger edit delete" data-item="haps"><span class="ti ti-trash"></span> </a> </td>
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
                                {{ $haps->links() }}
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
