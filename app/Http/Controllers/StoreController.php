<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Product;
use App\ProductOtherImg;
use App\BookCategory;
use App\Books;

class StoreController extends Controller
{
     public function bookStore()
     {
       $books=Books::orderBy('created_at','desc')->paginate(9);
       $bookCategories=BookCategory::orderBy('created_at','desc')->get();
       return view("store/products-books")->with([
         "url"=>"FOW - books Store",
         "books"=>$books,
         "bookCategories"=>$bookCategories,

       ]);
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function cart()
    {
        $products=Product::orderBy('product_title','desc')->paginate(1);
        return view("store/cart")->with("products",$products);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout()
    {
        $products=Product::orderBy('product_title','desc')->paginate(1);
        if (Cart::count()==0) {
          return redirect(route("store-page"));
        }
        return view("store/checkout")->with([
          "products"=>$products,
          'url'=>"FOW - Checkout"
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::orderBy('product_title','desc')->paginate(6);
        return view("store/products")->with([
          "products"=>$products,
          'url'=>"FOW - Store"
        ]);
    }


        /**
         * Display Category
         *
         * @return \Illuminate\Http\Response
         */


    public function category($category)
    {
        $category=ucwords(str_replace('-', ' ', $category));
        $books=Books::where('category',$category)->orderBy('created_at','desc')->paginate(6);
        $bookCategories=BookCategory::orderBy('created_at','desc')->get();
        $count=count($books);
        return view("store/products-books-category")->with([
          "books"=>$books,
          "count"=>$count,
          "bookCategories"=>$bookCategories,
          "thisCategory"=>$category,
          'url'=>"FOW - ".$category

        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function storeProduct(Request $request)
     {
       $this->validate($request,[
         'product_title'=>'required',
         'product_discription'=>'required',
         'product_price'=>'required|numeric',
         'qty'=>'required|numeric',
         'product_discount_price'=>'required|numeric',
         'preview_image'=>'required|image|max:2999',
         'additional_img.*'=>'image|max:2999',
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

     if ($request->hasFile('additional_img')) {
       foreach($request->file('additional_img') as $file)
            {
              $fileWiithExt=$file->getClientOriginalName();
              $fileName=pathinfo($fileWiithExt,PATHINFO_FILENAME);
              $fileEx=$file->getClientOriginalExtension();
              $fileNametoStore2=$fileName.'_'.time().'.'.$fileEx;
              $path=$file->storeAs("public/uploads/images",$fileNametoStore2);
                $data[] = $fileNametoStore2;
            }
        }

     //Create New Post
     $post= new Product();
     $post->product_title=$request->input('product_title');
     $post->slug=str_slug($request->input('product_title'),'-');
     $post->product_discription=$request->input('product_discription');
     $post->product_price=$request->input('product_price');
     $post->discount_price=$request->input('product_discount_price');
     $post->qty=$request->input('qty');
     $post->status=true;
     $post->preview_image=$fileNametoStore;
     $post->save();

     // $otherImg=new ProductOtherImg();
     // foreach ($data as $img) {
     //   $otherImg->product_id=$post->id;
     //   $otherImg->other_img=$img;
     //   $otherImg->save();
     // }
     foreach ($data as $img) {
       ProductOtherImg::create([
         'product_id'=>$post->id,
         'other_img'=>$img,
       ]);
     }
     return redirect('/admin/dashboard/product')->with('success', 'Success:Product added to the store');

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
      $product=Product::where('slug',$slug)->firstOrFail();
      $images=ProductOtherImg::where('product_id',$product->id)->get();

      return view('store/single-product')->with([
        "product"=>$product,
        "images"=>$images,
        'url'=>"FOW - ".$product->product_title
      ]);
    }

    public function showBook($slug)
    {
      $book=Books::where('slug',$slug)->firstOrFail();
      return view('store/single-book')->with([
        "book"=>$book,
        "url"=>"FOW - ".$book->title
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
        $this->validate($request,[
          'product_title'=>'required',
          'product_discription'=>'required',
          'product_price'=>'required|numeric',
          'qty'=>'required|numeric',
          'product_discount_price'=>'required|numeric',
          'preview_image'=>'image|max:2999',
          'additional_img.*'=>'image|max:2999',
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

      if ($request->hasFile('additional_img')) {
        foreach($request->file('additional_img') as $file)
             {
               $fileWiithExt=$file->getClientOriginalName();
               $fileName=pathinfo($fileWiithExt,PATHINFO_FILENAME);
               $fileEx=$file->getClientOriginalExtension();
               $fileNametoStore2=$fileName.'_'.time().'.'.$fileEx;
               $path=$file->storeAs("public/uploads/images",$fileNametoStore2);
                 $data[] = $fileNametoStore2;
             }
         }

      //Create New Post
      $post= Product::find($id);
      $post->product_title=$request->input('product_title');
      $post->slug=str_slug($request->input('product_title'),'-');
      $post->product_discription=$request->input('product_discription');
      $post->product_price=$request->input('product_price');
      $post->discount_price=$request->input('product_discount_price');
      $post->qty=$request->input('qty');
      $post->status=true;
      if ($request->hasFile('preview_image')) {
        $post->preview_image=$fileNametoStore;
      }
      $post->save();
      if ($request->hasFile('additional_img')) {
        foreach ($data as $img) {
          ProductOtherImg::create([
            'product_id'=>$post->id,
            'other_img'=>$img,
          ]);
        }
      }
      return redirect('/admin/dashboard/product')->with('success', 'Success:Product Updated');

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
