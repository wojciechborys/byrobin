// plugin install
gsap.registerPlugin(ScrollTrigger);
// let gsap = gsap.timeline({});
var scroll_element = '#scrollbar-wrap';

// 3rd party library setup:
const scrollWrap = document.querySelector(scroll_element);
const bodyScrollBar = Scrollbar.init(scrollWrap, { damping: 0.1, delegateTo: document, 
   alwaysShowTracks: true 
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
    return {top: 0, left: 0, width: window.innerWidth, height: window.innerHeight};
  }
});

// when the smooth scroller updates, tell ScrollTrigger to update() too: 
bodyScrollBar.addListener(ScrollTrigger.update);
ScrollTrigger.defaults({ scroller: scrollWrap });
// 3rd party library setup: end


Scrollbar.init(document.querySelector('.searchPopup'));




/*header animations start*/
gsap.from(".header-top", {opacity: 0, duration: 1,delay : .5});

var topNav = document.querySelector('.header-top');
var areascroll = document.querySelector('.banner-box');
var bodyHright = document.querySelector('.main-inner');
ScrollTrigger.create({
  scroller: scroll_element,
  trigger: areascroll,
  markers: true,
  start: 'bottom 0',
  end: () => `+=${bodyHright.clientHeight }`,
  toggleActions: 'play reverse none reverse',
  toggleClass: {targets: topNav, className: "dark-active"},
  // onLeave: () => function() {
  //   elementFirst.classList.toggle('active');
  // },
});
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
    tl_circle.fromTo(section.querySelector('.circle-text svg'), { rotation:0, }, { rotation: 150 });
  });
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
        once: true,
        onEnter: function onEnter(ev) {
            // console.log('stagger triggered');

            // title animate first
            if (section.querySelector('.to-stagger-first') != null) {
              // gsap.fromTo(section.querySelector('.to-stagger-first'), { opacity: 0 }, { opacity: 1, duration: 0.7, ease: 'power1.inOut' }, 'start');
              // gsap.fromTo(section.querySelector('.to-stagger-first'), { y: 70 }, { y: 0, duration: 0.7, ease: 'power2.Out' }, 'start'); // followed by stagger of any remaining texts
              gsap.fromTo(
                 section.querySelectorAll('.to-stagger-first'),
              { opacity: 0, y: 50 ,},
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
                { opacity: 0, y: 50},
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
  var topics = document.querySelector('.newsTopics').cloneNode(true);
  document.getElementById("newsText").appendChild(topics);

  gsap.to('.newsTopics',50,{x:-topics.offsetWidth,repeat:-1,ease:Linear.easeNone});
  /*newsText animation end*/


  footer_trigger();

}
/*homepage triggers end*/

index_trigger() 

init_stagger_trigger()

footer_trigger();

gsap.fromTo('.main-inner',{opacity:0},{ opacity: 1, duration:0.8})
gsap.from(".intro-box", {opacity: 0, y: 100, duration: 1, delay : 1, ease : 'power1.out'});


/*header hide show anim start*/
const showAnim = gsap.from('.header-top', { 
  yPercent: -100,
  paused: true,
  duration: 0.2,
	scrollTrigger:{
		onUpdate: (self) => {
			self.direction === -1 ? showAnim.play() : showAnim.reverse()
		}
	}
}).progress(1);
/*header hide show anim end*/










if (document.querySelector('.gsap-marker-scroller-start')) {		
  const markers = gsap.utils.toArray('[class *= "gsap-marker"]');	

  bodyScrollBar.addListener(({ offset }) => {  
    gsap.set(markers, { marginTop: -offset.y })
  });
}
