<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Podcast;
use App\PodcastEpic;

class PodcastController extends Controller
{

  public function show()
  {
    $podcast=Podcast::get();
    $group=$podcast->groupBy('podcast_epic_id');
    return view("podcast/podcast")->with([
      "podcasts"=>$podcast,
      'groups'=>$group,
      'url'=>"FOW - Podcasts"
    ]);
  }

    public function createEpic(Request $request)
    {
      $this->validate($request,[
        'epic_title'=>'required',
      ]);
    $epic= new PodcastEpic();
    $epic->epic_title=$request->input('epic_title');
    $epic->save();

    return redirect('/admin/dashboard')->with('success', 'New episode created');

    }

public function CreatePodcast(Request $request)
{
  $this->validate($request,[
    'title'=>'required',
    'description'=>'required',
    'author'=>'required',
    'author_pic'=>'image|max:2999',
    'preview_image'=>'required|image|max:2999',
    'podcast'=>'required|max:20000',


  ]);

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

  if ($request->hasFile('author_pic')) {
  $fileWiithExt=$request->file('author_pic')->getClientOriginalName();

  $fileName=pathinfo($fileWiithExt,PATHINFO_FILENAME);
  //get extension only
  $fileEx=$request->file('author_pic')->getClientOriginalExtension();
  // file name to store
  $authfileNametoStore=$fileName.'_'.time().'.'.$fileEx;
  // upload image
  $path=$request->file('author_pic')->storeAs("public/uploads/images",$authfileNametoStore);
  }


  if ($request->hasFile('podcast')) {
  $podFileWiithExt=$request->file('podcast')->getClientOriginalName();

  $podFileileName=pathinfo($podFileWiithExt,PATHINFO_FILENAME);
  //get extension only
  $vfileEx=$request->file('podcast')->getClientOriginalExtension();
  // file name to store
  $podFileileNametoStore=$fileName.'_'.time().'.'.$vfileEx;
  // upload image
  $path=$request->file('podcast')->storeAs("public/uploads/podcasts",$podFileileNametoStore);
  }

  //Create New Podcast
  $podcast= new Podcast();
  $podcast->title=$request->input('title');
  $podcast->discription=$request->input('description');
  $podcast->author=$request->input('author');
  $podcast->author_pic=$authfileNametoStore;
  $podcast->podcast_epic_id=$request->input('episode');
  $podcast->preview_image=$fileNametoStore;
  $podcast->podcast=$podFileileNametoStore;
  $podcast->slug=str_slug($request->input('title'),'-');
  $podcast->save();

return redirect('/admin/dashboard/podcast')->with('success', 'Success::New Podcast created');

}

public function details($epic_ids,$slug)
{
  $podcast=Podcast::where("slug",$slug)->firstOrFail();
  $episodes=Podcast::where("podcast_epic_id",$epic_ids)->orderBy("created_at",'desc')->get();
  return view('podcast/podcast-details')->with([
    'podcast'=>$podcast,
    'episodes'=>$episodes,
    'url'=>"FOW - ".$podcast->title
  ]);
}

public function update(Request $request,$id)
{
  $this->validate($request,[
    'title'=>'required',
    'description'=>'required',
    'author'=>'required',
    'author_pic'=>'image|max:2999',
    'preview_image'=>'image|max:2999',
    'podcast'=>'|max:20000',


  ]);

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

  if ($request->hasFile('author_pic')) {
  $fileWiithExt=$request->file('author_pic')->getClientOriginalName();

  $fileName=pathinfo($fileWiithExt,PATHINFO_FILENAME);
  //get extension only
  $fileEx=$request->file('author_pic')->getClientOriginalExtension();
  // file name to store
  $authfileNametoStore=$fileName.'_'.time().'.'.$fileEx;
  // upload image
  $path=$request->file('author_pic')->storeAs("public/uploads/images",$authfileNametoStore);
  }


  if ($request->hasFile('podcast')) {
  $podFileWiithExt=$request->file('podcast')->getClientOriginalName();

  $podFileileName=pathinfo($podFileWiithExt,PATHINFO_FILENAME);
  //get extension only
  $vfileEx=$request->file('podcast')->getClientOriginalExtension();
  // file name to store
  $podFileileNametoStore=$fileName.'_'.time().'.'.$vfileEx;
  // upload image
  $path=$request->file('podcast')->storeAs("public/uploads/podcasts",$podFileileNametoStore);
  }

  //Create New Podcast
  $podcast=Podcast::find($id);
  $podcast->title=$request->input('title');
  $podcast->discription=$request->input('description');
  $podcast->author=$request->input('author');
  $podcast->podcast_epic_id=$request->input('episode');
  if ($request->hasFile('author_pic')){
    $podcast->author_pic=$authfileNametoStore;
  }
  if ($request->hasFile('preview_image')){
    $podcast->preview_image=$fileNametoStore;
  }
  if ($request->hasFile('podcast')){
    $podcast->podcast=$podFileileNametoStore;
  }
  $podcast->save();
return redirect('/admin/dashboard/podcast')->with('success', 'Success::Podcast updated');

}



}
