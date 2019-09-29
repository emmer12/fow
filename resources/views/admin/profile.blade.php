@extends("layouts.app")
{{-- elevation worship backgreund:#eeeeef --}}
<style media="screen">

</style>
@section("content")
  @if ($isAdmin)
      @include('inc/drawer-admin')
    @else
      @if (!$userAdmin)
        @include('inc/drawer-customer')
        @else
          @include('inc/drawer-user')
      @endif
  @endif
  <style media="screen">
  .profile{
    background: white;
    padding: 20px
  }
  .profile input{
    border:none;
    outline: none
  }
    .profile .profile-pic img {
      width: 120px;
      height: 120px;
      cursor: pointer;
      padding: 10px;

    }
    .profile .profile-pic{
      width:150px;
      padding: 10px;
      margin:0px auto;
      border:2px dashed grey
    }
    /* .profile .body{
      padding: 10px;
      background: white
    } */
  </style>
  <br>
   <div class="container">
     <div class="row">
       <div class="col-md-3">
       </div>
       <div class="col-md-9">
          <div class="profile">
            @if (session('success'))
              <div class="alert alert-success" role="alert">
               {{ session('success')}}
              </div>
            @endif
            @if (count($errors) > 0)
              @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                  {{ $error }}
                </div>
              @endforeach
            @endif
            <form class="" action="{{route("profile.update",$user->id)}}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              {{ method_field("PATCH") }}
              <fieldset class="form-group profile-pic text-center">
                <label for="profile_picture"><img src="/storage/uploads/images/{{$user->profile_picture}}" alt=""> </label>
                <span class="edit"> <i class="glyphicon glyphicon-edit"></i> </span>
                <input value="" type="file" name="profile_picture" class="form-control hide"  id="profile_picture">
              </fieldset>
              <div class="body">
                <fieldset class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                  <label for="firstname">Firstname</label>
                  <input type="type" class="form-control" name="firstname" id="firstname" placeholder="Firstname"  value="{{ $user->firstname }}">
                  @if ($errors->has('firstname'))
                    <span class="help-block ">
                      <strong>{{ $errors->first('firstname') }}</strong>
                    </span>
                  @endif
                </fieldset>
                <fieldset class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                  <label for="lasstname">Lastname</label>
                  <input type="type" class="form-control" name="lastname" id="lasstname" placeholder="Lastname"  value="{{ $user->lastname }}">
                  @if ($errors->has('lastname'))
                      <span class="help-block">
                          <strong>{{ $errors->first('lastname') }}</strong>
                      </span>
                  @endif
                </fieldset>
                <fieldset class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                  <label for="username">Username</label>
                  <input type="type" class="form-control" name="username" id="username" placeholder="Username"  value="{{$user->username}}">
                  @if ($errors->has('username'))
                      <span class="help-block">
                          <strong>{{ $errors->first('username') }}</strong>
                      </span>
                  @endif
                </fieldset>
                <fieldset class="form-group{{ $errors->has('phoneNo') ? ' has-error' : '' }}">
                  <label for="phoneNo">Phone Number</label>
                  <input type="number" class="form-control" name="phoneNo" id="phoneNo" placeholder="Phone Number"  value="{{$user->phoneNo}}">
                  @if ($errors->has('phoneNo'))
                      <span class="help-block">
                          <strong>{{ $errors->first('phoneNo') }}</strong>
                      </span>
                  @endif
                </fieldset>
                <fieldset class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                  <label for="state">City</label>
                  <input type="string" class="form-control" name="city" id="city" placeholder="City"  value="{{$user->city}}">
                  @if ($errors->has('city'))
                      <span class="help-block">
                          <strong>{{ $errors->first('city') }}</strong>
                      </span>
                  @endif
                </fieldset>
                <fieldset class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="example@mail.com"  value="{{$user->email}}">
                  @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
                </fieldset>
                <fieldset class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="bio">Bio</label>
                  <textarea name="bio" rows="3" cols="10" class="form-control"  id='bio' ></textarea>
                  @if ($errors->has('bio'))
                      <span class="help-block">
                          <strong>{{ $errors->first('bio') }}</strong>
                      </span>
                  @endif
                </fieldset>
                <fieldset class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="facebook-link">Facebook Link</label>
                  <input type="url" class="form-control" name="facebook_link" id="facebook-link" placeholder="facebook link"  value="{{$user->facebook_link}}">
                  @if ($errors->has('facebook_link'))
                      <span class="help-block">
                          <strong>{{ $errors->first('facebook_link') }}</strong>
                      </span>
                  @endif
                </fieldset>
                <fieldset class="form-group{{ $errors->has('twitter') ? ' has-error' : '' }}">
                  <label for="twitter">Email</label>
                  <input type="text" class="form-control" name="twitter" id="twitter" placeholder="twitter username"  value="{{$user->twitter}}">
                  @if ($errors->has('twitter'))
                      <span class="help-block">
                          <strong>{{ $errors->first('twitter') }}</strong>
                      </span>
                  @endif
                </fieldset>
                <button type="submit" class="btn btn-primary">Update</button><br><br>
                <button type="button" class="btn btn-success">Change Password</button>
              </div>


            </form>
          </div>
       </div>
     </div>
   </div>
@endsection("content")
