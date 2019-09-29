@extends('layouts.app')

  @section('content')

    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="jumbotron " style="background:white">
            <h2 class="display-3 text-success">Email Varification Sent</h2>
            <hr class="m-y-md">
            <p>you Should Receive Identification with your your varification link.</p>
            <p class="lead">
              <a class="btn btn-primary btn-lg" href="/login" role="button">Login</a>
            </p>
          </div>
        </div>
      </div>
    </div>



  @endsection
