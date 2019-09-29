<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  @isset($shearableblog)
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:url"           content="{{ Request::url() }}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="{{$blogPost->title}}" />
    <meta property="og:description"   content="{{$blogPost->body}}" />
    <meta property="og:image"         content="/storage/uploads/images/{{ $blogPost->preview_image }}" />
  @endisset
  @isset($shearableAudio)
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta property="og:url"           content="{{ Request::url() }}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="{{$audio_post->title}}" />
    <meta property="og:description"   content="{{$audio_post->discription}}" />
    <meta property="og:image"         content="/storage/uploads/images/{{ $audio_post->preview_image }}" />
  @endisset

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
      @isset($url)
        {{$url}}
        @else
          {{ config('app.name', 'Laravel') }}

        @endisset
      {{-- @if ($url)
        @else
      @endif --}}
    </title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/responsiveslides.css" />
    <link rel="stylesheet" href="/css/themify-icons.css">
    <link rel="stylesheet" href="/css/prettyPhoto.css">
    <link rel="stylesheet" href="/css/animate.css">
    <link rel="stylesheet" href="/css/dropify.min.css">
    <link rel="stylesheet" href="/css/tagify.css">
    <link rel="stylesheet" href="/css/fotorama.css">
    <link rel="stylesheet" href="/css/owl.carousel.css">
    <link rel="shortcut icon" href="/images/favicon.png">
    <script type="text/javascript" src="/js/plugins/jquery-1.12.3.min.js"></script>
    {{-- <script type="text/javascript" src="/js/plugins/jquery.prettyPhoto.js"></script> --}}
</head>
<body>
  <!-- Load Facebook SDK for JavaScript -->
 <div id="fb-root"></div>
 <script>(function(d, s, id) {
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) return;
   js = d.createElement(s); js.id = id;
   js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
   fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));</script>
    <div id="app">

        @include('inc.nav')
        @include('inc.messages')
        @yield('content')
        <div class="scroll-top">
          <div class="scrollup ti ti-angle-up" style="line-height:24px"></div>
        </div>
      @include('inc.footer')
    </div>

    <!-- Scripts -->
    <script type="text/javascript">
      function activatePlacesSearch() {
        var input=document.getElementById("city");
        var autocomplete=new google.maps.places.Autocomplete(input)
      }
      $(".download").click(function() {
        var title=$(this).attr("data_title");
        setTimeout(function () {
        window.location.href="{{url('download/success')}}"+'/'+title
        },3000)
      })

      $(".permit").click(function () {
        var id=$(this).attr('data-id');
        var element=$(this);
        var item=$(this).attr('data-item');
        var action=$(this).attr('action');
        var urls="{{route('author.approval')}}";

        $.ajax({
          url:urls,
          method:"POST",
          data:{'id':id,'item':item,'_token':'{{ csrf_token() }}','action':action},
          success:function(data) {
            if (data.success) {
              $('.custum-msg-success').addClass("animated fadeInRight").fadeIn().text(data.action+"d")
              setTimeout(function() {
                $(".custum-msg-success").removeClass("animated fadeInRight")
                $(".custum-msg-success").addClass("animated fadeOutRight")
              },7000)
              setTimeout(function() {
                location.reload()
              },5000)
            }
          }
        });

      })
      $(".delete").click(function (event) {
        event.preventDefault();
        var id=$(this).attr('data-id');
        var item=$(this).attr('data-item');
        var urls="{{route('post.destroy')}}";
        var currentElement=$(this);
        var con=confirm("are you sure you wants to delete?");
        if (con) {
          $.ajax({
            url:urls,
            method:"POST",
            data:{'id':id,'item':item,'_token':'{{ csrf_token() }}'},
            success:function(data) {
              if (data.success) {
                $('.custum-msg-success').addClass("animated fadeInRight").fadeIn().text(data.success)
                $(".parent"+id).css({"background":"#ccc"})
                $(".parent"+id).addClass("animated Shake").fadeOut(3000)
                setTimeout(function() {
                  $(".custum-msg-danger").removeClass("animated fadeInRight")
                  $(".custum-msg-danger").addClass("animated fadeOutRight")
                },7000)
              }
              if (data.error) {
                $('.custum-msg-danger').addClass("animated fadeInRight").fadeIn().text(data.error)
                setTimeout(function() {
                  $('.custum-msg-danger').removeClass("animated fadeInRight")
                  $('.custum-msg-danger').addClass("animated fadeOutRight")
                },7000)

              }
            }

          })
        }

      })
    </script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCteUysCxzWu9wgu7ytFmWOr3GF6Eg-Zw8&libraries=places&callback=activatePlacesSearch"></script>
    <script type="text/javascript" src="/js/plugins/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/js/plugins/jquery.downCount.js"></script>
    <script type="text/javascript" src="/js/plugins/responsiveslides.js"></script>
    <script type="text/javascript" src="/js/plugins/owl.carousel.min.js"></script>
    <script type="text/javascript" src="/js/plugins/dropify.js"></script>
    <script type="text/javascript" src="/js/plugins/wow.min.js"></script>
    <script type="text/javascript" src="/js/plugins/wow.min.js"></script>
    <script type="text/javascript" src="/js/plugins/fotorama.js"></script>
    <script type="text/javascript" src="/js/custom.js"></script>


    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script type="text/javascript">
      new WOW().init()
    </script>
</body>
</html>
