@extends('beautymail::templates.minty')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => 'Hello!',
        'level' => 'h1',
    ])

    @include('beautymail::templates.minty.contentStart')

        <p>You Are onyour way to confirm your email address {{$user}}</p>

    @include('beautymail::templates.minty.contentEnd')
  @include('beautymail::templates.minty.button',
   ['text' => 'Verify Email', 'link' => '#'])

@stop
