<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function register($value='emmer')
    {
      return view('artist/register');
    }


    public function register(Request $request )
    {
      $this->validate($request,[
        'title'=>'required',
        'discription'=>'required',
        'lyrics'=>'nullable',
        'preview_image'=>'required|image|max:2999',
        'audio'=>'required|max:20000',
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
    if ($request->hasFile('audio')) {
    $vfileWiithExt=$request->file('audio')->getClientOriginalName();

    $vfileName=pathinfo($vfileWiithExt,PATHINFO_FILENAME);
    //get extension only
    $vfileEx=$request->file('audio')->getClientOriginalExtension();
    // file name to store
    $vfileNametoStore=$fileName.'_'.time().'.'.$vfileEx;
    // upload image
    $path=$request->file('audio')->storeAs("public/uploads/audios",$vfileNametoStore);
    }

    //Create New Post
    $post= new MusicPost();
    $post->title=$req('title');
    $post->slug=str_slug($request->input('title'),'-');
    $post->discription=$request->input('discription');
    $post->lyric=$request->input('lyrics');
    $post->preview_image=$fileNametoStore;
    $post->music=$vfileNametoStore;
    $post->save();
    return redirect('/admin/dashboard/music')->with('success', 'Post Created');
    }
}
