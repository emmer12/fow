<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogPosts;
class FundRaiseController extends Controller
{
  public function index()
  {
    $fund_raise=BlogPosts::where('type','fund-raise')->orderBy('created_at','desc')->paginate(2);
    return view('blog/fund-raise')->with('fund_raise',$fund_raise);
  }

}
