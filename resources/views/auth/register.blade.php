@extends('layouts.app')

@section('content')
  <br>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default log-form">
                <div class="login-form-haed panel-heading">
                  <h4>FRIENDS OF WORSHIP</h4>
                  <p>SIGN UP</p>
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <fieldset class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                          <label for="firstname">Firstname</label>
                          <input type="type" class="form-control" name="firstname" id="firstname" placeholder="Firstname"  value="{{ old('firstname') }}">
                          @if ($errors->has('firstname'))
                            <span class="help-block ">
                              <strong>{{ $errors->first('firstname') }}</strong>
                            </span>
                          @endif
                        </fieldset>
                        <fieldset class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                          <label for="lasstname">Lastname</label>
                          <input type="type" class="form-control" name="lastname" id="lasstname" placeholder="Lastname"  value="{{ old('lastname') }}">
                          @if ($errors->has('lastname'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('lastname') }}</strong>
                              </span>
                          @endif
                        </fieldset>

                        <fieldset class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                          <label for="username">Username</label>
                          <input type="type" class="form-control" name="username" id="username" placeholder="Username"  value="{{ old('username') }}">
                          @if ($errors->has('username'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('username') }}</strong>
                              </span>
                          @endif
                        </fieldset>
                        <fieldset class="form-group{{ $errors->has('phoneNo') ? ' has-error' : '' }}">
                          <label for="phoneNo">Phonen Number</label>
                          <input type="number" class="form-control" name="phoneNo" id="phoneNo" placeholder="Phone Number"  value="{{ old('phoneNo') }}">
                          @if ($errors->has('phoneNo'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('phoneNo') }}</strong>
                              </span>
                          @endif
                        </fieldset>
                        <fieldset class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                          <label for="email">Email</label>
                          <input type="email" class="form-control" name="email" id="email" placeholder="example@mail.com"  value="{{ old('email') }}">
                          @if ($errors->has('email'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </span>
                          @endif
                        </fieldset>

                        <fieldset class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                          <label for="Country">Country</label>
                          <select class="form-control country" required id="country" name="country" value="{{ old('country') }}">

                          </select>
                          @if ($errors->has('state'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('state') }}</strong>
                              </span>
                          @endif
                        </fieldset>

                        <fieldset class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                          <label for="city">City</label>
                          <input type="city" class="form-control" name="city" id="city" placeholder="Enter Your city"  value="{{ old('city') }}">
                          @if ($errors->has('city'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('city') }}</strong>
                              </span>
                          @endif
                        </fieldset>

                        <fieldset class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                          <label for="password">Password</label>
                          <input type="password" class="form-control" name="password" id="password" placeholder="******">
                          @if ($errors->has('password'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                        </fieldset>
                        <fieldset class="form-group">
                          <label for="confirm-p">Confirm Password</label>
                          <input type="password" class="form-control" name="password_confirmation" id="confirm-p" placeholder="******">
                        </fieldset>
                        <button type="submit" class="btn btn-primary center-block">Submit</button><br>
                         <a href="/login"><i class="pull-right"><b>Already have an account ?</b></i></a>
                         <input type="hidden" name="" value="" api="AIzaSyCteUysCxzWu9wgu7ytFmWOr3GF6Eg-Zw8">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
