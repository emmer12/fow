<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Newsletter;
class NewsLetterController extends Controller
{
  public function subscribe(Request $request)
  {
      if (!Newsletter::isSubscribed($request->input('email'))) {
        Newsletter::subscribe($request->input('email'));
        return redirect('/')->with('success',$request->input('email'));
      }
      return redirect('/')->with('error',"Sorry you are alrady suscribed ");

  }
}
