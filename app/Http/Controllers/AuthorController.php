<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use URL;
use Auth;
use App\Requests;

class AuthorController extends Controller
{
    public function contribute()
    {
      if (!Auth()->user()) {
        Session::put('url_intended',URL::full());
       return redirect("login");
      }else {
      return view("author/contribute")->with([
        "url"=>"Author Registration",
      ]);
    }
  }

  public function request(Request $request)
  {
    if (Auth::user()) {
      $req=new Requests();
      $req->user_id=Auth::user()->id;
      $req->type=$request->input('type');
      $req->save();
      return redirect()->back()->with("msg","your request has been sent successfully, you will be notify or you can also check your dashboard to know the status of your approval");
    }
  }


  
}
