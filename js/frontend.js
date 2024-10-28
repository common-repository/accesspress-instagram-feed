jQuery(document).ready(function($) {

  $('.ifgrid').isotope({
    // options
    itemSelector: '.element-itemif',
    // layoutMode: 'fitRows'
  });

  $(".apif-owl-carousel").owlCarousel({
    margin: 10,
    loop: true,
    autoplay: true,
    autoplaySpeed:500,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 2
      },
      1000: {
        items: 3
      }
    }
  });


  $( '.ri-grid' ).gridrotator({
      rows : '2',
      columns : '5',
      maxStep : 2,
      interval : 2000,
      preventClick : false,
      w1024 : {
          rows : '2',
          columns : '5'
      },
      w768 : {
          rows : '2',
          columns : '5'
      },
      w480 : {
          rows : '2',
          columns : '5'
      },
      w320 : {
          rows : '2',
          columns : '5'
      },
      w240 : {
          rows : '2',
          columns : '5'
      }
  });

});

// Mosaic View Layout Javascript
function initHoverEffectForThumbView() {
    jQuery('.thumb-elem, .grid-elem header').each(function(){
      var thisElem = jQuery(this);
      var getElemWidth = thisElem.width();
      var getElemHeight = thisElem.height();
      var centerX = getElemWidth/2;
      var centerY = getElemHeight/2;

      thisElem.mouseenter(function(){
        thisElem.on('mousemove', function (e) {
          var mouseX = e.pageX - thisElem.offset().left;
                var mouseY = e.pageY - thisElem.offset().top;
                var mouseDistX = (mouseX / centerX) * 100 - 100;
                var mouseDistY = (mouseY / centerY) * 100 - 100;
//                thisElem.find('img.the-thumb').css({
//                  'left': -(mouseDistX/6.64) - 15 + "%",
//                    'top':  -(mouseDistY/6.64) - 15 + "%"
//                });
//                thisElem.find('source.the-thumb').css({
//                  'left': -(mouseDistX/6.64) - 15 + "%",
//                    'top':  -(mouseDistY/6.64) - 15 + "%"
//                });
        });

        thisElem.find('.thumb-elem-section:not(.no-feat-img)').fadeIn('fast');
      }).mouseleave(function(){
        thisElem.find('.thumb-elem-section:not(.no-feat-img)').fadeOut('fast');
      });
    });
}


function initSimpleHoverEffectForThumbView() {
    jQuery('.thumb-elem, .grid-elem header').each(function(){
      var thisElem = jQuery(this);
      thisElem.mouseenter(function(){
        thisElem.find('.thumb-elem-section:not(.no-feat-img)').fadeIn('fast');
      }).mouseleave(function(){
        thisElem.find('.thumb-elem-section:not(.no-feat-img)').fadeOut('fast');
      });
    });
}

jQuery(window).load(function() {
  "use strict";

    if (!hoverEffect.disable_hover_effect && jQuery(window).width() > 768) {
        initHoverEffectForThumbView();
    }else{
        initSimpleHoverEffectForThumbView();
    }
});
var hoverEffect = {"disable_hover_effect":""};
