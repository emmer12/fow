<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VideoPost;

class VideoPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $video_posts=VideoPost::orderBy('title','desc')->paginate(2);
      return view('teams/video')->with("video_posts",$video_posts);
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
     public function storeVideo(Request $request)
     {
       $this->validate($request,[
         'title'=>'required',
         'discription'=>'required',
         'lyrics'=>'nullable',
         'preview_image'=>'required|image|max:2999',
         'video'=>'required|mimes:mp4,webm,ogg|max:20000',
   ]);

   // Handle file Upload
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
   if ($request->hasFile('video')) {
     $vfileWiithExt=$request->file('video')->getClientOriginalName();

     $vfileName=pathinfo($vfileWiithExt,PATHINFO_FILENAME);
     //get extension only
     $vfileEx=$request->file('video')->getClientOriginalExtension();
     // file name to store
     $vfileNametoStore=$fileName.'_'.time().'.'.$vfileEx;
     // upload image
     $path=$request->file('video')->storeAs("public/uploads/videos",$vfileNametoStore);
   }


   //Create New Post
   $post= new VideoPost();
   $post->title=$request->input('title');
   $post->slug=str_slug($request->input('title'),'-');
   $post->discription=$request->input('discription');
   $post->artist_name=$request->input('artist_name');
   $post->lyric=$request->input('lyrics');
   $post->preview_image=$fileNametoStore;
   $post->video=$vfileNametoStore;
   $post->save();
   return redirect('/admin/dashboard/video')->with('success', 'Success::Video Created');

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
      try {
        $video_post=VideoPost::where('slug',$slug)->firstOrFail();
        return view('pages/single')->with("video_post",$video_post);

      } catch (ModelNotFoundException $e) {
        return 'view(pages/404)';
      }



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request,[
        'title'=>'required',
        'discription'=>'required',
        'lyrics'=>'nullable',
        'preview_image'=>'image|max:2999',
        'video'=>'mimes:mp4,webm,ogg|max:20000',
  ]);

  // Handle file Upload
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
  if ($request->hasFile('video')) {
    $vfileWiithExt=$request->file('video')->getClientOriginalName();

    $vfileName=pathinfo($vfileWiithExt,PATHINFO_FILENAME);
    //get extension only
    $vfileEx=$request->file('video')->getClientOriginalExtension();
    // file name to store
    $vfileNametoStore=$fileName.'_'.time().'.'.$vfileEx;
    // upload image
    $path=$request->file('video')->storeAs("public/uploads/videos",$vfileNametoStore);
  }


  //Update Post
  $post=VideoPost::find($id);
  $post->title=$request->input('title');
  $post->slug=str_slug($request->input('title'),'-');
  $post->discription=$request->input('discription');
  $post->artist_name=$request->input('artist_name');
  $post->lyric=$request->input('lyrics');
  if ($request->hasFile('video')) {
    $post->video=$vfileNametoStore;
  }
  if ($request->hasFile('preview_image')) {
    $post->preview_image=$fileNametoStore;
  }
  $post->save();
  return redirect('/admin/dashboard/video')->with('success', 'Success::Video Updated');
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
