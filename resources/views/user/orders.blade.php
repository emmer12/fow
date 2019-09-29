@extends("layouts.app")
{{-- elevation worship backgreund:#eeeeef --}}
@section("content")
  <style media="screen">
    .list-point li{
      list-style-type: square;
    }
  </style>
  <br>
     <div class="container">
       <div class="row">
         @if(Session::has('message'))
          <p class="alert alert-success">{{ Session::get('message') }}</p>
         @endif
         <div class="col-md-6 col-md-offset-3">
           <a href="#">
         @forelse ($orders as $order)
            <div class="add-shadow order" >
              <div class="">
                <a href="#" style="font-weight:700;color:green;font-size:16px" class="pull-right">INV/ID {{$order->transaction_id}}</a>
                <strong>Date:: {{$order->created_at}}</strong>
                <p class="text-success">Status:: {{$order->paid ? "Paid" : "Not Paid"}}</p>
                <p class="">Phone Number:: {{$order->phoneNo}}</p>
                <p>Address 1:: {{$order->address}}</p>
                <p>Address 2:: {{$order->address2}}</p>
                <hr>
              </div>
              @php
                $tcount=0;
              @endphp
             @foreach ($order->orderProduct as $pro)
               @php
                 $tcount=$tcount + $pro->product()[0]->product_price * $pro->qty
               @endphp
               <div class="add-shadow order-sub">
                 <img src="/storage/uploads/images/{{ $pro->product()[0]->preview_image }}" alt="">
                 <div class="content">
                   <h4><a href="#">{{$pro->product()[0]->product_title}}</a></h4>
                   <b>&#x20A6;{{$pro->product()[0]->product_price}} X {{$pro->qty}} </b>
                 </div>
               </div>
             @endforeach
             <hr>
             <b>Total::</b><span style="color:green;font-weight:700;font-size:16px;background:#eef;margin-right:15px;padding:0px 15px" class="pull-right"><b>&#x20A6;{{ $tcount }}</b></span>
             </div>
             </a>
             <br>
             @empty
              <div class="alert alert-info" role="alert">
                Order list empty
                <a href="{{route("store-page")}}" class="alert-link">Shop now</a>.
              </div>
         @endforelse

       </div>
       <ul class="pager">
         {{ $orders->links() }}
       </ul>
      </div>
   </div>
@endsection("content")
