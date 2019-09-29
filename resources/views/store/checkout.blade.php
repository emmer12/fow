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
  .bill-form{
    background: #fff;
    padding: 20px;
    margin-bottom: 10px
  }

  </style>
  <div class="">
    <div class="s-banner text-center">
      <div class="m-banner-c">
        <span class="glyphicon glyphicon-shopping-cart"></span>
        <h4 >Checkout</h4>
      </div>
    </div>
  </div>
  <br>
    <div class="container">
      <div class="row ">
        <div class="col-md-6 col-lg-6">
          <div class="bill-form">
          <h4 class="test-center heading">Billing Details</h4>
          <div class="alert alert-danger msg " style="display:none" id="msg"    role="alert">
            Only Address2 field is not required
          </div>
          <form method="Post">
            {{ csrf_field() }}
            <fieldset class="form-group">
              <label for="firstname">Firstname</label>
              <input type="text" class="form-control" required id="firstname" value="{{ Auth::user()->firstname }}" placeholder="firstname">
            </fieldset>
            <fieldset class="form-group">
              <label for="lastname">Lastname</label>
              <input type="text" class="form-control" required id="lastname" value="{{ Auth::user()->lastname }}" placeholder="lastname">
            </fieldset>
            <fieldset class="form-group">
              <label for="email">Email Address</label>
              <input type="email" class="form-control" required id="email" value="{{ Auth::user()->email }}" placeholder="example@mail.com">
            </fieldset>
            <fieldset class="form-group">
              <label for="address">Address 1</label>
              <input type="text" class="form-control" required id="address" value="" placeholder="address">
            </fieldset>
            <fieldset class="form-group">
              <label for="address">Address 2</label>
              <input type="text" class="form-control" id="address2" value="" placeholder="address">
            </fieldset>
            <fieldset class="form-group">
              <label for="phoneNo">Phone Number</label>
              <input type="number" class="form-control" required id="phoneNo"  value="{{ Auth::user()->phoneNo }}" placeholder="phoneNo">
            </fieldset>
            <fieldset class="form-group">
              <label for="country">Country</label>
              <select class="country form-control" required id="country">

              </select>
            </fieldset>
            <fieldset class="form-group">
              <label for="city">City</label>
              <input type="text" class="form-control" id="city" name="cty" placeholder="city">
            </fieldset>
        </div>
      </div>
        <div class="col-md-6 col-lg-6">
             <div class="cart-payment-details ">
               <h4 class="text-center heading">Your Order</h4>
               <table class="table">
                 <thead>
                   <tr>
                     <th> <h4>Products</h4> </th>
                     <th> <h4>Total</h4> </th>
                   </tr>
                 </thead>
                 <tbody>
                     @foreach (Cart::content() as $cart)
                       <tr>
                         <td>{{ $cart->model->product_title }} | &#x20A6;{{ $cart->model->product_price }}  X {{ $cart->qty }}</td>
                         <td>&#x20A6;{{ $cart->model->product_price * $cart->qty }}</td>
                       </tr>
                     @endforeach
                   <hr>
                     <td> <h4><b>Total</b></h4> </td>
                     <td><b>&#x20A6;{{ Cart::subtotal() }}</b></td>

                   </tr>
                 </tbody>
               </table>
               <br>
                <br>
                <script src="https://js.paystack.co/v1/inline.js"></script>
                <button type="submit" class="btn btn-success btn-md" id="paynow"> Pay Now</button>

             </div>
           </div>
    </div>
  </form>
  </div>

  <script>
  function valdate() {
    if ($("#firstname").val()=="" || $("#lastname").val()=="" || $("#email").val()=="" || $("#phoneNo").val()=="" || $("#address").val()=="" || $("#country").val()=="" || $("#city").val()=="" ) {
      return true;
    }else {
      return false
    }
  }
  $("#paynow").click(function (e) {
    e.preventDefault()
    if (valdate()) {
      alert("Only Address2 field is not required");
      $("#msg").fadeIn()
    }else {
      var token=$("form").find("input[type=hidden]").val();
      var handler = PaystackPop.setup({
        key: 'pk_test_b159a9fc38fd8b719ba437e06117c46f9aad79cc',
        email:$("#email").val(),
        amount: {{ intval(str_replace(',', '', Cart::subtotal() )) * 100}} ,
        currency: "NGN",
        ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
        firstname: $("#firstname").val(),
        lastname: $("#lastname").val(),
        // label: "Optional string that replaces customer email"
        metadata: {
           custom_fields: [
              {
                  display_name: "Mobile Number",
                  variable_name: "mobile_number",
                  value:$("#phoneNo").val()
              }
           ]
        },
        callback: function(response){
            console.log(response);
            alert('success. transaction ref is ' + response.reference);
            $.ajax({
              url:"{{route("payment.store")}}",
              method:"POST",
              data:{
                "_token":token,
                "firstname":$("#firstname").val(),
                "lastname":$("#lastname").val(),
                "email":$("#email").val(),
                "phoneNo":$("#phoneNo").val(),
                "address":$("#address").val(),
                "address2":$("#address2").val(),
                "country":$("#country").val(),
                "city":$("#city").val(),
                "status":response.status,
                "tId":response.reference,
                "cart":"{{Cart::content()}}",
              },
              success:function(data) {
                if (data.success) {
                  window.location.href="{{route("order.display","success")}}"
                }
              }

            })
        },
        onClose: function(){
            alert('window closed');
        }
      });
      handler.openIframe();
    }

  });
</script>
@endsection("content")
