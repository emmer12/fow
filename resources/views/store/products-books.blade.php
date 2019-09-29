@extends("layouts.app")
{{-- elevation worship backgreund:#eeeeef --}}

<style media="screen">
  .category ul{
    margin:0px;
    background: white;
    padding: 10px;
    font-weight:700
  }
  .category ul li{
    list-style: none;
  }
  .category ul li a{
    display:block;
    //background:#ddd;
    padding:10px;
    margin:3px;
    border-bottom: 1px solid #073e5d
  }

</style>
@section("content")
   <div class="store-nav">
     <ul>
       <li><a href="{{route("store-page")}}">Main store</a></li>
       <li> <a href="{{route("store.books")}}">Books store</a> </li>
     </ul>
   </div>
    <div class="container">
      <div class="row">
        <form class="search-form storeSearch text-right" action="index.html" method="post">
          <input type="text" name="search" class=""  value="{{old('search')}}" placeholder="search..." >
          <input type="submit" name="submit" value="GO" >
        </form>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="category">
            <h4 class="heading">Category <span class="ti ti-menu"></span> </h4>
            <ul>
              @foreach ($bookCategories as $bookCategory)
                <li><a href="{{ route("store-category-page",str_slug($bookCategory->name,'-')) }}"> <span class="ti ti-angle-double-right"></span>{{$bookCategory->name}}</a></li>
              @endforeach
            </ul>
          </div>
        </div>
        <div class="col-md-8">
          @if (isset($count))
            <strong style="margin-left:15px">found  {{$count}} <span class="text-success"> ({{$category}})</span> Result(s)</strong>
          @endif
          <div class="row">
            {{-- card template --}}
            @if (count($books) < 1)
               <div class="alert alert-info" role="alert">
                 No Books In the Store
               </div>
            @endif
            @foreach ($books as $book)
              <div class="col-md-4 col-sm-6">
                <div class="book-shopping-card">
                  <a href="{{ route('single.book.show',$book->slug) }}">
                    <img src="/storage/uploads/images/{{ $book->preview_image }}" width="100%" height="300px" alt="">
                  </a>
                  <div class="card-details">
                    <a href="/store/{{ $book->slug }}" class="t-active"> <h4>{{ $book->product_title }}</h4> </a>
                    @if ($book->price)
                      <span class="pull-right price"><b>&#x20A6;{{ $book->price }}</b></span>
                      <hr>
                      <button type="submit" class="btn btn-success btn-lg center-block" id="desk-show">Buy</span> </button>
                      @else
                      <a href="/storage/uploads/books/{{ $book->file }}" class="btn btn-success btn-lg center-block desk-show" download><span class="ti ti-download"></span> </a>
                    @endif
                  </div>
                </div>
              </div>

            @endforeach
            {{-- card template end --}}

          </div>

        </div>
      </div>
  </div>
  <div class="container">
    <nav>
      <ul class="pager-custom">
        {{ $books->links() }}
      </ul>
    </nav>
  </div>
@endsection("content")
