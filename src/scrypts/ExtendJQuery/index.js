/* global jQuery */
/* global define */
/* global require */
/* global module */

/** В этом модуле используются дополнительные компоненты, расширяющие библтиотеку JQuery */
(function (factory) {
	"use strict";
	if (typeof define === 'function' && define.amd) {
		define(['jquery'], factory);
	}
	else if(typeof module !== 'undefined' && module.exports) {
		module.exports = factory(require('jquery'));
	}
	else {
		factory(jQuery);
	}
}(function ($) {
   $.fn.displayMessage = function(message) {
        var $obj = this;
        $obj.find('.alert').remove();
        $obj.prepend(message);
        return $obj;        
    }

}));