@extends("layouts.app")
{{-- elevation worship backgreund:#eeeeef --}}

<style media="screen">
  .category ul{
    margin:0px;
    background: white;
    padding: 10px;
    font-weight:700
  }
  .category ul li{
    list-style: none;
  }
  .category ul li a{
    display:block;
    //background:#ddd;
    padding:10px;
    margin:3px;
    border-bottom: 1px solid #073e5d
  }
  .store-nav{
    background: #ddd;
    margin:5px;

  }
  .store-nav ul li{
    display:inline-block;
  }
  .store-nav ul li a{
    padding: 10px 15px;
    background:#073e5d;
    color: white;
    font-weight: 700

  }
</style>
@section("content")
   <div class="store-nav">
     <ul>
       <li><a href="{{route("store-page")}}">Main store</a></li>
       <li> <a href="{{route("store.books")}}">Books store</a> </li>
     </ul>
   </div>
    <div class="container">
      <div class="row">
        <form class="search-form storeSearch text-right" action="index.html" method="post">
          <input type="text" name="search" class=""  value="{{old('search')}}" placeholder="search..." >
          <input type="submit" name="submit" value="GO" >
        </form>
      </div>
      <div class="row">
        {{-- <div class="col-md-3">
          <div class="category">
            <h4 class="heading">Category <span class="ti ti-menu"></span> </h4>
            <ul>
              <li><a href="{{ route("store-category-page","Bag") }}"> <span class="ti ti-angle-double-right"></span> Bags</a></li>
              <li><a href="{{ route("store-category-page","Band") }}"> <span class="ti ti-angle-double-right"></span> Bands</a></li>
              <li><a href="{{ route("store-category-page","T-shirt") }}"> <span class="ti ti-angle-double-right"></span> T-Shirt</a></li>
              <li><a href="{{ route("store-category-page","Jeans-pants") }}"> <span class="ti ti-angle-double-right"></span> Jeans Pants</a></li>
              <li><a href="{{ route("store-category-page","Shoe") }}"> <span class="ti ti-angle-double-right"></span> Shoe</a></li>
            </ul>
          </div>
        </div> --}}
        <div class="col-md-12">
          @if (isset($count))
            <strong style="margin-left:15px">found  {{$count}} <span class="text-success"> ({{$category}})</span> Result(s)</strong>
          @endif
          <div class="row">
            {{-- card template --}}
            @if (count($products) < 1)
               <div class="alert alert-info" role="alert">
                 No product In the Store
               </div>
            @endif
            @foreach ($products as $product)
              {{-- <div class="col-md-3 col-sm-6">
                <div class="shopping-card">
                  <a href="{{ route('store-show',"$product->slug") }}">
                    <img src="/storage/uploads/images/{{ $product->preview_image }}" width="100%" height="300px" alt="">
                  </a>
                  <div class="card-details">
                    <a href="/store/{{ $product->slug }}" class="t-active"> <h4>{{ $product->product_title }}</h4> </a>
                    <span class="pull-right price"><b>&#x20A6;{{ $product->product_price }}</b></span>
                    <hr>
                    <form class="" action="{{route('cart.store')}}" method="post">
                      {{ csrf_field()}}
                      <input type="hidden" name="id" value="{{ $product->id}}">
                      <input type="hidden" name="product_price" value="{{ $product->product_price}}">
                      <input type="hidden" name="product_title" value="{{ $product->product_title}}">

                      <button type="submit" class="btn btn-success center-block desk-show hidden-xs" id="desk-show">Add To Cart <span class="ti ti-shopping-cart"></span> </button>
                      <button type="submit" class="btn btn-success center-block hidden-lg hidden-md hidden-sm">Add To Cart <span class="ti ti-shopping-cart"></span> </button>
                    </form>
                  </div>
                </div>
              </div> --}}
            
              <!-- Start-single-product -->
              <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 shop-mar-bottom">
                  <div class="product-single-wrap hover">
                      <div class="single-product">
                          <div class="ribbon red"><span>sale</span></div>
                          <div class="image">
                            <a href="{{ route('store-show',"$product->slug") }}">
                              <img src="/storage/uploads/images/{{ $product->preview_image }}" width="100%" height="300px" alt="">
                            </a>
                          </div>
                          <div class="single-content">
                              <div class="brand">New</div>
                              <div class="title">
                                  <a href="{{ route('store-show',"$product->slug") }}">{{ $product->product_title }}</a>
                              </div>

                          </div>
                          <div class="prices">
                              <div class="price-prev">{{ $product->discount_price }}</div>
                              <div class="price-current present-price pull-right">{{ $product->product_price }}</div>
                          </div>

                          <div class="hover-area">
                              <div class="add-cart-button">
                                <form class="" action="{{route('cart.store')}}" method="post">
                                  {{ csrf_field()}}
                                  <input type="hidden" name="id" value="{{ $product->id}}">
                                  <input type="hidden" name="product_price" value="{{ $product->product_price}}">
                                  <input type="hidden" name="product_title" value="{{ $product->product_title}}">

                                  <button type="submit" class="btn btn-success center-block desk-show hidden-xs" id="desk-show">Add To Cart <span class="ti ti-shopping-cart"></span> </button>
                                  <button type="submit" class="btn btn-success center-block hidden-lg hidden-md hidden-sm">Add To Cart <span class="ti ti-shopping-cart"></span> </button>
                                </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <!-- End-single-product -->
            @endforeach
            {{-- card template end --}}
          </div>

        </div>
      </div>
  </div>
  <div class="container">
    <nav>
      <ul class="pager-custom">
        {{ $products->links() }}
      </ul>
    </nav>
  </div>
@endsection("content")
