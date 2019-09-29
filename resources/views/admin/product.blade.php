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
           <button type="button" class="btn btn-default"><a href="#">Total Post <span class="label label-pill label-success">{{count($products)}}</span> </a></button>
           @if (@isset($create) || @isset($edit) )
             <button type="button" class="btn btn-default"><a href="{{route("admin.dashboard.product")}}">Back</a></button>
             @else
             <button type="button" class="btn btn-success"><a href="{{route("product.action",['action'=>'create','id'=>'add'])}}">Add</a></button>
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
               <form id="fileupload" method="POST" action="{{ route('admin-storeProduct')}}" enctype="multipart/form-data">
                 {{ csrf_field() }}
                 <fieldset class="form-group">
                   <label for="title">Product Title</label>
                   <input value="{{ old('title') }}" id="title" type="text" name="product_title" class="form-control" id="title" placeholder="Video Title ">
                 </fieldset>
                 <fieldset class="form-group">
                   <label for="discription">Product Discription</label>
                   <textarea value="{{ old('discription') }}" id="discription" name="product_discription" class="form-control" rows="3" cols="50"></textarea>
                 </fieldset>
                 <fieldset class="form-group">
                   <label for="qty">Quantity</label>
                   <input value="{{ old('qty') }}" id="qty" name="qty" class="form-control" type="number" />
                 </fieldset>
                 <fieldset class="form-group">
                   <label for="price">Price</label>
                   <input value="{{ old('price') }}" id="price" name="product_price" class="form-control" type="number" />
                 </fieldset>
                 <fieldset class="form-group">
                   <label for="d-price">Discount Price</label>
                   <input value="{{ old('price') }}" id="d-price" name="product_discount_price" class="form-control" type="number" />
                 </fieldset>
                 <fieldset class="form-group">
                   <label for="p-image">Preview Image</label>
                   <div class="row">
                      <div class="col-lg-4">
                        <input value="{{ old('preview_image') }}" type="file" name="preview_image" class="dropify preview_image" id="p-image" >
                      </div>
                    </div>
                 </fieldset>
                 <div class="clone hide">
                    <div class="control-group input-group" style="margin-top:10px">
                      <input type="file" name="additional_img[]" class="form-control">
                      <div class="input-group-btn" id="remove">
                        <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                      </div>
                    </div>
                  </div>

                 <span class="btn btn-success additional increment">
                     <i class="glyphicon glyphicon-plus "></i>
                     <span>Add Other Images...</span>
                 </span><br><br>
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
                <form id="fileupload" method="POST" action="{{ route('storeProduct.update',$product->id)}}" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                  <fieldset class="form-group">
                    <label for="title">Product Title</label>
                    <input id="title" type="text" name="product_title" class="form-control" id="title" placeholder="Title " value="{{$product->product_title}}">
                  </fieldset>

                  <fieldset class="form-group">
                    <label for="discription">Product Discription</label>
                    <textarea value="{{ old('discription') }}" id="discription" name="product_discription" class="form-control" rows="3" cols="50">{{$product->product_discription}}</textarea>
                  </fieldset>
                  <fieldset class="form-group">
                    <label for="qty">Quantity</label>
                    <input value="{{$product->qty}}" id="qty" name="qty" class="form-control" type="number" />
                  </fieldset>
                  <fieldset class="form-group">
                    <label for="price">Price</label>
                    <input value="{{ $product->product_price }}" id="price" name="product_price" class="form-control" type="number" />
                  </fieldset>
                  <fieldset class="form-group">
                    <label for="d-price">Discount Price</label>
                    <input value="{{ $product->discount_price }}" id="d-price" name="product_discount_price" class="form-control" type="number" />
                  </fieldset>
                  <fieldset class="form-group">
                    <label for="p-image">Preview Image</label>
                    <div class="row">
                       <div class="col-lg-4">
                         <input value="{{ old('preview_image') }}" type="file" name="preview_image" class="dropify preview_image" id="p-image" >
                       </div>
                     </div>
                  </fieldset>
                  <div class="clone hide">
                     <div class="control-group input-group" style="margin-top:10px">
                       <input type="file" name="additional_img[]" class="form-control">
                       <div class="input-group-btn" id="remove">
                         <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                       </div>
                     </div>
                   </div>

                  <span class="btn btn-success additional increment">
                      <i class="glyphicon glyphicon-plus "></i>
                      <span>Add Other Images...</span>
                  </span><br><br>
                  <button type="submit" class="btn btn-primary">POST</button>
                </form>
              </div>
            </div>
          @else
            <div class="div product">
              <div class="panel panel-default">
                <div class="panel-heading">
                 <span class="glyphicon glyphicon-list"></span>  Product Listing
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
                            <th>Product Name</th>
                            <th class="text-right">Price</th>
                            <th class="text-right">Quantity</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                           @foreach ($products as $product)
                             <tr class="parent{{$product->id}}">
                               <td class="text-center"><img class="" src="/storage/uploads/images/{{ $product->preview_image}}" width="100px" height="70px" alt="{{ $product->product_title}}"></td>
                               <td>{{ $product->product_title}}</td>
                               <td class="text-right">{{ $product->product_price}}</td>
                               <td class="text-right">{{ $product->qty}}</td>
                               <td>
                                 @if ($product->status)
                                   <button type='button' class="btn btn-success permit" data-id='{{$product->id}}' action='Approve' data-item='product'>Approved</button>
                                   @else
                                   <button type='button' class="btn btn-danger permit" data-id='{{$product->id}}' action='Disapprove' data-item='product'>Disabled</button>
                                 @endif
                               </td>
                               <td class="text-right"><a class="btn btn-primary edit" href="{{route("product.action",['action'=>'edit','id'=>$product->id])}}"><span class="ti ti-pencil"></span> </a> <a  href="#" data-id="{{$product->id}}" class="btn btn-danger edit delete" data-item="product"><span class="ti ti-trash"></span> </a> </td>
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
                                {{ $products->links() }}
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
