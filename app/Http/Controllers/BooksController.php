<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HelperController;
use App\Books;
use App\BookCategory;

class BooksController extends Controller
{

  public function addCategory(Request $request)
  {
    $this->validate(request(), [
        'category'=>'required',
    ]);
    $bcat=new BookCategory();
    $bcat->name=$request->input("category");
    $bcat->discription="this-is-".$request->input("category")."-category";
    $bcat->save();
    return redirect()->back()->with('success', 'Success:Category added');

  }

  public function storeBook(Request $request,HelperController $helper)
  {
    $this->validate($request,[
      'title'=>'required',
      'description'=>'required',
      'author'=>'required',
      'price'=>'numeric',
      'qty'=>'numeric',
      'category'=>'required',
      'preview_image'=>'required|image|max:2999',
      'file'=>'required',
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

  if ($request->hasFile('file')) {
  $fileWiithExt=$request->file('file')->getClientOriginalName();

  $fileName=pathinfo($fileWiithExt,PATHINFO_FILENAME);
  //get extension only
  $fileEx=$request->file('file')->getClientOriginalExtension();
  // file name to store
  $fileNametoStore2=$fileName.'_'.time().'.'.$fileEx;
  // upload image
  $path=$request->file('file')->storeAs("public/uploads/books",$fileNametoStore2);
  }
  //Create New Post
  $post= new Books();
  $post->title=$request->input('title');
  $post->slug=str_slug($request->input('title'),'-');
  $post->description=$request->input('description');
  $post->price=$request->input('price');
  $post->qty=$request->input('qty');
  $post->author=$request->input('author');
  $post->category=$request->input('category');
  if ($helper->adminCheck(auth()->user()->id)) {
    $post->status=true;
  }
  $post->user_id=auth()->user()->id;
  $post->file=$fileNametoStore2;
  $post->preview_image=$fileNametoStore;
  $post->save();
  return redirect('/admin/dashboard/books')->with('success', 'Success:Book added to the store');

}
public function update(Request $request,$id,HelperController $helper)
{
  $this->validate($request,[
    'title'=>'required',
    'description'=>'required',
    'author'=>'required',
    'price'=>'numeric',
    'qty'=>'numeric',
    'category'=>'required',
    'preview_image'=>'image|max:2999',
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

if ($request->hasFile('file')) {
$fileWiithExt=$request->file('file')->getClientOriginalName();

$fileName=pathinfo($fileWiithExt,PATHINFO_FILENAME);
//get extension only
$fileEx=$request->file('file')->getClientOriginalExtension();
// file name to store
$fileNametoStore2=$fileName.'_'.time().'.'.$fileEx;
// upload image

$path=$request->file('file')->storeAs("public/uploads/books",$fileNametoStore2);
}
//Create New Post
$post=Books::find($id);
$post->title=$request->input('title');
$post->slug=str_slug($request->input('title'),'-');
$post->description=$request->input('description');
$post->price=$request->input('price');
$post->qty=$request->input('qty');
$post->author=$request->input('author');
$post->category=$request->input('category');
if ($helper->adminCheck(auth()->user()->id)) {
  $post->status=true;
}
$post->user_id=auth()->user()->id;
if ($request->hasFile('file')){
  $post->file=$fileNametoStore2;
}
if ($request->hasFile('preview_image')) {
  $post->preview_image=$fileNametoStore;
}
$post->save();

if ($helper->adminCheck(auth()->user()->id)) {
  return redirect('/admin/dashboard/books')->with('success', 'Success:Book Updated');
}
else {
  return redirect('/dashboard/books')->with('success', 'Success:Book Updated');

}

}
}
