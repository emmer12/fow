@extends("layouts.app")
{{-- elevation worship backgreund:#eeeeef --}}
@section("content")
  <div class="">
    <div class="s-banner text-center">
      <div class="m-banner-c">
        <span class="glyphicon glyphicon-shopping-cart"></span>
        <h4>STORE</h4>
      </div>
    </div>
  </div>
  <br>
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-6">
          {{-- card template --}}
          <div class="shopping-card">
            <a href="/store/1">
              <img src="/images/shop_9.jpg" width="100%" alt="">
            </a>
            <div class="card-details">
              <a href="/store/1"> <h4>Title of Products</h4> </a>
              <span class="pull-right price"><b>&#x20A6;5000</b></span>
              <hr>
              <button type="button" class="btn btn-success center-block desk-show hidden-xs" id="desk-show">Add To Cart <span class="ti ti-shopping-cart"></span> </button>
              <button type="button" class="btn btn-success center-block hidden-lg hidden-md hidden-sm">Add To Cart <span class="ti ti-shopping-cart"></span> </button>
            </div>
          </div>
          {{-- card template end --}}
        </div>
        <div class="col-md-4 col-sm-6">
          <div class="shopping-card">
             <img src="/images/shop_7.jpg" width="100%" alt="">
            <div class="">

            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6">
          <div class="shopping-card">
             <img src="/images/shop_7.jpg" width="100%" alt="">
            <div class="">

            </div>
          </div>
        </div>
    </div>
  </div>
@endsection("content")
