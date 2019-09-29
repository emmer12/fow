<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogPosts;

class TestimoniesController extends Controller
{
  public function index()
  {
    $testimony=BlogPosts::where('type','testimonies')->orderBy('created_at','desc')->get()->take(3);
    return view('blog/testimonies')->with('testimonies',$testimony);
  }
}
