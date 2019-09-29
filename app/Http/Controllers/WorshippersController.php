<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Worshippers;

class WorshippersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('artist/register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $this->validate($request,[
        'name'=>'required',
        'email'=>'required|email',
        'phoneNo'=>'required|numeric',
        'about'=>'required',
        'location'=>'required',
        'b-date'=>'required',
        'profile_image'=>'required|image|max:2999',
        'track'=>'required|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav|max:20000',
    ]);
    // Handle file Audio Upload
    if ($request->hasFile('profile_image')) {
    $fileWiithExt=$request->file('profile_image')->getClientOriginalName();

    $fileName=pathinfo($fileWiithExt,PATHINFO_FILENAME);
    //get extension only
    $fileEx=$request->file('profile_image')->getClientOriginalExtension();
    // file name to store
    $fileNametoStore=$fileName.'_'.time().'.'.$fileEx;
    // upload image
    $path=$request->file('profile_image')->storeAs("public/uploads/images",$fileNametoStore);
    }
    if ($request->hasFile('track')) {
    $vfileWiithExt=$request->file('track')->getClientOriginalName();

    $vfileName=pathinfo($vfileWiithExt,PATHINFO_FILENAME);
    //get extension only
    $vfileEx=$request->file('track')->getClientOriginalExtension();
    // file name to store
    $vfileNametoStore=$fileName.'_'.time().'.'.$vfileEx;
    // upload image
    $path=$request->file('track')->storeAs("public/uploads/audios",$vfileNametoStore);
    }

    //Create New Post
    $post= new Worshippers();
    $post->name=$request->input('name');
    $post->email=$request->input('email');
    $post->phoneNo=$request->input('phoneNo');
    $post->about=$request->input('about');
    $post->b_date=$request->input('b-date');
    $post->location=$request->input('location');
    $post->profile_image=$fileNametoStore;
    $post->track=$vfileNametoStore;
    $post->save();
    return redirect('/worshippers/register')->with('success', 'Post Created');

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
    public function destroy($id)
    {
        //
    }
}
