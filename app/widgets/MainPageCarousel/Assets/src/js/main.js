$(document).ready(function(){
  $(".carousel-inner").owlCarousel({
		singleItem: true,
		navigation: true,
		autoplayTimeout: 3000,
		responsiveClass: true,
		//Basic Speeds
	    slideSpeed: 800,
	    paginationSpeed : 800,
	    rewindSpeed : 1000,
	 
	    //Autoplay
	    autoPlay : true,
	    stopOnHover : true,
	    navigationText: ["<a class=\"left carousel-control\" href=\"#top_slider\" data-slide=\"prev\"><span class=\"fa fa-arrow-left\" aria-hidden=\"true\"></span><span class=\"sr-only\">Prev</span>",
	    				"<a class=\"right carousel-control\" href=\"#top_slider\" data-slide=\"next\"><span class=\"fa fa-arrow-right\" aria-hidden=\"true\"></span><span class=\"sr-only\">Next</span></a>"],            
  });
});


