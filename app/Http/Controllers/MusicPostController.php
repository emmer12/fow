<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HelperController;
use App\MusicPost;
use App\Worshippers;
use App\User;


class MusicPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $music_posts=MusicPost::orderBy('title','desc')->paginate(2);
        return view('teams/music')->with("music_posts",$music_posts);

    }

    public function teams()
    {
      $crashedCarIds=MusicPost::pluck('user_id')->all();
      $worshipers=User::whereIn('id', $crashedCarIds)->get();
      $audio_by=User::find(1)->audios;
      return view('teams/team')->with(
        [
          "worshipers"=>$worshipers,
          'audio_by'=>$audio_by,
          "url"=>"Worshipers"
        ]);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
      //return str_slug('My awesome Title');
      try{
        $audio_post=MusicPost::where('slug',$slug)->firstOrFail();
        $artist=MusicPost::find($audio_post->id)->user()->first();
        return view('teams/single-audio')->with([
          "audio_post"=>$audio_post,
          "artist"=>$artist,
          "url"=>"FOW - ".$audio_post->title,
          "shearableAudio"=>true,
        ]);
      } catch (ModelNotFoundException $e) {
        return view('errors/404');
      }

    }

    public function profile($username)
    {
      $username=substr($username,1);
      $artist=User::where('username',$username)->first();
      if ($artist) {
        return view("artist/profileview")->with([
          "artist"=>$artist,
          "url"=>"FOW - @".$artist->username
        ]);
      }else {
        return view('errors/404');
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function allTracks(HelperController $helper)
     {
         $music_posts=MusicPost::orderBy('created_at','desc')->paginate(6);

         return view("teams/all-audio")->with([
           "music_posts"=>$music_posts,

         ]);

     }


    public function tracks(Request $request,$id,HelperController $helper )
    {
      try {
        $user=User::find($id);
        if ($user==null) {
          return view('errors/404');
        }
        $music_posts=User::find($id)->audios()->orderBy('created_at','desc')->paginate(6);
        $admin=$helper->adminCheck($id);
        return view("teams/audio")->with([
          "music_posts"=>$music_posts,
          "url"=>"track",
          "isAdmin"=>$admin,

        ]);
      } catch (FatalErrorException $e) {
        return view('errors/404');
      }

    }


    public function search(Request $request)
    {
      $query=$request->input('search');
      $items=MusicPost::where("title","LIKE",'%'.$query.'%')->where("status","1")->get();
      if (count($items) > 0) {
        return view('teams/team')->with(
          [
            "audios"=>$items,
            "url"=>"Artist",
            "searchMode"=>true
          ]);
      }else {
        return view('teams/team')->with([
          "searchMode"=>true,
          "notFound"=>"No result found"
        ]);
      }
    }

    public function storeAudio(Request $request,HelperController $helper)
    {
      $this->validate($request,[
        'title'=>'required',
        'discription'=>'required',
        'lyrics'=>'nullable',
        'artist_name'=>'nullable',
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
    $post->title=$request->input('title');
    $post->artist_name=$request->input('artist_name');
    $post->user_id=auth()->user()->id;
    $post->slug=str_slug($request->input('title'),'-');
    $post->discription=$request->input('discription');
    $post->lyric=$request->input('lyrics');
    if ($helper->adminCheck(auth()->user()->id)) {
      $post->status=true;
    }
    $post->preview_image=$fileNametoStore;
    $post->music=$vfileNametoStore;
    $post->save();
    if ($helper->adminCheck(auth()->user()->id)) {
    return redirect('/admin/dashboard/audio')->with('success', 'Success:Audio added');
  }else {
    return redirect('/dashboard/audio')->with('success', 'Success:Audio added');
  }
}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,HelperController $helper)
    {
      $this->validate($request,[
        'title'=>'required',
        'discription'=>'required',
        'lyrics'=>'nullable',
        'artist_name'=>'nullable',
        'preview_image'=>'image|max:2999',
        'audio'=>'max:20000',
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
    $post= MusicPost::find($id);
    $post->title=$request->input('title');
    $post->artist_name=$request->input('artist_name');
    $post->user_id=auth()->user()->id;
    $post->slug=str_slug($request->input('title'),'-');
    $post->discription=$request->input('discription');
    $post->lyric=$request->input('lyrics');
    if ($helper->adminCheck(auth()->user()->id)) {
      $post->status=true;
    }
      if ($request->hasFile('preview_image')) {
        $post->preview_image=$fileNametoStore;
      }
      if ($request->hasFile('audio')) {
        $post->music=$vfileNametoStore;
      }
    $post->save();
    if ($helper->adminCheck(auth()->user()->id)) {
      return redirect('/admin/dashboard/audio')->with('success', 'Success:Audio Updated');
    }
    else {
      return redirect('/dashboard/audio')->with('success', 'Success:Audio Updated');
    }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
