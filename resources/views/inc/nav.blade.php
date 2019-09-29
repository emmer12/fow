
<div class="nav-container">
  <div class="logo-div">
    <a href="/"><img src="/images/fow-logo.png" width="50px" height="50px" ></a>
  </div>
  <div class="menu-div">
    <ul>
      <li class="{{ Request::is('teams*') ? 'active-menu-custom' : '' }}"> <a href="{{ route('team-page') }}"><span class="glyphicon glyphicon-music "></span> Music </a>  </li>
      <li class="{{ Request::is('podcast*') ? 'active-menu-custom' : '' }}"> <a   href="{{ route('podcast.all') }}"><span class="glyphicon glyphicon-headphones"></span> Podcast</a> </li>
      <li class="{{ Request::is('blog*') ? 'active-menu-custom' : '' }}"> <a href="{{route('blog.index')}}"><span class="glyphicon glyphicon-picture"></span> Blog</a> </li>
      <li class="{{ Request::is('store*') ? 'active-menu-custom' : '' }}"> <a href="/store"><span class="glyphicon glyphicon-shopping-cart"></span> Store</a> </li>
      @if (Auth::guest())
        <li class="reg"> <a href="#"><span class="glyphicon glyphicon-user"></span> User</a>
      @else
        <li class="dropdown reg regulate">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
               {{-- <span class="glyphicon glyphicon-user"></span> --}}
               <img src="/storage/uploads/images/{{Auth::user()->profile_picture}}" class="avata" width="40px;" style="border-radius:50%" height="40px" alt="friends of worship">

                   {{ Auth::user()->username }} <span class="caret"></span>
            </a>
        </li>
    @endif
    </ul>
  </li>
  </div>
  <ul class="drop" id="drop">
    @if (Auth::guest())
      <li> <a href="/login">LOGIN</a> </li>
      <li> <a href="/register">SIGN UP</a> </li>

      @else
            <li>
              @if (Auth::guard('admin')->user())
                <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form-a').submit();">
                Logout Admin
              </a>

              <form id="logout-form-a$cart->rowId" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
              @else

                <a href="{{route('dashboard.redirect')}}">Dashboard</a>
                <a href="{{route("admin.profile",'@'.auth()->user()->username)}}">Profile</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
                <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                Logout
                </a>
              @endif
            </li>
    @endif
  </ul>
</div>
{{-- @if (session('success'))
  <div class="alert alert-success" role="alert">
   {{ session('success')}}
  </div>
@endif
@if (session('error'))
  <div class="alert alert-danger" role="alert">
   {{ session('error')}}
  </div>
@endif --}}
<style media="screen">
  .cart-b{
    position: fixed;
    padding: 10px;
    cursor: pointer;
    border-radius: 100%;
    font-size: 24px;
    right: 0px;
    z-index: 999;
    top: 70px;
    transition:all 0.3s ease
  }
  .l{
    font-size: 16px;
    position: absolute;
    left:-20px;
  }
  .cart-display{
  }
  .cart-display:hover > .cart-side-info{
    -webkit-animation-name: zoomIn;
   -webkit-transform-origin: top right;
    animation-duration: .4s;
    animation-timing-function: linear;
    display:block
  }
  .cart-side-info{
    padding: 5px;
    margin: 10px;
    width: 320px;
    background-color:#ccc;
    position: fixed;
    right: 12px;
    z-index: 996;
    top: 70px;
    display: none
  }
  .each-product{
    width: 100%;
    padding: 10px 15px;
    float: none;
    margin: 0 0px;
    overflow: hidden;
    background: white;
    border-bottom: 2px solid #ccc;
  }
  .each-product .img-con{
      background-color: #f1f1f1;
      border: 1px solid #eeeeee;
      margin-right: 10px;
      float: left;
      width: 30%
  }
  .each-product .img-con img{
  width: 100px;
  height: 100px
}
  .each-product .info-div{
    display: inline-block;
    position: relative;
    width: 65%;
    height: 100px;
    padding: 10px;
  }

</style>
@if (Cart::count())
  <div class="cart-display">
    <a href="Javascript:void">
      <span class="ti ti-shopping-cart cart-b bg-primary"><span class="l label label-danger">{{Cart::count()}}</span></span>
    </a>
  <div class="cart-side-info">
    @foreach (Cart::content() as $cart)
    <div class="each-product">
      <div class="img-con">
        <a href="{{ route('store-show',$cart->model->slug) }}"> <img src="/storage/uploads/images/{{ $cart->model->preview_image }}" class="img-fluid pull-xs-left" alt="..."></a>
      </div>
      <div class="info-div pull-right">
        <strong>{{ $cart->model->product_title }}</strong><br>
        <span>&#x20A6;{{ $cart->model->product_price }} x {{ $cart->qty }}</span>
        <form class="" action="{{route("cart.destroy",$cart->rowId) }}" method="post">
          {{ csrf_field() }}
            <td><label for="submit{{$cart->rowId}}" class="ti ti-close pull-right"> </label> </td>
            <input type="submit" class="hidden" id="submit{{$cart->rowId}}" name="submit" value="">
        </form>
      </div>
    </div>
  @endforeach
    <h5 style="background:white;padding:10px;"> <strong>Subtotal::</strong> <strong class="pull-right">&#x20A6;{{ Cart::subtotal() }}</strong> </h5>
    <a href="{{ route('store.cart') }}" class="btn btn-success">Cart <span class="ti ti-angle-double-right"></span> </a>
    <a href="{{ route('store.checkout') }}" class="btn btn-success pull-right">Checkout <span class="ti ti-angle-double-right"></span>  </a>
  </div>
</div>

@endif
