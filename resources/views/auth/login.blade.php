@extends('layouts.app')

@section('content')
  <br>
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-4">
            <div class="panel panel-default log-form">
                <div class="login-form-haed panel-heading">
                  <h4>FRIENDS OF WORSHIP</h4>
                  <p>LOGIN</p>
                  @if (session('msg'))
                    <div class="alert alert-danger" role="alert">
                      <span class="ti ti-control-play"></span>
                      {{ session('msg')}}
                    </div>
                  @endif

                </div>

                <div class="panel-body ">
                  <div class="login-form">
                    <form  method="POST" action="{{ route('login.custom') }}" >
                      {{ csrf_field() }}
                      <fieldset class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="example@mail.com">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                      </fieldset>
                      <fieldset class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="******">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                      </fieldset>
                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <div class="checkbox">
                                  <label>
                                      <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                  </label>
                              </div>
                          </div>
                      </div>
                      <button type="submit" class="btn btn-primary center-block">LOGIN</button><br>
                      <a href="#"><b>Fogort password ?</b></a> <br>
                       <a href="/register"><i class="pull-right"><b>Don't have an account ?</b></i></a>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
