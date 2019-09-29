<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\HelperController;
use App\User;
use App\PodcastEpic;
use App\Podcast;
use App\BookCategory;
use App\Books;
use App\BlogPosts;
use App\Store;
use App\MusicPost;
use App\Category;
use App\Order;
use App\OrderProducts;

class UserController extends Controller
{
    /**
     * Display User Dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_dash()
    {
        return view('user/dashboard');
    }

    public function customer_dash()
    {
        return view('customer/dashboard');
    }

    public function blogView()
    {
      $id=auth()->user()->id;
      $category=Category::orderBy('created_at','desc')->get();
      $blogPost=User::find($id)->posts()->orderBy('created_at','desc')->paginate(6);
      return view('user/blog')->with([
        "blogposts"=>$blogPost,
        'categories'=>$category
      ]);
    }

    public function blogViewAction($action,$id)
    {
      $blogPost=User::find($id)->posts()->orderBy('created_at','desc')->paginate(6);
      $category=Category::orderBy('created_at','desc')->get();
      $blog=BlogPosts::find($id);
      if ($action=="create") {
        return view('user/blog')->with([
          "create"=>true,
          "blogposts"=>$blogPost,
          'categories'=>$category
        ]);
      }
      elseif ($action=="edit") {
        return view('user/blog')->with([
          "blog"=>$blog,
          "edit"=>true,
          "blogposts"=>$blogPost,
          'categories'=>$category
        ]);
      }
    }

    public function audioView()
    {
      $id=auth()->user()->id;
      $audios=User::find($id)->userAudioPost()->orderBy('created_at','desc')->paginate(6);
      return view('user/audio')->with([
        "audios"=>$audios,
      ]);
    }


    public function audioViewAction($action,$id)
    {
      $userId=auth()->user()->id;
      $worshipers=User::orderBy('created_at','desc')->where('type', 'worshippers')->get();
      $audios=User::find($userId)->userAudioPost()->orderBy('created_at','desc')->paginate(6);;
      if ($action=="create") {
        return view('user/audio')->with([
          "create"=>true,
          "audios"=>$audios
        ]);
      }
      elseif ($action=="edit") {
        $audio=MusicPost::findOrfail($id);
        return view('user/audio')->with([
          "audio"=>$audio,
          "audios"=>$audios,
          "edit"=>true,
        ]);
    }
    }

    public function bookView()
    {
      $id=auth()->user()->id;
      $books=User::find($id)->userBookPost()->orderBy('created_at','desc')->paginate(6);;
      $categories=BookCategory::orderBy('created_at','desc')->get();
      return view('user/books')->with([
        "books"=>$books,
        "categories"=>$categories,
      ]);
    }
    public function bookViewAction($action,$id)
    {
      $idd=auth()->user()->id;
      $books=User::find($idd)->userBookPost()->orderBy('created_at','desc')->paginate(6);;
      $userId=auth()->user()->id;
      $categories=BookCategory::orderBy('created_at','desc')->get();
      if ($action=="create") {
        return view('user/books')->with([
          "categories"=>$categories,
          "books"=>$books,
          "create"=>true,
        ]);
      }
      elseif ($action=="edit") {
        $book=Books::findOrfail($id);
        return view('user/books')->with([
          "book"=>$book,
          "books"=>$books,
          "categories"=>$categories,
          "edit"=>true,
        ]);
    }
    }

    public function profileAdminView($id,HelperController $helper)
    {
      $username=substr($id,1);
      if ($username == auth()->user()->username) {
        $user=User::where('username',$username)->first();
        return view("admin/profile")->with([
          'user'=>$user,
          'isAdmin'=>$helper->adminCheck(auth()->user()->id),
          'userAdmin'=>$helper->userAdminCheck(auth()->user()->id),
        ]);
      }else {
        return "no";
      }
    }

    public function profile($id,HelperController $helper)
    {
      $username=substr($id,1);
      if ($username == auth()->user()->username) {
        $user=User::where('username',$username)->first();
        return view("admin/profile")->with([
          'user'=>$user,
          'isAdmin'=>$helper->adminCheck(auth()->user()->id),
          'userAdmin'=>$helper->userAdminCheck(auth()->user()->id),


        ]);
      }else {
        return redirect('/');
      }
    }
    /**
     * Display Admin Dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_dash()
    {
      $episodes=PodcastEpic::orderBy('created_at','desc')->get();
      $products=Store::get();
      $podcast=Podcast::get();
      $audio=MusicPost::get();
        return view('admin/admin-dashboard')->with([
          "episodes"=>$episodes,
          "products"=>$products,
          "podcast"=>$podcast,
          "audio"=>$audio,
        ]);
    }

    /**
     * Display Author Dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function author_dash()
    {
      $roles=User::find(1)->roleRedirect('Admin');
      $user_id=auth()->user()->id;
      $posts=User::find($user_id)->posts;
      return view('user/author-dashboard')->with([
        'role'=>$roles,
        'posts'=>$posts
      ]);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectFromNav()
    {
      if (User::find(1)->roleRedirect('Admin')){
        return redirect()->route('admin.dashboard');
      }
      elseif(User::find(1)->roleRedirect('Customer')) {
        return redirect()->route('customer.dashboard');
      }
      else{
        return redirect('/dashboard');
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orders(Request $request,$msg=null)
    {
        $orders=Order::where('customer_id',auth()->user()->id)->orderBy("created_at","decs")->paginate('6');
        $productO=OrderProducts::get();
        if ($msg) {
        Session::flash('message', 'Success::Thank You,Your Order Was Completed successfully you can call this number to track your order **08075264646**');
        }
        return view("user/orders")->with([
          'orders'=>$orders,
          'productOrders'=>$productO,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id )
    {
      $this->validate($request,[
        'firstname'=>'required',
        'lastname'=>'required',
        'email'=>'required|unique:users,email,'.$id,
        'username'=>'required|unique:users,username,'.$id,
        'phoneNo'=>'required',
        'city'=>'required',
        'profile_picture'=>'nullable|image|max:2999',
    ]);

    // Handle file Audio Upload
    if ($request->hasFile('profile_picture')) {
    $fileWiithExt=$request->file('profile_picture')->getClientOriginalName();

    $fileName=pathinfo($fileWiithExt,PATHINFO_FILENAME);
    //get extension only
    $fileEx=$request->file('profile_picture')->getClientOriginalExtension();
    // file name to store
    $fileNametoStore=$fileName.'_'.time().'.'.$fileEx;
    // upload image
    $path=$request->file('profile_picture')->storeAs("public/uploads/images",$fileNametoStore);
    }

    $user=User::find($id);
    $user->username=$request->input('username');
    $user->firstname=$request->input("firstname");
    $user->lastname=$request->input('lastname');
    $user->city=$request->input('city');
    $user->phoneNo=$request->input('phoneNo');
    $user->email=$request->input('email');
    $user->bio=$request->input('bio');
    $user->twitter_username=$request->input('twitter');
    $user->facebook_link=$request->input('facebook_link');

    if ($request->hasFile('profile_picture')) {
      $user->profile_picture=$fileNametoStore;
    }
    $user->save();
    return redirect(route("admin.profile",'@'.auth()->user()->username))->with('success', 'Success::Profile Updated');
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
