<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Haps;
class HapsController extends Controller
{
    public function index()
    {
      $haps=Haps::orderBy('created_at','desc')->paginate(6);
      return view("haps/index")->with([
        "haps"=>$haps
      ]);
    }

    public function create(Request $request)
    {
      $this->validate($request,[
        'title'=>'required',
        'description'=>'required',
        'price'=>'required',
        'venue'=>'required',
        'date'=>'required',
        'time'=>'required',
        'link'=>'required',
        'preview_image'=>'nullable|image|max:2999',
    ]);

    // Handle file Audio Upload
    if ($request->hasFile('preview_image')) {
    $fileWiithExt=$request->file('preview_image')->getClientOriginalName();

    $fileName=pathinfo($fileWiithExt,PATHINFO_FILENAME);
    //get extension only
    $fileEx=$request->file('preview_image')->getClientOriginalExtension();
    // file name to store
    $fileNametoStore=$fileName.'_'.time().'.'.$fileEx;
    // upload image
    $path=$request->file('preview_image')->storeAs("public/uploads/images",$fileNametoStore);
    }
    else {
      $fileNametoStore='default.jpg';
    }
    //Create New Post

    $post= new Haps();
    $post->title=$request->input('title');
    $post->description=$request->input('description');
    $post->venue=$request->input('venue');
    $post->date=$request->input('date');
    $post->time=$request->input('time');
    $post->link=$request->input('link');
    $post->price=$request->input('price');

    $post->display_pic=$fileNametoStore;
    $post->save();
      return redirect('/admin/dashboard/haps')->with('success', 'Success::Haps post created');
    }
}
