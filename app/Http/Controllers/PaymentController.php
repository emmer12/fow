<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
//use Paystack;
use App\Order;
use App\OrderProducts;


class PaymentController extends Controller
{
      public function saveOrders(Request $request)
      {
        if ($request->ajax()){
          //Create New Post
          $order= new Order();
          $orderPro= new OrderProducts();
          $order->firstname=$request->input('firstname');
          $order->lastname=$request->input('lastname');
          $order->email=$request->input('email');
          $order->phoneNo=$request->input('phoneNo');
          $order->city=$request->input('city');
          $order->country=$request->input('country');
          $order->address1=$request->input('address');
          $order->address2=$request->input('address2');
          $order->transaction_id=$request->input('tId');
          if ($request->input('status')=="success") {
            $status=true;
          }
          $order->paid=$status;
          $order->customer_id=auth()->user()->id;
          $order->save();
          foreach (Cart::content() as $cart) {
            $orderPro->order_id=$order->id;
            $orderPro->products_id=$cart->model->id;
            $orderPro->qty=$cart->qty;
            $orderPro->save();
          }
          Cart::destroy();
          return response(['success'=>true,'data'=>$request->phoneNo]);
          
        }
     }

}
