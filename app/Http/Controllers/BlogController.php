<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HelperController;
use App\BlogPosts;
use App\User;
use App\Category;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$blogPost=BlogPosts::where("type","news")->orWhere("type","fund-raise")->orderBy('created_at','desc')->paginate(3);
        $blogPost=BlogPosts::orderBy('created_at','desc')->where("status",1)->paginate(6);
        $category=Category::orderBy('created_at','desc')->get();
        $user=User::all();
        return view('blog/blog')->with([
          'blogPosts'=>$blogPost,
          "user"=>$user,
          "categories"=>$category,
          "url"=>"FOW - Blog"
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function create(Request $request,HelperController $helper)
      {
        $this->validate($request,[
          'title'=>'required',
          'id'=>'required',
          'body'=>'required',
          'category'=>'required',
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
      $tags='';
      $tags_o=$request->input('tags');
      $tags_o=json_decode($tags_o);
      foreach ($tags_o as $tag) {
        $tags.=$tag->value.",";
      }
      $post= new BlogPosts();
      $post->title=$request->input('title');
      $post->slug=str_slug($request->input('title'),'-');
      $post->body=$request->input('body');
      $post->category=$request->input('category');
      $post->user_id=$request->input('id');
      $post->tags=$tags;
      if ($helper->adminCheck($request->input('id'))) {
        $post->status=true;
      }
      $post->preview_image=$fileNametoStore;
      $post->save();
      if ($helper->adminCheck(auth()->user()->id)) {
        return redirect('/admin/dashboard/blog')->with('success', 'Success::Blog post created');
      }
      else {
        return redirect('/dashboard/blog')->with('success', 'Success::Blog post created');
      }
      }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
      $userRole="";
      $blogPost=BlogPosts::where("slug",$slug)->where("status",1)->firstOrFail();
      $related = BlogPosts::where('category',$blogPost->category)->where('id', '!=', $blogPost->id)->take(3)->where("status",1)->get();
      $category=Category::orderBy('created_at','desc')->get();

      if (auth()->user()) {
        $userId=auth()->user()->id;
        $access=User::find($userId)->access;
        foreach ($access as $i =>$roles) {
          $userRole.=$roles->name." ";
        }
        $userRole=explode(" ",$userRole);
        array_pop($userRole);
      }
      else {
        $userRole=["User"];
      }
      return view('blog/single-blog')->with([
        'blogPost'=>$blogPost,
        'userRole'=>$userRole,
        'categories'=>$category,
        'relatedposts'=>$related,
        'url'=>"FOW - ".$blogPost->title,
        'shearableblog'=>true
      ]);
    }


    public function category($category)
    {
      $categorizedPost=BlogPosts::orderBy('created_at','desc')->where("category",$category)->where("status",1)->paginate(6);
      $categorys=Category::orderBy('created_at','desc')->get();
      return view('blog/category-blog')->with([
        'blogPostCategory'=>$categorizedPost,
        'categories'=>$categorys,
        'url'=>"FOW - ".$category
      ]);
    }

    public function tag($tag)
    {
      $tags=BlogPosts::orderBy('created_at','desc')->where("tags","like","%".$tag."%")->where("status",1)->paginate(6);
      $category=Category::orderBy('created_at','desc')->get();
      return view('blog/tag-blog')->with([
        'blogPostTag'=>$tags,
        'categories'=>$category,
        'url'=>"FOW tag - ".$tag
      ]);
    }

    public function allBlogPost()
    {
      $blogPost=BlogPosts::orderBy('created_at','desc')->paginate(2);
      $category=Category::orderBy('created_at','desc')->get();

      return view('admin/admin-blogpost')->with([
        'blogPosts'=>$blogPost,
        'categories'=>$category,
        'url'=>"FOW - Blog"

      ]);
    }

    public function approvalAction(Request $request)
    {
      $post=BlogPosts::find($request->input('post_id'));
      if ($request->input('status')) {
        $post->status=1;
      }
      else {
        $post->approved=0;
      }
      $post->save();
      return redirect()->back();
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        'id'=>'required',
        'body'=>'required',
        'category'=>'required',
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
    //Create New Post
    $tags='';
    $tags_o=$request->input('tags');
    $tags_o=json_decode($tags_o);
    foreach ($tags_o as $tag) {
      $tags.=$tag->value.",";
    }
    $post=BlogPosts::find($id);
    $post->title=$request->input('title');
    $post->slug=str_slug($request->input('title'),'-');
    $post->body=$request->input('body');
    $post->category=$request->input('category');
    $post->user_id=$request->input('id');
    $post->tags=$tags;
    if ($helper->adminCheck($request->input('id'))) {
      $post->status=true;
    }
    if ($request->hasFile('preview_image')) {
      $post->preview_image=$fileNametoStore;
    }
    $post->save();
      if ($helper->adminCheck(auth()->user()->id)) {
        return redirect('/admin/dashboard/blog')->with('success', 'Success::Blog Updated');
      }else {
        return redirect('/dashboard/blog')->with('success', 'Success::Blog Updated');
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
