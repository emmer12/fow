@extends("layouts.app")
{{-- elevation worship backgreund:#eeeeef --}}
@section("content")
  <style media="screen">

  .cart-con table tr td {
    line-height:100px;
  }
  .cart-con table tr td input{
    line-height:25px;
  }
  .cart-con span{
    cursor: pointer;
    font-weight:700
  }

  </style>
  <div class="">
    <div class="s-banner text-center">
      <div class="m-banner-c">
        <span class="glyphicon glyphicon-shopping-cart"></span>
        <h4 >Cart</h4>
      </div>
    </div>
  </div>
  <br>

    <div class="container">
      <div class="alert alert-info" role="alert">
        {{ Cart::count() }} item(s) in the cart
      </div>
      <div class="row">
        <div class="col-md-12 col-sm-12">
          {{-- cart template --}}
          @if (Cart::count() < 1)
          @else
           <div class="cart-con">
             <div class="table-responsive">
               <table class="table">

                   <thead>
                     <tr>
                       <th>Image</th>
                       <th>Product</th>
                       <th>Quantity</th>
                       <th>Price</th>
                       <th>Subtotal</th>
                     </tr>
                 </thead>
                 @foreach (Cart::content() as $cart)
                 <tbody>
                   <tr>
                     <td> <a href="{{ route('store-show',$cart->model->slug) }}"> <img src="/storage/uploads/images/{{ $cart->model->preview_image }}" class="img-fluid pull-xs-left" alt="..."></a></td>
                     <td><a href="{{ route('store-show',$cart->model->slug) }}">{{ $cart->model->product_title }}</a></td>
                     <td>
                       <form class="" action="{{route("cart.update",$cart->rowId) }}" method="post">
                         {{ csrf_field() }}
                         <button type="button" class="btn btn-primary" onclick="var result = document.getElementById('qty-{{ $cart->model->id }}'); var qty = result.value; if( !isNaN( qty) &amp;&amp; qty &gt; 1 ) result.value--;return false;"><span class="ti ti-minus"></span></button>
                         <input type="text" maxlength="8" name="qty" value="{{ $cart->qty }}" id="qty-{{ $cart->model->id }}">
                         <button type="button" class="btn btn-primary" onclick="var result = document.getElementById('qty-{{ $cart->model->id }}'); var qty = result.value; if( !isNaN( qty)) result.value++;return false;" ><span class="ti ti-plus"></span></button>
                         <button type="submit" name="button" class="btn btn-success">Update</button>
                       </form>
                     </td>
                     <td>&#x20A6;{{ $cart->model->product_price }}</td>
                     <td>&#x20A6;{{ $cart->model->product_price * $cart->qty }}</td>
                     <form class="" action="{{route("cart.destroy",$cart->rowId) }}" method="post">
                       {{ csrf_field() }}
                         <td><label for="submit{{$cart->rowId}}" class="ti ti-close"> </label> </td>
                         <input type="submit" class="hidden" id="submit{{$cart->rowId}}" name="submit" value="">
                     </form>

                   </tr>
                 </tbody>
               @endforeach
               </table>
             </div>
           </div>
         @endif
             {{-- cart template end --}}
             <hr>
             <div class="container">
               <div class="row">
                 @if (Cart::count() < 1)
                   <div class="">
                     <a class="btn btn-primary" href="{{ route('store-page')}}" role="button"> <span class="ti ti-arrow-left"></span>Back to Store</a>
                   </div>
                  @else
                 <div class="col-md-6" style="margin-bottom:10px">
                   <a class="btn btn-primary" href="{{ route('store-page')}}" role="button"> <span class="ti ti-arrow-left"></span>Back to Store</a>
                   <a class="btn btn-success" href="{{route("store.checkout")}}" role="button"> Checkout</a>
                 </div>
                 <div class="col-md-6">
                   <div class="cart-payment-details">
                     <h3 class="text-center">Your Order</h3>
                     <table class="table">
                       <thead>
                         <tr>
                           <th> <h4>Products</h4> </th>
                           <th> <h4>Subtotal</h4> </th>
                         </tr>
                       </thead>

                           <tbody>
                       @foreach (Cart::content() as $cart)
                             <tr>
                               <td>{{ $cart->model->product_price }} X {{ $cart->qty }}</td>
                               <td>&#x20A6;{{ $cart->model->product_price * $cart->qty }}</td>
                             </tr>
                             <tr>
                        @endforeach
                               <td>Shipping</td>
                               <td>&#x20A6;2000</td>
                             </tr>
                             <hr>
                             <td> <h4><b>Total</b></h4> </td>
                             <td><h4 style="color:#073e5d;font-weight:700">&#x20A6;{{ Cart::subtotal() }}</h4></td>
                           </tr>
                         </tbody>


                   </table>
                   <a href="{{route("store.checkout")}}" class="btn btn-success center-block " style="color:white;text-decoration:none;display:block;width:100px">CHECKOUT</a>
                 </div>
                 </div>
               @endif
               </div>
             </div>
        </div>
    </div>
  </div>
  <hr>
@endsection("content")
