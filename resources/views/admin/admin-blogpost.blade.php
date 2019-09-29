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
          <div class="contain" style="background:white;padding:10px">

          <div class="heading">
            <h4>Blog Posts</h4>
          </div>
          <div class="table-responsive">
          <table class="table " >
            <thead>
              <tr>
                <th>S/N</th>
                <th>Blog Title</th>
                <th>Display Image</th>
                <th>Author</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($blogPosts as $blogPost)
                <tr>
                  <td></td>
                  <td>
                    <a href="{{route('blog.show',$blogPost->slug)}}">
                      <h4 class="card-title">{{$blogPost->title}}</h4>
                    </a>
                  </td>
                  <td> <img src="/storage/uploads/images/{{ $blogPost->preview_image }}" width="150px" height="100px" alt=""> </td>
                  <td> <a href="#">{{ $blogPost->author()->firstname }} {{ $blogPost->author()->lastname }}</a> </td>
                  <td>
                    <form class="approve-form{{$blogPost->id}}" action="{{route('admin-blog-approval')}}" method="post">
                      {{ csrf_field() }}
                      <input type="hidden" name="post_id" value="{{$blogPost->id }}">
                      <input type="checkbox" name="status" {{ $blogPost->approved ? "checked" : "" }}  >
                    </form>
                  </td>
                  <td>
                    @if ($blogPost->approved)
                      <button type="button" class="btn btn-danger approve-act" data_id="{{$blogPost->id}}"> <span class="ti ti-thumb-down"></span> </button>
                      @else
                      <button type="button" class="btn btn-success approve-act" data_id="{{$blogPost->id}}" > <span class="ti ti-thumb-up"></button>

                    @endif
                    <button type="button" class="btn btn-primary"> <span class="ti ti-eraser"></button>
                    <button type="button" class="btn btn-danger"> <span class="ti ti-trash"></button>
                  </td>
                </tr>
              @endforeach

            </tbody>
            <tfoot>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td colspan=6>
                  <ul class="pager">
                    {{ $blogPosts->links() }}
                  </ul>
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
   <br>
   <br>
@endsection("content")
