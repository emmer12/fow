<style media="screen">
  .active{
    font-weight: bolder;
    color:#073e5d;
    background:#ddd
  }
  .drawer li{
    list-style: none;
    background: red
  }
</style>

<div class="drawer">
  <div class="drawer-header">
    <a href="{{route("admin.profile",'@'.auth()->user()->username)}}">
      <img width="100px" height="100px" src="/storage/uploads/images/{{ Auth::user()->profile_picture}}"  alt="FOW"><br>
      <h4 class="center-blo"><a href="{{route("admin.profile",'@'.auth()->user()->username)}}">{{ucfirst(Auth::user()->username)}}</a></h4>
   </a>
  </div>
  <div class="drawer-body">
      <ul>
        <li>
          <a href="{{ route('user.dashboard') }}">Dashboard</span></a>
        </li>
        <li>
          <a href="{{ route('dashboard.audio') }}">Audio</span></a>
        </li>
        <li>
          <a href="{{ route('dashboard.books') }}">Books</span></a>
        </li>
        <li>
          <a href="{{ route('dashboard.blog') }}">Blog</span></a>
        </li>
        <li>
          <a href="{{route('order.display')}}">Orders</span></a>
        </li>
        <li>
          <a href="{{route("admin.profile",'@'.auth()->user()->username)}}">Profile</span></a>
        </li>
        <li>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
      </ul>
  </div>
</div>
<div class="bar">
  <span class="ti ti-menu"></span>
</div>
<script type="text/javascript">
  $('.bar span').click(function () {
    if ($(this).hasClass('ti-menu') ) {
      $(this).removeClass('ti-menu')
      $('.drawer').animate({
        left:'0px'
      })
      $(this).addClass('ti-close')
    }else {
      $(this).removeClass('ti-close')
      $('.drawer').animate({
        left:'-300px'
      })
      $(this).addClass('ti-menu')

    }
  })
</script>
