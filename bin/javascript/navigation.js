

(function($)
{

	"use strict";
	
	$.fn.goforNavigation = function(){

		var navigationButton = jQuery('.nav-button'),
			navigation = jQuery('.navigation'),
			navigationHeight = jQuery('.logo').height(),
			windowWidth = jQuery(window).width();

		jQuery('#main-content section:first-child').css({
			"margin-top" : navigationHeight + 30 + "px"
		});

		var sections = jQuery('section');
		var navigation_links = jQuery('nav a');
		sections.waypoint({
		handler: function(direction) {
			var active_section;
			active_section = jQuery(this);
			if (direction === "up") active_section = active_section.prev();
			var active_link = jQuery('nav a[href="#' + active_section.attr("id") + '"]');
			navigation_links.removeClass("active");
			active_link.addClass("active");
		},
		offset: '10%'
		});

		if ( windowWidth > 960 ) {
	  		navigation.addClass('desktop');
	  		navigation.removeClass('mobile');
	  	}

	  	if ( windowWidth < 960 ) {
	  		navigation.addClass('mobile');
	  		navigation.removeClass('desktop');
	  	}

	  	navigationButton.click(function(){
			if(navigation.is(':hidden')) {
				navigation.slideDown();
			} else {
				navigation.slideUp();
			}
		});

	  	jQuery('.navigation a').click(function(){
	  		if(navigation.is(':visible') && navigation.hasClass('mobile')) {
	  			navigation.slideUp();
	  		}
	  	});

	  	jQuery(window).resize(function() {
			var ww = jQuery(window).width(),
				nav = jQuery('.navigation');

		  	if ( ww > 960 ) {
		  		nav.addClass('desktop');
		  		nav.removeClass('mobile');
		  	}

		  	if ( ww < 960 ) {
		  		nav.addClass('mobile');
		  		nav.removeClass('desktop');
		  	}
		});
	};

})(jQuery);