<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\VideoPost;
use App\HelperController;
use App\MusicPost;
use App\Category;
use App\Books;
use App\BookCategory;
use App\Product;
use App\ProductOtherImg;
use App\Podcast;
use App\PodcastEpic;
use App\BlogPosts;
use App\Volunteer;
use App\Worshippers;
use App\Requests;
use App\User;
use App\Role;
use App\Haps;
use App\Order;
use App\OrderProducts;

class AdminController extends Controller
{
  public function __construct()
  {
    //  $this->middleware('auth:admin');
  }
 public function orders()
 {
   $orders=Order::orderBy("created_at","decs")->paginate('6');
   $productO=OrderProducts::get();
   return view("admin/orders")->with([
     'orders'=>$orders,
     'productOrders'=>$productO,
   ]);
 }

public function productView()
{
  $products=Product::orderBy('created_at','desc')->paginate(6);
  return view('admin/product')->with([
    "products"=>$products,
  ]);
}

public function productViewAction($action,$id)
{
  $products=Product::orderBy('created_at','desc')->paginate(6);
  $product=Product::find($id);
  if ($action=="create") {
    return view('admin/product')->with([
      "products"=>$products,
      "create"=>true
    ]);
  }
  elseif ($action=="edit") {
    return view('admin/product')->with([
      "product"=>$product,
      "edit"=>true
    ]);
  }
}
public function blogView()
{
  $blogPost=BlogPosts::orderBy('created_at','desc')->paginate(6);
  $category=Category::orderBy('created_at','desc')->get();
  return view('admin/blog')->with([
    "blogposts"=>$blogPost,
  ]);
}

public function blogViewAction($action,$id)
{
  $blogPost=BlogPosts::orderBy('created_at','desc')->paginate(6);
  $category=Category::orderBy('created_at','desc')->get();
  if ($action=="create") {
    return view('admin/blog')->with([
      "blogposts"=>$blogPost,
      "categories"=>$category,
      "create"=>true
    ]);
  }
  elseif ($action=="edit") {
    $blog=BlogPosts::find($id);
    return view('admin/blog')->with([
      "blogposts"=>$blogPost,
      "blog"=>$blog,
      "categories"=>$category,
      "edit"=>true
    ]);
  }
}

    /**
     * Show the form admin podcast view
     *
     * @return \Illuminate\Http\Response
     */
public function podcastView()
{
  $podcasts=Podcast::orderBy('created_at','desc')->get();
  $episodes=PodcastEpic::orderBy('created_at','desc')->get();

  return view('admin/podcast')->with([
    "podcasts"=>$podcasts,
    "episodes"=>$episodes
  ]);
}
public function podcastViewAction($action,$id)
{
  $podcasts=Podcast::orderBy('created_at','desc')->get();
  $episodes=PodcastEpic::orderBy('created_at','desc')->get();
  if ($action=="create") {
    return view('admin/podcast')->with([
      "podcasts"=>$podcasts,
      "episodes"=>$episodes,
      "create"=>true
    ]);
  }
  elseif ($action=="edit") {
    $podcast=Podcast::find($id);
    return view('admin/podcast')->with([
      "podcast"=>$podcast,
      "podcasts"=>$podcasts,
      "episodes"=>$episodes,
      "edit"=>true
    ]);
  }
}
public function audioView()
{
  $audios=MusicPost::orderBy('created_at','desc')->paginate(6);
  return view('admin/audio')->with([
    "audios"=>$audios,
  ]);
}


public function audioViewAction($action,$id)
{
  $worshipers=User::orderBy('created_at','desc')->where('type', 'worshippers')->get();
  $audios=MusicPost::orderBy('created_at','desc')->paginate(6);
  if ($action=="create") {
    return view('admin/audio')->with([
      "audios"=>$audios,
      "worshippers"=>$worshipers,
      "create"=>true
    ]);
  }
  elseif ($action=="edit") {
    $audio=MusicPost::find($id);
    return view('admin/audio')->with([
      "audio"=>$audio,
      "audios"=>$audios,
      "edit"=>true,
    ]);
}
}


public function videoView()
{
  $videos=VideoPost::orderBy('created_at','desc')->paginate(6);
  return view('admin/video')->with([
    "videos"=>$videos,
  ]);
}
public function videoViewAction($action,$id)
{
  if ($action=="create") {
    return view('admin/video')->with([
      "create"=>true
    ]);
  }
  elseif ($action=="edit") {
    $video=VideoPost::find($id);
    return view('admin/video')->with([
      "video"=>$video,
      "edit"=>true,
    ]);
}
}
public function hapsView()
{
  $haps=Haps::orderBy('created_at','desc')->paginate(6);
  return view('admin/haps')->with([
    "haps"=>$haps,
  ]);
}
public function hapsViewAction($action,$id)
{
  $haps=Haps::orderBy('created_at','desc')->paginate(6);
  $hap=Haps::find($id);
  if ($action=="create") {
    return view('admin/haps')->with([
      "haps"=>$haps,
      "create"=>true,
      "hap"=>$hap,
    ]);
  }
}
public function bookView()
{
  $books=Books::orderBy('created_at','desc')->paginate(6);
  $categories=BookCategory::orderBy('created_at','desc')->get();
  return view('admin/books')->with([
    "books"=>$books,
    "categories"=>$categories,
  ]);
}
public function bookViewAction($action,$id)
{
  $books=Books::orderBy('created_at','desc')->paginate(6);
  $categories=BookCategory::orderBy('created_at','desc')->get();
  $book=Books::find($id);
  if ($action=="create") {
    return view('admin/books')->with([
      "books"=>$books,
      "categories"=>$categories,
      "create"=>true,
    ]);
  }
  elseif ($action=="edit") {
    return view('admin/books')->with([
      "books"=>$books,
      "categories"=>$categories,
      "edit"=>true,
      "book"=>$book,
    ]);
}
}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_notifcation()
    {
        $requests=Requests::orderBy('created_at','desc')->paginate(6);
        return view('user/admin-notification')->with([
          "requests"=>$requests,
        ]);
    }

    public function approve_author(Request $request)
    {
      if ($request->ajax()) {
        $id=$request->input('id');
        $action=$request->input('action');
        if ($request->input('item')=="book") {
          if ($action=="Approve") {
            $user=Books::where('id',$id)->update([
              'status'=>1,
            ]);
            return response(['success'=>true,"action"=>$action]);
          }else {
            $user=Books::where('id',$id)->update([
              'status'=>0,
            ]);
            return response(['success'=>true,"action"=>$action]);
          }
        }

        if ($request->input('item')=="audio") {
          if ($action=="Approve") {
            $user=MusicPost::where('id',$id)->update([
              'status'=>1,
            ]);
            return response(['success'=>true,"action"=>$action]);
          }else {
            $user=MusicPost::where('id',$id)->update([
              'status'=>0,
            ]);
            return response(['success'=>true,"action"=>$action]);
          }
        }

        if ($request->input('item')=="blog") {
          if ($action=="Approve") {
            $user=BlogPosts::where('id',$id)->update([
              'status'=>1,
            ]);
            return response(['success'=>true,"action"=>$action]);
          }else {
            $user=BlogPosts::where('id',$id)->update([
              'status'=>0,
            ]);
            return response(['success'=>true,"action"=>$action]);
          }
        }

      }

    }

    public function approve(Request $request)
    {
      $id=$request->input('id');
      $user=User::where('id', $request->input('userId'))->first();
      $user->roles()->attach(Role::where('name','Author')->first());

      $req=Requests::find($id);
      $req->delete();
      return redirect()->back()->with('msg', 'Role as been assigined to user');

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
  $post->lyric=$request->input('lyrics');
  $post->preview_image=$fileNametoStore;
  $post->video=$vfileNametoStore;
  $post->save();
  return redirect('/admin/dashboard')->with('success', 'Post Created');

    }


    /**


  ***  Audio post Process


  **/

    public function storeAudio(Request $request)
    {
      $this->validate($request,[
        'title'=>'required',
        'discription'=>'required',
        'lyrics'=>'nullable',
        'artist_name'=>'nullable',
        'author_id'=>'required|numeric',
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
    $post->worshippers_id=$request->input('author_id');
    $post->slug=str_slug($request->input('title'),'-');
    $post->discription=$request->input('discription');
    $post->lyric=$request->input('lyrics');
    $post->preview_image=$fileNametoStore;
    $post->music=$vfileNametoStore;
    $post->save();
    return redirect('/admin/dashboard/music')->with('success', 'Post Created');

    }


    /**


  ***  Product post Process


  **/

    public function storeProduct(Request $request)
    {
      $this->validate($request,[
        'product_title'=>'required',
        'product_discription'=>'required',
        'product_price'=>'required|numeric',
        'category'=>'required',
        'preview_image'=>'required|image|max:2999',
        'preview_image2'=>'nullable|image|max:2999',
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

    if ($request->hasFile('preview_image2')) {
    $fileWiithExt=$request->file('preview_image2')->getClientOriginalName();

    $fileName=pathinfo($fileWiithExt,PATHINFO_FILENAME);
    //get extension only
    $fileEx=$request->file('preview_image2')->getClientOriginalExtension();
    // file name to store
    $fileNametoStore2=$fileName.'_'.time().'.'.$fileEx;
    // upload image
    $path=$request->file('preview_image2')->storeAs("public/uploads/images",$fileNametoStore2);
    }
    else {
      $fileNametoStore2='default.jpg';
    }


    //Create New Post
    $post= new Product();
    $post->product_title=$request->input('product_title');
    $post->slug=str_slug($request->input('product_title'),'-');
    $post->product_discription=$request->input('product_discription');
    $post->product_price=$request->input('product_price');
    $post->category=$request->input('category');
    $post->preview_image=$fileNametoStore;
    $post->preview_image2=$fileNametoStore2;
    $post->save();
    return redirect('/admin/dashboard/product')->with('success', 'Post Created');

    }

    /**


  ***  Product post Process


  **/


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function navigate($route)
    {
        $volunteers=Volunteer::get();
        $audio=MusicPost::get();
        $video=VideoPost::get();
        $blog=BlogPosts::get();
        $product=Product::get();
        $worshipers=Worshippers::get();

        return view('/admin/'.$route)->with([
          "volunteers"=>$volunteers,
          "audios"=>$audio,
          "videos"=>$video,
          "blogs"=>$blog,
          "products"=>$product,
          "worshipers"=>$worshipers,
        ]);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,HelperController $helper)
    {
          if($request->ajax()) {
            $id=$request->input('id');
            $item=$request->input('item');
            if ($item == "product") {
              if ($helper->adminCheck(auth()->user()->id)) {
                $post=Product::find($id);
                $otherImgs=ProductOtherImg::where('product_id',$id)->get();
                if (count($otherImgs)<0) {
                  foreach ($otherImgs as $otherImg) {
                    Storage::delete("public/uploads/images/".$otherImg->other_img);
                    $otherImg->delete();
                  }
                }
                Storage::delete("public/uploads/images/".$post->preview_image);
                $post->delete();
              }
            };
            if ($item == "book") {
              $post=Books::find($id);
              if ($helper->adminCheck(auth()->user()->id)) {
                Storage::delete("public/uploads/images/".$post->preview_image);
                $post->delete();
              }else {
                if ($post->user_id==auth()->user()->id) {
                  Storage::delete("public/uploads/images/".$post->preview_image);
                  Storage::delete("public/uploads/images/".$post->file);
                  $post->delete();
                }else {
                  return response(['error'=>"you are not permited to delete this item"]);
                }
              }
            }
            if ($item == "podcast") {
              $post=Podcast::find($id);
              if ($helper->adminCheck(auth()->user()->id)) {
                Storage::delete("public/uploads/images/".$post->preview_image);
                Storage::delete("public/uploads/podcasts/".$post->podcast);
                $post->delete();
              }else {
                  return response(['error'=>"you are not permited to delete this item"]);
              }
            }
            if ($item == "video") {
              $post=VideoPost::find($id);
              if ($helper->adminCheck(auth()->user()->id)){
                Storage::delete("public/uploads/images/".$post->preview_image);
                Storage::delete("public/uploads/videos/".$post->video);
                $post->delete();
              }else {
                  return response(['error'=>"you are not permited to delete this item"]);
              }
            }
            if ($item == "audio") {
              $post=MusicPost::find($id);
              if ($helper->adminCheck(auth()->user()->id)) {
                Storage::delete("public/uploads/images/".$post->preview_image);
                Storage::delete("public/uploads/audio/".$post->music);
                $post->delete();
              }else {
                if ($post->user_id==auth()->user()->id) {
                  Storage::delete("public/uploads/images/".$post->preview_image);
                  Storage::delete("public/uploads/audios/".$post->music);
                  $post->delete();
                }else {
                  return response(['error'=>"you are not permited to delete this item"]);
                }
              }
            }
            if ($item == "blog") {
              $post=BlogPosts::find($id);
              if ($helper->adminCheck(auth()->user()->id)) {
                Storage::delete("public/uploads/images/".$post->preview_image);
                $post->delete();
              }else {
                if ($post->user_id==auth()->user()->id) {
                  Storage::delete("public/uploads/images/".$post->preview_image);
                  $post->delete();
                }else {
                  return response(['error'=>"you are not permited to delete this item"]);
                }
              }
            }
            if ($item == "haps") {
              $post=Haps::find($id);
              if ($helper->adminCheck(auth()->user()->id)) {
                Storage::delete("public/uploads/images/".$post->display_pic);
                $post->delete();
              }
              else {
                  return response(['error'=>"you are not permited to delete this item"]);
                }
              }

            return response(['success'=>"Post Removed","id"=>$id]);
        }
    }
}
