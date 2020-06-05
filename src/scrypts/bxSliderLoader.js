let $ = window.$;
class bxSliderLoader {
    init() {
        if($(window).width() > 600){
		$('.film-cat__slider').each(function(){
			if($(this).children().length > 6){
				$(this).bxSlider({
                    minSlides: 1,
					maxSlides: 6,
					slideWidth: 170,
					slideMargin: 30,
					adaptiveHeight: false,
					pager: false,
					moveSlides: 3
                });
			}
		});
	} else{
		$('.film-cat__slider').bxSlider({
            minSlides: 1,
			maxSlides: 6,
			slideWidth: 110,
			slideMargin: 15,
			adaptiveHeight: false,
			pager: false,
			moveSlides: 3
        });
	}
    }
}
export default bxSliderLoader;