@extends("layouts.app")
{{-- elevation worship backgreund:#eeeeef *140#--}}

@section("content")
  <br>
   <div class="">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="fotorama" data-nav="thumbs" data-allowfullscreen="native">
            <a href="#"><img width="100%" src="/storage/uploads/images/{{ $product->preview_image }}"  class="center-block" alt="Friends Of Worship"></a>
            @foreach ($images as $image)
              <a href="#"><img width="100%" src="/storage/uploads/images/{{ $image->other_img }}" alt="Friends Of Worship"></a>
            @endforeach
          </div>
          </div>
              <!-- End Simple Lence Thumbnail -->

          <!-- End Simple Lence Gallery Container -->
          {{-- <div class="img-display">


          </div> --}}
        <div class="col-md-6">
          <div class="product-s-details">
            <h4 class="title">{{$product->product_title}}</h4>
            as low as <span> <b>&#x20A6;{{$product->product_price}}</b> </span>
            <hr>
            <h4><b>Category</b></h4>
            <a href="#">{{$product->category}}</a>
            <h4> <b>Description</b> </h4>
            <p>{{$product->product_discription}}</p>
            <hr>
            <ul class="list-inline">
              <li> <span class="ti ti-facebook"> Share</span> </li>
              <li> <span class="ti ti-twitter"> Tweet</span> </li>
              <li></li>
              <hr>
              <div class="action">
                <form class="" action="{{route('cart.store')}}" method="post">
                  {{ csrf_field()}}
                  <input type="hidden" name="id" value="{{ $product->id}}">
                  <input type="hidden" name="product_price" value="{{ $product->product_price}}">
                  <input type="hidden" name="product_title" value="{{ $product->product_title}}">

                  <button type="submit" class="btn btn-success center-block desk-show" id="desk-show">Add To Cart <span class="ti ti-shopping-cart"></span> </button>
                </form>
              </div>
            </ul>
          </div>
        </div>
      </div>
    </div>
      <br>
    </div>
   </div>
@endsection("content")
