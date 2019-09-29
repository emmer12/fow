@extends("layouts.app")
{{-- elevation worship backgreund:#eeeeef --}}
<style media="screen">

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
           <button type="button" class="btn btn-warning add-cat">Add Category <i class="ti ti-plus"></i></button>
           <button type="button" class="btn btn-default"><a href="#">Total Post <span class="label label-pill label-success">{{count($books)}}</span> </a></button>

           @if (@isset($create) || @isset($edit) )
             <button type="button" class="btn btn-default"><a href="{{route("admin.dashboard.book",[null,null])}}">Back</a></button>
             @else
               <button type="button" class="btn btn-success"><a href="{{route("book.action",['create','add'])}}">Add</a></button>
           @endif
         </div>
         <hr>

         <div class="cat well" style="display:none">
           <form  action="{{route("category.book.add")}}" method="post">
             {{ csrf_field() }}
             <input type="text" required class="form-control" name="category" value="" placeholder="category"><br>
             <button type="submit" class="btn btn-primary ">Add</button>
           </form>
         </div>
        @if (@isset($create))
           <div class="panel panel-default">
             <div class="panel-heading">
              <span class="glyphicon glyphicon-shopping-cart"></span> Create Book Post
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
               <form method="POST" action="{{ route('admin-storeBook')}}" enctype="multipart/form-data">
                 {{ csrf_field() }}
                 <fieldset class="form-group">
                   <label for="title">Book Title</label>
                   <input value="{{ old('title') }}" type="text" name="title" class="form-control" id="title" placeholder="Book Title ">
                 </fieldset>
                 <fieldset class="form-group">
                   <label for="author">Book Author</label>
                   <input value="{{ old('author') }}" type="text" name="author" class="form-control" id="author" placeholder="Author">
                 </fieldset>
                 <fieldset class="form-group">
                   <label for="description">Book Description</label>
                   <textarea value="{{ old('discription') }}" name="description" class="form-control" rows="3" cols="50"></textarea>
                 </fieldset>
                 <fieldset class="form-group">
                   <label for="price">Price **<small>leave blank if not selling hard copy **</small></label>
                   <input value="{{ old('price') }}" name="price" class="form-control" id='price' type="number" />
                 </fieldset>
                 <fieldset class="form-group">
                   <label for="qty">Quantity **<small>leave blank if not selling hard copy **</small></label>
                   <input value="{{ old('qty') }}" name="qty" class="form-control" id='qty' type="number" />
                 </fieldset>
                 <fieldset class="form-group">
                   <label for="category">Category</label>
                   <select class="form-control" name="category">
                     <option value="">Choose Category</option>
                     @foreach ($categories as $category)
                       <option value="{{$category->name}}">{{$category->name}}</option>
                     @endforeach
                   </select>
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
                   <label for="p-image">File</label>
                   <div class="row">
                      <div class="col-lg-4">
                        <input value="{{ old('file') }}" type="file" name="file" class="dropify preview_image" id="file" >
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
               <span class="glyphicon glyphicon-list"></span> Edit
              </div>
              <div class="panel-body">
                @if (count($errors) > 0)
                  @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                      {{ $error }}
                    </div>
                  @endforeach
                @endif
                <form method="POST" action="{{ route('storeBook.update',$book->id)}}" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                  <fieldset class="form-group">
                    <label for="title">Book Title</label>
                    <input value="{{ $book->title }}" type="text" name="title" class="form-control" id="title" placeholder="Book Title ">
                  </fieldset>
                  <fieldset class="form-group">
                    <label for="author">Book Author</label>
                    <input value="{{ $book->author}}" type="text" name="author" class="form-control" id="author" placeholder="Author">
                  </fieldset>
                  <fieldset class="form-group">
                    <label for="description">Book Description</label>
                    <textarea value="{{ old('discription') }}" name="description" class="form-control" rows="3" cols="50">{{$book->description}}</textarea>
                  </fieldset>
                  <label for="price">Price **<small>leave blank if not selling hard copy **</small></label>
                  <fieldset class="form-group">
                    <input value="{{ $book->price }}" name="price" class="form-control" id='price' type="number" />
                  </fieldset>
                  <fieldset class="form-group">
                    <label for="qty" >Quantity **<small>leave blank if not selling hard copy **</small></label>
                    <input value="{{ $book->qty }}" name="qty" class="form-control" id='qty' type="number" />
                  </fieldset>
                  <fieldset class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" name="category">
                      <option value="{{$book->category}}">{{$book->category}}</option>
                      @foreach ($categories as $category)
                        <option value="{{$category->name}}">{{$category->name}}</option>
                      @endforeach
                    </select>
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
                    <label for="p-image">File</label>
                    <div class="row">
                       <div class="col-lg-4">
                         <input value="{{ old('file') }}" type="file" name="file" class="dropify preview_image" id="file" >
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
                 <span class="glyphicon glyphicon-list"></span>  Book Listing
                </div>
                <div class="panel-body">
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
                            <th>Book Title</th>
                            <th class="text-right">Price</th>
                            <th class="text-right">Quantity</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                           @foreach ($books as $book)
                             <tr class="parent{{$book->id}}">
                               <td class="text-center"><img class="" src="/storage/uploads/images/{{ $book->preview_image}}" width="100px" height="70px" alt="{{ $book->product_title}}"></td>
                               <td>{{ $book->title}}</td>
                               <td class="text-right">{{ $book->price}}</td>
                               <td class="text-right">{{ $book->qty}}</td>
                               <td >
                                 @if ($book->status)
                                   <button type='button' class="btn btn-danger permit" data-id='{{$book->id}}' action='Disapprove' data-item='book'>Disapprove</button>
                                    @else
                                   <button type='button' class="btn btn-success permit" data-id='{{$book->id}}' action='Approve' data-item='book'>Approve</button>
                                 @endif
                               </td>
                               <td class="text-right"><a class="btn btn-primary edit" href="{{route("book.action",['action'=>"edit","id"=>$book->id])}}"><span class="ti ti-pencil"></span> </a> | <a  href="#" data-id="{{$book->id}}" class="btn btn-danger edit delete" data-item="book"><span class="ti ti-trash"></span> </a> </td>
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
   </div>
@endsection("content")
