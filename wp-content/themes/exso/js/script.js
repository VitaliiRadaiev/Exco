jQuery(document).ready(function ($) {


$("img.lazy").lazyload({
    effect : "fadeIn"
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

/*$('.b-dot').tooltip('toggle')*/

var swiper = new Swiper('.b-works-slider', {
      slidesPerView: 4,
      slidesPerColumn: 2,
      slidesPerGroup: 2,
      spaceBetween: 22,
      lazy: true,
      slidesPerColumnFill: 'row',
      direction: 'horizontal',
      navigation: {
        nextEl: '.b-arrow__next',
        prevEl: '.b-arrow__prev',
      },  
      breakpoints: {
        // when window width is >= 320px
        1450: {
          slidesPerView: 4,
          spaceBetween: 22,
        },
        1230: {
          slidesPerView: 5,
          spaceBetween: 22,
        },                 
        992: {
          slidesPerView: 4,
          spaceBetween: 22,
        },
        // when window width is >= 480px
        768: {
          slidesPerView: 4,
          spaceBetween: 22,
        },
        // when window width is >= 640px
        320: {
          slidesPerView: 1,
          slidesPerColumn: 1,
          slidesPerView: 'auto',
          freeMode: true,
          spaceBetween: 20,
          pagination: {
            el: '.works-pagination',
            clickable: true,
          }       
        }
      }         
});

var swiper = new Swiper('.b-reviews-slider', {
      slidesPerView: 3,
      spaceBetween: 44, 
      pagination: {
        el: '.reviews-pagination',
        clickable: true,
      },
      breakpoints: {
        // when window width is >= 320px
        992: {
          slidesPerView: 3,
          spaceBetween: 44,
        },
        // when window width is >= 480px
        768: {
          slidesPerView: 2,
          spaceBetween: 30,
        },
        // when window width is >= 640px
        320: {
          slidesPerView: 1,
          spaceBetween: 44,
        }
      }     
});



// google maps

// When the window has finished loading create our google map below
google.maps.event.addDomListener(window, 'load', init);

function init() {
    // Basic options for a simple Google Map
    // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
    var mapOptions = {
        // How zoomed in you want the map to start at (always required)
        zoom: 15,
        disableDefaultUI: true,

        // The latitude and longitude to center the map (always required)

        center: new google.maps.LatLng(50.492691010922705, 30.472400354906117), // New York

        // How you would like to style the map. 
        // This is where you would paste any style found on Snazzy Maps.
        styles: [
    {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#e9e9e9"
            },
            {
                "lightness": 17
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#f5f5f5"
            },
            {
                "lightness": 20
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ffffff"
            },
            {
                "lightness": 17
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "color": "#ffffff"
            },
            {
                "lightness": 29
            },
            {
                "weight": 0.2
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#ffffff"
            },
            {
                "lightness": 18
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#ffffff"
            },
            {
                "lightness": 16
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#f5f5f5"
            },
            {
                "lightness": 21
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#dedede"
            },
            {
                "lightness": 21
            }
        ]
    },
    {
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#ffffff"
            },
            {
                "lightness": 16
            }
        ]
    },
    {
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "saturation": 36
            },
            {
                "color": "#333333"
            },
            {
                "lightness": 40
            }
        ]
    },
    {
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#f2f2f2"
            },
            {
                "lightness": 19
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#fefefe"
            },
            {
                "lightness": 20
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "color": "#fefefe"
            },
            {
                "lightness": 17
            },
            {
                "weight": 1.2
            }
        ]
    }
]

    };

    // Get the HTML DOM element that will contain your map 
    // We are using a div with id="map" seen below in the <body>
    var mapElement = document.getElementById('map');

    // Create the Google Map using our element and options defined above
    var map = new google.maps.Map(mapElement, mapOptions);

    // Let's also add a marker while we're at it
    var marker = new google.maps.Marker({ 
        position: new google.maps.LatLng(50.492691010922705, 30.472400354906117),
        map: map,
      title: 'Snazzy!',
                icon: {
                    url: "/wp-content/themes/exso/images/svg/pin.svg",
                    scaledSize: new google.maps.Size(48, 48),
                    labelOrigin: new google.maps.Point(145, 25, 5),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(36, 49)           
                }     

    });

}

$('.btn-menu').click(function(){
  $('.b-header__drodown').toggleClass('active');
  $('.btn-menu').toggleClass('active');
}); 

$('.menu-icon').click(function(){
  $('.b-header-content , body').toggleClass('active');
  $('.menu-icon').toggleClass('active');
}); 

$(document).on('click', function(event) {
  if (!$(event.target).closest(".menu-icon , .b-header-content").length) {
    $('.b-header-content , body').removeClass('active');
    $('.menu-icon').removeClass('active');
  }
  event.stopPropagation();
});


function moveMenu(){
  if ($(window).width() < 1230) {

        $('.b-social').appendTo('.b-header-content');

           
  } else{
         $(function(){ 


        $('.b-social').appendTo('.b-side .b-social__wrap');
 
          
           
     })        
  }
}
moveMenu();

$(window).resize(function(){
    moveMenu();
});


$('.b-footer-item__top').click(function(){
  $(this).next().slideToggle();
  $(this).toggleClass('active');
}); 


$(".b-side-nav a,a[href='#top'],a[rel='m_PageScroll2id'],.page-em__nav a").mPageScroll2id({
    scrollSpeed: 1500,
    offset: 100,
    forceSingleHighlight:true,
    highlightSelector:".b-side-nav ul li a"
});


// Плавный скроллинг к якорю
$('.b-section-nav a[href^="#"]').click(function(){
var target = $(this).attr('href');
$('html, body').animate({scrollTop: $(target).offset().top}, 400);
return false;
});

// Плавный скроллинг к якорю
$('.b-footer-item__nav a[href^="#"]').click(function(){
var target = $(this).attr('href');
$('html, body').animate({scrollTop: $(target).offset().top}, 400);
return false;
});

// Плавный скроллинг к якорю
$('.b-person-item a[href^="#"]').click(function(){
var target = $(this).attr('href');
$('html, body').animate({scrollTop: $(target).offset().top}, 400);
return false;
});

 
$('#show').click(function(){
  $('.b-features-content > .row > div').toggleClass('active');
  $('#show').toggleClass('active');
}); 

$('.b-faq-item__ico , .b-faq-item__content b').click(function(){
  $(this).parent().parent().toggleClass('active');
  $('.b-faq-item__ico , .b-faq-item__content b').toggleClass('active');
}); 


function moveMenu2(){
  if ($(window).width() < 768) {
         $(function(){ 

           
        })            
  } else{
         $(function(){ 

              setTimeout(function() {
                  $('.animate-down').addClass("animated").viewportChecker({
                    classToAdd: 'fadeInDown',
                    offset: 0
                  });
              }, 500);

              setTimeout(function() {
                  $('.animate-left').addClass("animated").viewportChecker({
                    classToAdd: 'fadeInLeft',
                    offset: 0
                  });
              }, 1400);
              setTimeout(function() {
                  $('.animate-right').addClass("animated").viewportChecker({
                    classToAdd: 'fadeInRight',
                    offset: 0
                  });
              }, 1400);
              setTimeout(function() {
                  $('.animate-back-in-right').addClass("animated").viewportChecker({
                    classToAdd: 'animate__backInRight',
                    offset: 0
                  });
              }, 1400);                              
              setTimeout(function() {
                  $('.animate-top').addClass("animated").viewportChecker({
                    classToAdd: 'fadeInUp',
                    offset: 0
                  });
              }, 1200);                                          
           
     })        
  }
}
moveMenu2();

$(window).resize(function(){
    moveMenu2();
});


});


