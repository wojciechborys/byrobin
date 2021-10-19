/*header script start*/

var $ = jQuery.noConflict();
/*ready stage start*/
$(document).ready(function () {

  jQuery('<div class="menuTrigger"></div>').insertBefore(".wpmm_mobile_menu_btn.show-close-icon");
  jQuery('<div class="searchPopup-trigger"><a>search</a></div>').insertBefore(".menuTrigger");
  jQuery('<div class="close-btn"> <svg xmlns="http://www.w3.org/2000/svg" width="11.016" height="11.016" viewBox="0 0 11.016 11.016"> <g id="Group_Copy" data-name="Group Copy" transform="translate(10.23 0.786) rotate(90)"> <path id="Stroke_6992" data-name="Stroke 6992" d="M0,0,9.444,9.444" fill="none" stroke="#666" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.111"></path> <path id="Stroke_6993" data-name="Stroke 6993" d="M0,9.444,9.444,0" fill="none" stroke="#666" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.111"></path> </g> </svg> </div>').insertBefore(".wpmm-main-wrap-menu-1 > .searchPopup-trigger");

  var menuTrigger = $('.wp-megamenu-wrap .menuTrigger');
  var menuCloseTrigger = $('.wp-megamenu-wrap .close-btn');

  $(menuTrigger).on('click', function (e) {
    if (window.innerWidth < 1200) {
      e.preventDefault()
      $(this).addClass('triggerActive');
      $('body').addClass('mobileMenu-open');
    }
  })

  $(menuCloseTrigger).on('click', function (e) {
    if (window.innerWidth < 1200) {
      e.preventDefault()
      if (document.body.classList.contains('mobileMenu-open')) {
        document.body.classList.remove('mobileMenu-open');
        $(menuTrigger).removeClass('triggerActive');
        // document.body.classList.remove('popupOpen');
      }
    }
  })

  /*form textbox animation start*/
  $('.form-row .input-text').each(function () {
    if (jQuery(this).val().length > 0) {
      jQuery(this).closest(".form-row").addClass("filled")
    }
  });


  $('body').on('focus', '.form-row .input-text', function () {
    jQuery(this).closest(".form-row").addClass("filled");
    jQuery(this).closest(".form-row").addClass("focused");

  });
  $('body').on('blur', '.form-row .input-text', function () {
    if (!$(this).val()) {
      console.log(5);
      jQuery(this).closest(".form-row").removeClass("filled");
    } else {
      jQuery(this).closest(".form-row").addClass("filled");
    }
    jQuery(this).closest(".form-row").removeClass("focused");
  });

  /*form textbox animation end*/

  /*svg images to svg code automatic*/
  /***********************/
  $(function () {

    $('img.svg , .header-top .wpmm_brand_logo_wrap img').each((i, e) => {

      const $img = $(e);

      const imgID = $img.attr('id');

      const imgClass = $img.attr('class');

      const imgURL = $img.attr('src');

      $.get(imgURL, (data) => {
        // Get the SVG tag, ignore the rest
        let $svg = $(data).find('svg');

        // Add replaced image's ID to the new SVG
        if (typeof imgID !== 'undefined') {
          $svg = $svg.attr('id', imgID);
        }
        // Add replaced image's classes to the new SVG
        if (typeof imgClass !== 'undefined') {
          $svg = $svg.attr('class', `${imgClass}replaced-svg`);
        }

        // Remove any invalid XML tags as per http://validator.w3.org
        $svg = $svg.removeAttr('xmlns:a');

        // Check if the viewport is set, if the viewport is not set the SVG wont't scale.
        if (!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
          $svg.attr(`viewBox 0 0  ${$svg.attr('height')} ${$svg.attr('width')}`);
        }

        // Replace image with new SVG
        $img.replaceWith($svg);
      }, 'xml');
    });
  });
  /***********************/



  let navHeight = $('.header-top').outerHeight();
  // console.log(navHeight);

  $("#menu-primary-menu .wpmm_mega_menu").mouseover(function () {
    $('body').addClass('megamenu-open');
  });
  $("#menu-primary-menu .wpmm_mega_menu").mouseleave(function () {
    $('body').removeClass('megamenu-open');
  });



  if ($('.bannerSlider.is-slider').length) {

    var sliderCountr = $('.slide-count');
    var bannerSlider = $('.bannerSlider.is-slider');

    bannerSlider.on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
      var i = (currentSlide ? currentSlide : 0) + 1;
      // sliderCount.text('<span>'+ i +'</span>'+ '/' + '<span class="total">'+ slick.slideCount+'</span>');
      sliderCountr.html('<span> 0' + i + '</span>' + ' / ' + '<span class="total">0' + slick.slideCount + '</span>');

      if (slick.slideCount == 1) {
        bannerSlider.addClass('single-item')
      }
    });

    bannerSlider.slick({

      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      // dots: false,
      infinite: true,
      mobileFirst: true,
      dots: true,
      fade: true,

      appendArrows: $('.slider-controls .nav-wrap'),
      appendDots: $('.slider-controls .dots-wrap'),
      prevArrow: $('.nav-wrap .nav-prev'),
      nextArrow: $('.nav-wrap .nav-next'),
    });
  }




  if ($(window).width() < 767) {
    jQuery(".productList-slider").removeClass("slick-initialized slick-slider");
  }
  else {
    if ($('.productList-slider').length) {
      $('.productList-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        mobileFirst: true,
        responsive: [
          {
            breakpoint: 767,
            settings: {
              settings: 'unslick'
            }
          },
        ]

      });
    }

  }


  // const productList = new slick('.productList-slider', {
  //   // Optional parameters
  //     slidesPerView: 3,
  //     spaceBetween: 30,
  //     pagination: {
  //       el: ".swiper-pagination",
  //       clickable: true,
  //     },
  // });
  // }







  /*search popup script start*/
  var searchPopupOpenTrigger = $('.searchPopup-trigger > a');
  var searchPopupCloseTrigger = $('.searchPopup .close-btn');
  var searchBodyClose = $('.popupDark-overlay');


  $(searchPopupOpenTrigger).on('click', function (e) {
    e.preventDefault()
    document.body.classList.add('popupOpen');
    document.body.classList.add('searchPopup-open');
    document.body.classList.remove('shopMenuPopup-open');


    setTimeout(() => {
      document.getElementById("search-input").focus();
    }, 100);
  })

  $(searchPopupCloseTrigger).on('click', function (e) {
    e.preventDefault()
    console.log('search close')
    if (document.body.classList.contains('searchPopup-open')) {
      document.body.classList.remove('searchPopup-open');
      document.body.classList.remove('popupOpen');

    }

    $('#search-input').val('');
    $(".search-box-results").css('display', 'none');
  })

  $(searchBodyClose).on('click', function (e) {
    e.preventDefault()
    if (document.body.classList.contains('searchPopup-open')) {
      document.body.classList.remove('searchPopup-open');
      document.body.classList.remove('popupOpen');
    }
  })
  /*search popup script end*/

  /*login popup script start*/
  globlePopup('.loginPopup-trigger > a, .registerPopup .login-trigger', '.loginPopup .close-btn', 'loginPopup-open', 'registerPopup-open');
  /*login popup script end*/

  /*register popup script start*/
  globlePopup('.register-trigger', '.registerPopup .close-btn', 'registerPopup-open', 'loginPopup-open');
  /*register popup script end*/

  /*shopfilter popup script start*/
  globlePopup('.filterPopup-trigger', '.shoFilterPopup .close-btn', 'shoFilterPopup-open');
  /*shopfilter popup script end*/

  /*account popup script start*/
  globlePopup('.accountPopup-trigger', '.accountPopup .close-btn', 'accountPopup-open');
  /*account popup script end*/

  /*forgotPass popup script start*/
  globlePopup('.forgotPass-trigger', '.forgotPassPopup .close-btn', 'forgotPassPopup-open', 'loginPopup-open');
  /*forgotPass popup script end*/

  /*sizeguidPopupp script start*/
  globlePopup('.size-guide', '.sizeguidPopup .close-btn', 'sizeguidPopup-open', 'loginPopup-open, shopMenuPopup-open');
  /*sizeguidPopupp script end*/




  /*globle popup start*/

  function globlePopup(openTrigger, closeTrigger, bodyAddClass, bodyRemoveClass) {

    let bodyClose = $('.popupDark-overlay');
    $(openTrigger).on('click', function (e) {
      e.preventDefault()
      document.body.classList.add('popupOpen');
      document.body.classList.remove(bodyAddClass);
      document.body.classList.remove(bodyRemoveClass);
      document.body.classList.add(bodyAddClass);
    })

    $(closeTrigger).on('click', function (e) {
      e.preventDefault()
      if (document.body.classList.contains(bodyAddClass)) {
        document.body.classList.remove(bodyAddClass);
        document.body.classList.remove('popupOpen');
      }
    })
    $(bodyClose).on('click', function (e) {
      e.preventDefault()
      if (document.body.classList.contains(bodyAddClass)) {
        document.body.classList.remove(bodyAddClass);
        document.body.classList.remove('popupOpen');
      }
    })

  }
  // globlePopup(openTrigger, closeTrigger, bodyAddClass, bodyRemoveClass);
  /*globle popup end*/





  /*form text animation start*/
  // $('.form-input').focus(function(){
  //   $(this).parents('.form-group').addClass('focused');
  // });



  /*outside woocomerce form input */
  $('.input-group .form-input').blur(function () {
    var inputValue = $(this).val();
    if (inputValue.length == 0) {
      $(this).removeClass('filled');
      $(this).parents('.form-group').removeClass('focused');
    } else {
      $(this).addClass('filled');
    }
  })
  /*outside woocomerce form input end*/


  /*woocomerce form input */
  // $('.form-row .input-text').focus(function(){
  //   $(this).parents('.form-row').addClass('focused');
  // });

  // $('.form-row .input-text').blur(function(){
  //   var inputValue = $(this).val();
  //   if ( inputValue == "" ) {
  //     $(this).parents('.form-row').removeClass('filled');
  //     $(this).parents('.form-row').removeClass('focused');  
  //   } else {
  //     $(this).parents('.form-row').addClass('filled');
  //   }
  // })  
  /*woocomerce form input */


  // $('.input-group .form-input').change(function(){

  // }

  // setTimeout(() => {
  //   $('.input-group .form-input').blur(function(){
  //     var inputValue = $(this);
  //     console.log(inputValue)
  //     if ( inputValue.value == "" ) {
  //       $(this).removeClass('filled');
  //       $(this).parents('.form-group').removeClass('focused');  
  //     } else {
  //       $(this).addClass('filled');
  //     }

  //   });

  // }, 200);
  /*form text animation end*/

  /*product mapPoiter script start*/
  $('.mapPoint .point-trigger').on("click", function () {
    $(this).toggleClass('active');
    if ($(this).hasClass('active')) {
      $('.mapPoint .point-trigger').removeClass('active');
      $('.mapPoint .point-trigger').parent().removeClass('popup-open');

      $(this).toggleClass('active');
      $(this).parent().addClass('popup-open')
    } else {

      $(this).removeClass('active')
      $(this).parent().removeClass('popup-open');
    }
  });

  $(document).mouseup(function (e) {
    var popup = $(".mapPoint");
    if (!$('.point-trigger').is(e.target) && !popup.is(e.target) && popup.has(e.target).length == 0) {
      popup.removeClass('popup-open');
      popup.find('.point-trigger').removeClass('active');
    }
  });
  /*product mapPoiter script end*/

  /*accordion start*/

  $('.toggle').click(function (e) {
    e.preventDefault();

    var $this = $(this);
    $this.addClass('is-active');

    if ($this.hasClass('is-active')) {
      console.log('is-click')
      $('.toggle').removeClass('is-active');
      $this.addClass('is-active');
    } else {
      $this.parent().parent().find('li .toggle').removeClass('is-active');
    }


    if ($this.next().hasClass('show')) {
      $this.next().removeClass('show');
      $this.next().slideUp(350);
    } else {
      $this.parent().parent().find('li .inner').removeClass('show');
      $this.parent().parent().find('li .inner').slideUp(350);
      $this.next().toggleClass('show');
      $this.next().slideToggle(350);

    }
  });

  $('.accordion li:first .toggle').trigger('click');
  $('.accordion li:first .toggle').addClass('is-active');

  /*accordion end*/

  /*popup menu hover script*/
  if ($(window).width() > 1200) {
    $(".hoverMenu-list ul > li:first").addClass("is-hover");
    $(".hoverMenu-list ul li > a ").hover(function () {
      $(".hoverMenu-list ul > li").removeClass("is-hover");
      $(this).parent().addClass("is-hover");
    });
  }
  /*popup menu hover script end*/


});
/*ready stage end*/

window.onload = function () {
  /*loader script start*/
  // $('.site-loader').fadeOut();
  $('html').addClass('is-loaded');
  /*loader script end*/

  // document.getElementById("search-input").focus();

};

$(window).on("resize", function (event) {
  $('body').css('width', $(this).width() + 'px');

});

