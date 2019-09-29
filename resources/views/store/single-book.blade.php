@extends("layouts.app")
{{-- elevation worship backgreund:#eeeeef *140#--}}

@section("content")
  <br>
   <div class="">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="img-display">
            <img src="/storage/uploads/images/{{ $book->preview_image }}" width="100%" height="90%" class="product-img center-block" alt="">
            <div class="action">
              @if ($book->price)
                <button type="submit" class="btn btn-success btn-lg center-block" id="desk-show">Buy</span> </button>
                @else
                <a href="/storage/uploads/books/{{ $book->file }}" class="btn btn-success btn-lg center-block desk-show" ><span class="ti ti-download"></span> </a>
              @endif
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="product-s-details">
            <h4 class="title">{{$book->title}}</h4>
            as low as <span> <b>&#x20A6;{{$book->price}}</b> </span>
            <hr>
            <h4><b>Category</b></h4>
            <a href="{{ route("store-category-page",str_slug($book->category,'-')) }}">{{$book->category}}</a>
            <h4> <b>Description</b> </h4>
            <p>{{$book->description}}</p>
            <hr>
            <ul class="list-inline">
              <li> <span class="ti ti-facebook"> Share</span> </li>
              <li> <span class="ti ti-twitter"> Tweet</span> </li>
              <li></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
      <br>
    </div>
   </div>
@endsection("content")
