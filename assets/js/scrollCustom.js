var $ = jQuery.noConflict();
// plugin install
var menuScroll;
gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);

// let gsap = gsap.timeline({});
var scroll_element = '#scrollbar-wrap';

// 3rd party library setup:
const scrollWrap = document.querySelector(scroll_element);
const bodyScrollBar = Scrollbar.init(scrollWrap, {
  damping: 0.1,
  wheelEventTarget: document,
  delegateTo: document,
  continuousScrolling: true,
  //  alwaysShowTracks: true 
});

// Tell ScrollTrigger to use these proxy getter/setter methods for the "body" element: 
ScrollTrigger.scrollerProxy(scrollWrap, {
  scrollTop(value) {
    if (arguments.length) {
      bodyScrollBar.scrollTop = value; // setter
    }
    return bodyScrollBar.scrollTop;    // getter
  },
  getBoundingClientRect() {
    return { top: 0, left: 0, width: window.innerWidth, height: window.innerHeight };
  }
});

// when the smooth scroller updates, tell ScrollTrigger to update() too: 
bodyScrollBar.addListener(ScrollTrigger.update);
ScrollTrigger.defaults({ scroller: scrollWrap });
// 3rd party library setup: end







/*click to next div scroll start*/
function setupLinks(scrollery) {
  let linkElements = gsap.utils.toArray('.hasScroll a'),
    linkTargets = linkElements.map(e => document.querySelector(e.getAttribute("href"))),
    linkPositions = [],
    calculatePositions = () => {
      let offset = gsap.getProperty(scrollery, "y");
      linkTargets.forEach((e, i) => linkPositions[i] = e.getBoundingClientRect().top - offset);
    };

  linkElements.forEach((element, i) => {

    element.addEventListener("click", e => {
      e.preventDefault();
      gsap.to(bodyScrollBar, { duration: 2, scrollTo: linkPositions[i], overwrite: true });
    });
  });

  ScrollTrigger.addEventListener("refresh", calculatePositions);
}

setupLinks(scrollWrap);

/*click to next div scroll start*/





/*custome scroll on max content script start*/

/*All popup scroll start*/
var popScroll = document.querySelectorAll('.formPopup .inner-wrap');
popScroll.forEach(hasScroll);
function hasScroll(element) {
  Scrollbar.init(element);
}
/*All popup scroll end*/
var selectScroll = document.querySelectorAll('.select2-results__options');
selectScroll.forEach(resultScroll);
function resultScroll(element1) {
  Scrollbar.init(element1);
}



/*menu custome scroll start*/
menuScroll = document.querySelector('#menu-primary-menu');
function mobileMenuScroll(elemente) {
  Scrollbar.init(elemente);
}
function mobileMenuScrolldestroy(elemente) {
  Scrollbar.destroy(elemente);
}
// mobileMenuScroll(menuScroll)


function resizedw() {
  if (window.innerWidth > 1200) {
    mobileMenuScrolldestroy(menuScroll)
    // console.log('destroy');
  }
  if (window.innerWidth < 1200) {
    mobileMenuScroll(menuScroll)
    // console.log('init');
  }
}
var doit;
window.onresize = function () {
  clearTimeout(doit);
  doit = setTimeout(resizedw, 200);
};

/*menu custome scroll end*/




/*header animations start*/
var bodyHright = $('.main-inner');

if ($('.banner-box').length) {
  var topNav = $('.header-top');
  var areascroll = $('.banner-box .bannerSlider ');
  ScrollTrigger.create({
    scroller: scroll_element,
    trigger: areascroll,
    // markers: true,
    start: 'bottom 0%',
    end: `+= ${areascroll.height()}`,
    // end: () => `+=${areascroll.clientHeight }`,
    // end: () => `+=${bodyHright.clientHeight } 100%`,
    // toggleActions: 'play none none reverse',
    // toggleActions: 'play none none reverse',
    toggleClass: { targets: topNav, className: "white-active" },

  });
}

/*header animations end*/



/*social stick animation start*/
let socialpinArea = bodyHright;
let socialBox = document.querySelector('.socialCart-box')

/*social stick animation end*/

function footer_trigger() {
  // hide shop buttons when footer is in view
  ScrollTrigger.create({
    scroller: scroll_element,
    trigger: '.footer-bottom',
    start: 'top bottom',
    onToggle: function (ev) {
      if (ev.isActive) {
        document.body.classList.add('footer-active');
      } else {
        if (document.body.classList.contains('footer-active')) {
          document.body.classList.remove('footer-active');
        }
      }
    },
  });
}


// trigger for stagger anims 1
function init_stagger_trigger() {
  gsap.utils.toArray('.to-stagger-set').forEach(function (section) {
    ScrollTrigger.create({
      scroller: scroll_element,
      trigger: section,
      start: 'top 90%',
      end: 'bottom bottom',
      once: true,
      onEnter: function onEnter(ev) {
        // console.log('stagger triggered');

        // title animate first
        if (section.querySelector('.to-stagger-first') != null) {
          // gsap.fromTo(section.querySelector('.to-stagger-first'), { opacity: 0 }, { opacity: 1, duration: 0.7, ease: 'power1.inOut' }, 'start');
          // gsap.fromTo(section.querySelector('.to-stagger-first'), { y: 70 }, { y: 0, duration: 0.7, ease: 'power2.Out' }, 'start'); // followed by stagger of any remaining texts
          gsap.fromTo(
            section.querySelectorAll('.to-stagger-first'),
            { opacity: 0, y: 50 },
            {
              opacity: 1,
              y: 0,
              delay: section.querySelector('.to-stagger') != null ? 0.5 : 0,
              ease: 'power1.Out',
              stagger: {
                each: 0.1,
                ease: 'power1.inOut',
              },
            }
          );
        }

        gsap.fromTo(
          section.querySelectorAll('.to-stagger'),
          { opacity: 0, y: 50 },
          {
            opacity: 1,
            y: 0,
            delay: section.querySelector('.to-stagger-first') != null ? 0.8 : 0,
            ease: 'power1.Out',
            stagger: {
              each: 0.1,
              ease: 'power1.inOut',
            },
          }
        );
      },
    });
  });
}
//

/*homepage triggers start*/
function index_trigger() {

  ScrollTrigger.refresh();

  init_stagger_trigger()


  /*circle text animation start*/
  if ($('.has-circle-text').length) {
    gsap.utils.toArray('.has-circle-text').forEach(function (section) {
      var tl_circle = gsap.timeline({
        scrollTrigger: {
          scroller: scroll_element,
          trigger: section,
          start: 'top bottom', // when the top of the trigger hits the top of the viewport
          end: 'bottom top',
          scrub: 1,
        },
      });

      // add animations and labels to the timeline
      tl_circle.fromTo(section.querySelector('.circle-text > *'), { rotation: 0, }, { rotation: 200 });
    });
  }

  /*circle text animation end*/

  // image scaling scrub for images
  gsap.utils.toArray('.section-img.to-scale').forEach(function (section) {
    var tl_scale = gsap.timeline({
      scrollTrigger: {
        scroller: scroll_element,
        trigger: section,
        start: 'top bottom', // when the top of the trigger hits the top of the viewport
        end: 'bottom top',
        scrub: 1,
      },
    });

    // add animations and labels to the timeline
    tl_scale.fromTo(section.querySelector('img'), { scale: 1.15 }, { scale: 1 });
  });
  //




  // trigger for stagger anims 2
  gsap.utils.toArray('.to-stagger-set-2').forEach(function (section) {
    ScrollTrigger.create({
      scroller: scroll_element,
      trigger: section,
      start: 'top 90%',
      end: 'bottom bottom',
      once: true,
      // markers : true,
      onEnter: function onEnter(ev) {
        // console.log('stagger triggered');

        // title animate first
        if (section.querySelector('.to-stagger-first') != null) {
          // gsap.fromTo(section.querySelector('.to-stagger-first'), { opacity: 0 }, { opacity: 1, duration: 0.7, ease: 'power1.inOut' }, 'start');
          // gsap.fromTo(section.querySelector('.to-stagger-first'), { y: 70 }, { y: 0, duration: 0.7, ease: 'power2.Out' }, 'start'); // followed by stagger of any remaining texts
          gsap.fromTo(
            section.querySelectorAll('.to-stagger-first'),
            { opacity: 0, y: 50, },
            {
              opacity: 1,
              y: 0,
              delay: section.querySelector('.to-stagger') != null ? 0.5 : 0,
              ease: 'power1.Out',
              stagger: {
                each: 0.3,
                ease: 'power1.inOut',
              },
            }
          );
        }
        gsap.fromTo(
          section.querySelectorAll('.to-stagger'),
          { opacity: 0, y: 50 },
          {
            opacity: 1,
            y: 0,
            delay: section.querySelector('.to-stagger-first') != null ? 0.8 : 0,
            ease: 'power1.Out',
            stagger: {
              each: 0.3,
              ease: 'power1.inOut',
            },
          }
        );
      },
    });
  });

  /*newsText animation start*/
  if ($('#newsText').length) {

    var topics = document.querySelector('.newsTopics').cloneNode(true);
    document.getElementById("newsText").appendChild(topics);

    gsap.to('.newsTopics', 50, { x: -topics.offsetWidth, repeat: -1, ease: Linear.easeNone });
  }
  /*newsText animation end*/


  footer_trigger();

}
/*homepage triggers end*/

index_trigger()

init_stagger_trigger()

footer_trigger();


window.onload = function () {

  gsap.from(".header-top", { opacity: 0, duration: 1, delay: .5 });
  gsap.fromTo('.main-inner', { opacity: 0 }, { opacity: 1, duration: 0.8 })
  gsap.from(".intro-box", { opacity: 0, y: 100, duration: 1, delay: 1, ease: 'power1.out' });
}

/*header hide show anim start*/
const showAnim = gsap.from('.header-top', {
  yPercent: -100,
  paused: true,
  duration: 0.2,
  scrollTrigger: {
    onUpdate: (self) => {
      self.direction === -1 ? showAnim.play() : showAnim.reverse()
    }
  }
}).progress(1);
/*header hide show anim end*/



/*marker for developement*/
if (document.querySelector('.gsap-marker-scroller-start')) {
  const markers = gsap.utils.toArray('[class *= "gsap-marker"]');

  bodyScrollBar.addListener(({ offset }) => {
    gsap.set(markers, { marginTop: -offset.y })
  });
}
/*marker for developement end*/


/*product single page sidebar sticky script start*/
ScrollTrigger.saveStyles(".sidebarContent-box");

/*** Different ScrollTrigger setups for various screen sizes (media queries) ***/
ScrollTrigger.matchMedia({

  // desktop
  "(min-width: 1200px)": function () {
    // setup animations and ScrollTriggers for screens over 1200px wide (desktop) here...
    // ScrollTriggers will be reverted/killed when the media query doesn't match anymore.
    var action = gsap.to('.sidebarContent-box', {});

    ScrollTrigger.create({
      trigger: ".sidebarContent-box",
      start: "top top",
      endTrigger: '.summary-wrap',
      end: 'center top',
      markers: false,
      pin: true,
      pinSpacing: false,
      animation: action,
      toggleActions: 'play reverse play reverse'
    });
  },
  // all 
  "all": function () {
    // ScrollTriggers created here aren't associated with a particular media query,
    // so they persist.
  }

});
/*product single page sidebar sticky script end*/




/*dashboard sidebar sticky script start*/
ScrollTrigger.saveStyles(".profile-wrapper .woocommerce-MyAccount-navigation");

/*** Different ScrollTrigger setups for various screen sizes (media queries) ***/
ScrollTrigger.matchMedia({

  // desktop
  "(min-width: 768px)": function () {
    // setup animations and ScrollTriggers for screens over 1200px wide (desktop) here...
    // ScrollTriggers will be reverted/killed when the media query doesn't match anymore.
    var action = gsap.to('.profile-wrapper .woocommerce-MyAccount-navigation', {});

    ScrollTrigger.create({
      trigger: ".profile-wrapper .woocommerce-MyAccount-navigation",
      start: "top top",
      endTrigger: '.socialCart-box',
      end: 'bottom bottom',
      markers: false,
      pin: true,
      pinSpacing: true,
      animation: action,
      toggleActions: 'play reverse play reverse'
    });
    $('body').on('change', '#ship-checkbox', function(){
      setTimeout(function(){
        
        ScrollTrigger.refresh();
      },405)
    });
  },
  // all 
  "all": function () {

  }

});

/*dashboard sidebar sticky script end*/
