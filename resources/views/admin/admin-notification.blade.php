@extends("layouts.app")
{{-- elevation worship backgreund:#eeeeef --}}
<style media="screen">

</style>
@section("content")
  @include('inc/drawer-admin')
  <br>
   <div class="container">
     <div class="row">
       <div class="col-md-3">
       </div>
       <div class="col-md-9">
         <div class="pull-right">
           <button type="button" class="btn btn-default">Notifications <span class="label label-pill label-success">{{count($requests)}}</span> </button>
         </div>
          <hr>
          <div class="contain" style="background:white;padding:10px">

          <div class="heading">
            <h4>Blog Posts</h4>
            @if (session('msg'))
              <div class="alert alert-success" role="alert">
                <span class="ti ti-control-play"></span>
                {{ session('msg')}}
              </div>
            @endif
          </div>
          <div class="table-responsive">
          <table class="table " >
            <thead>
              <tr>
                <th>S/N</th>
                <th>Display Image</th>
                <th>Fullname</th>
                <th>Email</th>
                <th>Type</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if (count($requests)<=0)
                <div class="alert alert-info" role="alert">
                  You have no requests
                </div>
                @else
                  @foreach ($requests as $request)
                    <tr>
                      <td></td>
                      <td></td>
                      <td><a href="#">{{$request->user->firstname}} {{$request->user->lastname}}</a></td>
                      <td>{{$request->user->email}}</td>
                      <td>{{$request->type}}</td>
                      <td>
                        <form class="approve-form" action="{{route('author.approval')}}" method="post">
                          {{ csrf_field() }}
                          <input type="hidden" name="userId" value="{{$request->user_id}}">
                          <input type="hidden" name="id" value="{{$request->id}}">
                          <button type="submit" class="btn btn-success">Approve</button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
              @endif

            </tbody>
            <tfoot>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td colspan=6>
                  {{-- <ul class="pager">
                    {{ $blogPosts->links() }}
                  </ul> --}}
             </td>
            </tr>
            </tfoot>

          </table>
         </div>
        </div>
         </div>


       </div>
     </div>
   </div>
@endsection("content")
