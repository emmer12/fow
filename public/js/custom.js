// $(".audio-p").click(function () {
//   $("audio")[0].pause();
//   var id=$(this).attr('data-id')
//   if ($(this).hasClass("ti-control-play")) {
//     $(this).addClass("ti-control-pause audio-p")
//     $(this).removeClass("ti-control-play audio-p")
//     $('.audio-'+id)[0].play();
//     return
//   }else {
//     $(this).addClass("ti-control-play audio-p")
//     $(this).removeClass("ti-control-pause audio-p")
//     $('.audio-'+id)[0].pause();
//     return
//   }
// })
(function() {
  var music={
    init:function() {
      this.catchDom();
      this.bindEvent();
      this.render();
    },
    catchDom:function() {
      this.$el=$(".player");
      this.$control=this.$el.find(".audio-p")
      this.$audio=this.$el.find("audio");
    },
    render:function() {
      for (var i = 0; i < this.$audio.length; i++) {
        this.$audio[i].pause();
      }
      this.$control.addClass("ti-control-play audio-p")
      this.$control.removeClass("ti-control-pause audio-p")
      console.log("binding...");
    },
    bindEvent:function() {
      this.$control.on("click",this.playAudio)
    },
    playAudio:function(e){
     var target=$(this).attr("data-id");
     if ($(this).hasClass("ti-control-play")) {
       music.render();
       $('.audio-'+target)[0].play();
       $(this).addClass("ti-control-pause audio-p")
       $(this).removeClass("ti-control-play audio-p")
     }else {
       $('.audio-'+target)[0].pause();
       $(this).removeClass("ti-control-pause audio-p")
       $(this).addClass("ti-control-play audio-p")
     }
    }
  }

  var modal={
    init:function() {
      this.catchDom();
      this.bindEvent();
      this.render();
    },
    catchDom:function() {
      this.$el=$(".hasModel");
      this.$action=this.$el.find(".show-model")
      this.$close=this.$el.find(".close")
      this.$modal=this.$el.find(".modal")
      this.$overlay=$(".overlay");
    },
    render:function() {
      console.log("yessss");
    },
    bindEvent:function() {
      this.$action.on("click",this.displayModal)
      this.$close.on("click",this.exitModal.bind(this))
    },
    displayModal:function() {
      var target=$(this).attr("data-id");
      $(".modal"+target).fadeIn();
      modal.$overlay.fadeIn();
    },
    exitModal:function() {
      this.$modal.fadeOut();
      this.$overlay.fadeOut();
    }
  }



  // initializing modules
  music.init();
  modal.init();

})()



$(".pop").click(function () {
  $(".pop-model").removeClass("animated bounceOut");
  $(".overlay").fadeIn('slow');
  $(".pop-model").addClass("animated bounceIn").fadeIn();
  $("html,body").animate({scrollTop:'120px'});
})

$(".add-cat").click(function () {
  $(".cat").slideToggle()
})


$(".main-p-play").click(function() {
  var audio=$(".p-play")[0];
  if ($(this).hasClass("ti-control-play")) {
    $(this).addClass("ti-control-pause audio-p")
    $(this).removeClass("ti-control-play audio-p")
    audio.play();
    return
  }else {
    $(this).addClass("ti-control-play audio-p")
    $(this).removeClass("ti-control-pause audio-p")
    audio.pause();
    return
  }
})

$(".podcast-play").click(function () {
  $(".main-p-play").addClass("ti-control-pause")
  $(".main-p-play").removeClass("ti-control-play")
  var podcast_data=$(this).attr('data-podcast');
  var dp_data=$(this).attr('data-dp');
  var title=$(this).attr('data-title');
  var author=$(this).attr('data-author');
  $(".p-play").attr("src",podcast_data);
  $(".download-p").attr("href",podcast_data)
  $(".podcast-preview").attr("src",dp_data)
  $(".main-title").html(title)
  $(".main-author").html(author)
  $(".p-play")[0].play();
  $("html, body").animate({scrollTop:0})

})

$(".p-info").click(function () {
  $(".p-info-d").slideToggle();
})
$(".video-p").click(function () {
  var id=$(this).attr('data-id')
  if ($(this).hasClass("ti-control-play")) {
    $(this).addClass("ti-control-pause audio-p")
    $(this).removeClass("ti-control-play audio-p")
    $('.overlay,.close-vid').fadeIn()
    $(".vid-display-con-"+id).fadeIn()
    $(".vid-display-con .video-p").removeClass("ti-control-play audio-p")
    $(".vid-display-con .video-p").addClass("ti-control-pause");
    $('.video-'+id)[0].play();
    return
  }else {
    $(this).addClass("ti-control-play audio-p")
    $(this).removeClass("ti-control-pause audio-p")
    $('.video-'+id)[0].pause();
    return
  }
})
$(".overlay,.close-vid").click(function () {
  $('.overlay').fadeOut();
  $('.vid-display-con').fadeOut()
  $(".play-time .video-p").removeClass("ti-control-pause")
  $(".play-time .video-p").addClass("ti-control-play")
  $('video').load()
})


$(".nav-item-new a").click(function () {
  $(".nav-item a").removeClass('active-dash')
  var target=$(this).attr('data')
  $(".dash-body .div").fadeOut();
  $("."+target).fadeIn();
  $(this).addClass('active-dash')
})
// toggle disription and video or audio details

$(".add-epic button").click(function () {
  $(".podcast-e-f").slideToggle()
})

$(".approve-act").click(function () {
  var id=$(this).attr("data_id");
  $(".approve-form"+id).submit()
})

$('.category .heading span').click(function () {
  if ($(this).hasClass("ti-menu")) {
    $(".category ul").fadeIn();
    $(this).removeClass("ti-menu")
    $(this).addClass("ti-minus")
  }
  else {
    $(".category ul").fadeOut()
    $(this).addClass("ti-menu")
    $(this).removeClass("ti-minus")
  }
})

$("span.opener").on("click", function(){
  var p1=$(this).parent()
  var p2=p1.parent()
    var menuopener = $(this);
    if (menuopener.hasClass("ti-angle-down")) {
       p2.find('.mobile-sub-menu').slideDown();
       menuopener.removeClass('ti-angle-down');
       menuopener.addClass('ti-angle-up');
    }
    else
    {
       p2.find('.mobile-sub-menu').slideUp();
       menuopener.removeClass('ti-angle-up');
       menuopener.addClass('ti-angle-down');
    }
    return false;
});

$("span.opener-multi").on("click", function(){
  var p1=$(this).parent()
  var p2=p1.parent()
  var id=$(this).data('id');
    var menuopener = $(this);
    if (menuopener.hasClass("ti-angle-down")) {
       p2.find('.mobile-sub-menu'+id).slideDown();
       menuopener.removeClass('ti-angle-down');
       menuopener.addClass('ti-angle-up');
    }
    else
    {
       p2.find('.mobile-sub-menu'+id).slideUp();
       menuopener.removeClass('ti-angle-up');
       menuopener.addClass('ti-angle-down');
    }
    return false;
});

$('.reg').click(function () {
  $("#drop").toggleClass("animated fadeInUp").toggle();
})

$(".f-drop").click(function () {
  var element=$(this);
  var target=element.attr('data')
  var t=$("."+target).slideToggle();
  if ($(element).find('span').hasClass('ti-plus')) {
    $(element).find('span').addClass('ti-minus')
     $(element).find('span').removeClass('ti-plus')
  }else {
     $(element).find('span').addClass('ti-plus')
     $(element).find('span').removeClass('ti-minus')

  }

})
  $(".additional").click(function () {

    var html = $(".clone").html();
          $(".increment").after(html)
  })
  $("body").on('click',".btn-danger",function () {
     $(this).parents(".control-group").remove();
  })
 /* ---- Page Scrollup JS Start ---- */
 //When distance from top = 250px fade button in/out
  var scrollup = $('.scrollup');
  var headertag = $('header');
  var mainfix = $('.main');
  $(window).scroll(function(){
    if ($(this).scrollTop() > 0) {
        scrollup.fadeIn(300);
    } else {
        scrollup.fadeOut(300);
    }

    // /* header-fixed JS Start */
    // if ($(this).scrollTop() > 0){
    //    headertag.addClass("header-fixed");
    // }
    // else{
    //    headertag.removeClass("header-fixed");
    // }
    //
    // /* main-fixed JS Start */
    // if ($(this).scrollTop() > 0){
    //    mainfix.addClass("main-fixed");
    // }
    // else{
    //    mainfix.removeClass("main-fixed");
    // }
    /* ---- Page Scrollup JS End ---- */
  });


  function loadContent(hash) {
    if (hash==="") {
      hash="dashboard";
    }
    $('html,body').animate({scrollTop:0},'600','swing');
    $('section').load('pages/'+hash+'')
  }
  $(window).on('hashchange',function () {
    loadContent(location.hash.slice(1))
  })


  //On click scroll to top of page t = 1000ms
  scrollup.on("click", function(){
      $("html, body").animate({ scrollTop: 0 }, 1000);
      return false;
  });
  $(".signup").click(function () {
    $(".signup-form").fadeIn();
    $(".login-form").fadeOut()
  })
  $(".login").click(function () {
    $(".login-form").fadeIn();
    $(".signup-form").fadeOut()
  })
  $(".reg-close").click(function () {
    $(".log-form,.over").addClass("animated ZoomOut").fadeOut()
  })
  $(".reg").click(function () {
    $(".log-form,.over").removeClass("animated ZoomOut")
    $(".log-form,.over").addClass("animated ZoomIn").fadeIn();
  })
$(document).ready(function() {
  // $("video").on("canplay",function () {
  //   console.log("loas");
  // })

  $(".m-banner span,.v-banner span,.s-banner span,.pod-banner span").fadeIn().animate({'padding-top':'120px'})
  $(".m-banner h4,.v-banner h4,.s-banner h4,.pod-banner h4").fadeIn().animate({'padding-top':'70'})

  $("#single-product-sing").owlCarousel({
      autoPlay: false,
      slideSpeed: 1500,
      items : 1,
      pagination:true,
      navigation:false,
      /* transitionStyle : "fade", */    /* [This code for animation ] */
      navigationText:["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"],
      itemsDesktop : [1199,1],
      itemsDesktopSmall : [979,1],
      itemsTablet: [768,1],
      itemsMobile : [479,1],
  });


// $.ajax({
//   url:"http://locationsng-api.herokuapp.com/api/v1/states",
//   success:function(data) {
//     console.log(data);
//     for (var i = 0; i < data.length; i++) {
//       console.log();
//       $(".states").append("<option value="+data[i].name+">"+data[i].name+"</option>")
//     }
//   }
// })


// Country api https://restcountries.eu/rest/v2/all
$.ajax({
  url: "https://restcountries.eu/rest/v2/all",
  success:function(data) {
    $(".country").append("<option value=''>Choose country</option>")
    for (var i = 0; i < data.length; i++) {
      console.log();
      $(".country").append("<option value="+data[i].name+">"+data[i].name+"</option>")
    }
  }
})


  var wstick = $(window);
           wstick.on('scroll',function() {
              var scroll = wstick.scrollTop();
              if (scroll < 450) {
                $(".nav-container,.menu-div ").removeClass("added")

              }else{
                $(".nav-container,.menu-div ").addClass("added")
              }
           });

  $(".volunteer").click(function () {
    $(".v-form").removeClass("animated slideOutUp")
    $(".v-form").addClass("animated slideInDown").fadeIn();
    $("body,html").animate({scrollTop:0})
    $(".overlay").fadeIn('slow');

  })

  $(".close").click(function () {
    $(".v-form").removeClass("animated slideInDown").fadeOut();
    $(".custom-modal").removeClass("animated bounceIn").fadeOut();
    $(".custom-modal").addClass("animated bounceOut")
    $(".pop-model").fadeOut()
    $(".v-form").addClass("animated slideOutUp")
    $(".overlay").fadeOut('slow');
    $(".info-h-div").removeClass("animated ZoomOut").fadeOut();
    $(".artist-info").removeClass("animated bounceOut").fadeOut();
    for (var i = 0; i < $("audio").length; i++) {
      $("audio")[i].pause();
    }
  })
  $('.news-l').click(function () {
    $(".info-h-div").removeClass("animated ZoomOut")
    $(".info-h-div").addClass("animated ZoomIn").fadeIn();
    $(".overlay").fadeIn('slow');
  })

  $('.card-text').each(function () {
    var maxlength=120;
    var mys=$(this).text();
    var id=$(this).attr("data_id")
      if($.trim(mys).length>maxlength){
       var news=$.trim(mys).substring(0,maxlength);
       var removedstr=mys.substring(maxlength,$.trim(mys).length);
       $(this).empty().html(news+'...');
      }
});

$('.audeo-title').each(function () {
  var maxlengtht=45;
  var mys=$(this).text();
  var id=$(this).attr("data_id")
    if($.trim(mys).length>maxlengtht){
     var newst=$.trim(mys).substring(0,maxlengtht);
     var removedstr=mys.substring(maxlengtht,$.trim(mys).length);
     $(this).find('h4').empty().html(newst+'...');
     console.log(maxwidth);
    }
});

 $(".show-tracks").click(function () {
   $(".custom-modal").removeClass("animated bounceOut");
   $(".overlay").fadeIn('slow');
   var id=$(this).data('id');
   $("#modal-"+id).addClass("animated bounceIn").fadeIn();
 })
$('.name-artist').click(function() {
    var id=$(this).data('id');
  $('.artist-info-'+id).addClass("animated bounce").fadeIn()
})

  $("#testimonial").owlCarousel({
    slideSpeed:300,
    paginationSpeed:400,
    singleItem:!0
  })
  /*----------------------
      brands-carousel
  ------------------------*/
  $(".brands-carousel").owlCarousel({
  autoPlay: false,
  slideSpeed:200,
  items : 5,
  pagination:false,
  navigation:true,
  navigationText:["<i class='ti ti-angle-left'></i>","<i class='ti ti-angle-right'></i>"],
  itemsDesktop : [1199,5],
  itemsDesktopSmall : [980,3],
  itemsTablet : [767,2],
  itemsMobile : [479,2]
  });

  $(".owl-carousel").owlCarousel({
  autoPlay: true,
  slideSpeed:200,
  items : 5,
  pagination:false,
  navigation:true,
  navigationText:["<i class='ti ti-angle-left'></i>","<i class='ti ti-angle-right'></i>"],
  itemsDesktop : [1199,5],
  itemsDesktopSmall : [980,3],
  itemsTablet : [767,2],
  itemsMobile : [479,2],
  margin:10
  });

  $('.dropify').dropify();

$(".mobile-sub-menu").slideUp()
    // pretty prettyPhoto
  $(".lightbox-image").append("<span></span>");
  $(".lightbox-image span").css({opacity:1});

  $("#initial").validate({
    highlight: function(element) {
      $(element).closest('.form-g').removeClass('has-success').addClass('has-error')
      $(element).closest('.form-g').removeClass('has-success').addClass('has-error');
    },
    unhighlight: function(element) {
      $(element).closest('.form-g').removeClass('has-error').addClass('has-success');
    },
    messages:{
      fullname:{
        required:"Username field is required "
      },
      terms:{
        required:"Please agree With our terms and conditions "
      }
    },
    submitHandler:function(form, event) {
      var form=$(form).serializeArray()
       console.log(form);
    }
  });

      //**** countdown  ****//


    function countdown_clock() {
      $(".countdown-clock").downCount({
        date: $(".countdown-clock").attr("data-end-date"),
            offset: +10
        },
        function () {
          //alert('done!'); Finish Time limit
        return false;
      });
    }
    //****   Music aniamtion  ****//

    // tagify config
    var input = document.querySelector('input[name=tags]'),
        tagify = new Tagify(input, {
            whitelist : ['aaa', 'aaab', 'aaabb', 'aaabc', 'aaabd', 'aaabe', 'aaac', 'aaacc'],
            dropdown : {
                classname : "color-blue",
                enabled   : 3,
                maxItems  : 5
            }
        });


    //**** countdown initaiation  ****//
    countdown_clock();


    //**** Audio player  ****//


  });



  //**** Home page Slider  ****//
  $(function () {
    $("#slider").responsiveSlides({
    auto: true,
    pager: false,
    nav: true,
    speed: 500,
    maxwidth: 960,
    namespace: "centered-btns"
    });
  });
