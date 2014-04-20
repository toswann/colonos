$(window).load(function() {
  // The slider being synced must be initialized first
/*
  $('#carousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 210,
    itemMargin: 5,
    asNavFor: '#slider'
  });
 
  $('#slider').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    sync: "#carousel"
  });
*/

$('#slider').flexslider({
	animation: "slide",
	controlNav: false,
	animationLoop: false,
	slideshow: false,
	after: function(slider) {
	  var slides = slider.slides,
	          index = slider.animatingTo,
	          $slide = $(slides[index]),
	          $img = $slide.find('img[data-src]');
	  if ($img.length) {
	     $img.attr("src", $img.attr('data-src')).removeAttr("data-src");
	     $img.removeClass("lazy");
	  }
	}
});

});

