<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\SendMailable;
use App\BlogPosts;
use App\MusicPost;
use App\Product;
class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $audioFeed=MusicPost::orderBy('created_at','desc')->take(6)->get();
      //$fundRaise=BlogPosts::where("type","fund-raise")->orderBy('created_at','desc')->take(3)->get();
      $blogPosts=BlogPosts::orderBy('created_at','desc')->take(6)->get();
      $products=Product::orderBy('created_at','desc')->take(6)->get();
      return view('index')->with([
        'audioFeed'=>$audioFeed,
        'blogPosts'=>$blogPosts,
        'products'=>$products

      ]);
    }


    public function about()
    {
        return view('pages/about')->with('url','About Us');
    }

    public function contact()
    {
        return view('pages/contact');
    }
    public function successDownload($title)
    {
        $title=str_replace("-"," ",$title);
        return view('pages/success')->with([
          "title"=>$title,
        ]);

    }


    public function mail()
{
   $name = 'emmer';
   Mail::to('laffbaze@gmail.com')->send(new SendMailable($name));

   return 'Email was sent';
}
}
