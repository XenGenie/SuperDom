/* =Main INIT Functions
-------------------------------------------------------------- */
function initializeGfi() {

	"use strict";

	//IE9 RECOGNITION
	if (jQuery.browser.msie && jQuery.browser.version == 9) {

		jQuery('html').addClass('ie9');
	}

	//NAVIGATION CUSTOM FUNCTION
	jQuery(document).goforNavigation();

	//LOCAL SCROLL
	jQuery('.bt-menu, .golink, .call-to-action').localScroll({
		offset: 0
	});

	jQuery("#top").click(function () {
		return jQuery("body,html").stop().animate({
			scrollTop: 0
		}, 800, "easeOutCubic"), !1;
	});

	//RESPONSIVE HEADINGS
	jQuery("h1").fitText(1.8, { minFontSize: '30px', maxFontSize: '52px' });
	jQuery("h2").fitText(1.5, { minFontSize: '20px', maxFontSize: '36px' });


	//HERO DIMENSTION AND CENTER
	(function() {
	    function heroInit(){
	       var hero = jQuery('.hero'),
				ww = jQuery(window).width(),
				wh = jQuery(window).height(),
				heroHeight = wh;

			hero.css({
				height: heroHeight+"px",
			});

			var heroContent = jQuery('.hero .content'),
				contentHeight = heroContent.height(),
				parentHeight = hero.height(),
				topMargin = (parentHeight - contentHeight) / 2;

			heroContent.css({
				"margin-top" : topMargin+"px"
			});
	    }

	    jQuery(window).on("resize", heroInit);
	    jQuery(document).on("ready", heroInit);
	})();

	//HERO TICKER
	var current = 1; 
	var height = jQuery('.ticker').height(); 
	var numberDivs = jQuery('.ticker').children().length; 
	var first = jQuery('.ticker h1:nth-child(1)'); 
	setInterval(function() {
	    var number = current * -height;
	    first.css('margin-top', number + 'px');
	    if (current === numberDivs) {
	        first.css('margin-top', '0px');
	        current = 1;
	    } else current++;
	}, 2500);

	//SERVICES TOOLTIP
	(function() {
		function tooltipInit(){
			var tooltip = jQuery('.tooltip'),
				target = jQuery('.icon'),
				arrow = jQuery ('.arrow-down'),
				mobile = jQuery(window).width() < 960,
				desktop = jQuery(window).width() > 960

			if (mobile) {

				jQuery( ".overview:odd" ).addClass('pull-left');

				target.click(function(){
					target.css({ "background-position": "top" });
					jQuery(this).css({ "background-position": "bottom" });

					tooltip.removeClass('visible'); arrow.removeClass('visible');
					jQuery(this).siblings('.tooltip, .arrow-down').addClass('visible');
				});

				tooltip.click(function(){
					jQuery(this).removeClass('visible');
					jQuery(this).siblings('.arrow-down').removeClass('visible');
					jQuery(this).siblings('.icon').css({
						"background-position": "top"
					});
				});

				target.unbind('mouseenter');
				target.unbind('mouseleave');
			}

			if (desktop) {
				jQuery('.pull-left').removeClass('pull-left');
				target.css({"background-position" : "top"})
				tooltip.removeClass('visible');
				arrow.removeClass('visible');
				target.bind('mouseenter', function(){
					jQuery(this).siblings('.tooltip, .arrow-down').addClass('visible');
					jQuery(this).css({"background-position" : "bottom"});

					var removeTooltip = function(){ tooltip.removeClass('visible'); arrow.removeClass('visible'); };
					target.bind( 'mouseleave', removeTooltip );
					target.bind( 'mouseleave', function(){
						jQuery(this).css({"background-position" : "top"});
					});
				});
			}

		}

		jQuery(window).on("resize", tooltipInit);
	    jQuery(document).on("ready", tooltipInit);

	})();

	//ANIMATIONS
	jQuery('.animated').appear();

	jQuery(document.body).on('appear', '.fade', function() {
		jQuery(this).each(function(){ jQuery(this).addClass('ae-animation-fade') });
	});
	jQuery(document.body).on('appear', '.slide', function() {
		jQuery(this).each(function(){ jQuery(this).addClass('ae-animation-slide') });
	});
	jQuery(document.body).on('appear', '.hatch', function() {
		jQuery(this).each(function(){ jQuery(this).addClass('ae-animation-hatch') });
	});
	jQuery(document.body).on('appear', '.entrance', function() {
		jQuery(this).each(function(){ jQuery(this).addClass('ae-animation-entrance') });
	});

	//TIMER
	jQuery('.timer').appear();
	jQuery(document.body).on('appear', '.timer', function() {
		jQuery(this).countTo();
	});

	jQuery(document.body).on('disappear', '.timer', function() {
		jQuery(this).removeClass('timer');
	});

	//QUOTES
	jQuery('.bxslider').bxSlider({
		mode: 'fade',
		touchEnabled: true,
		oneToOneTouch: true,
		pagerCustom: '#bx-pager',
		nextSelector: '#bx-next',
  		prevSelector: '#bx-prev',
		nextText: 'next',
		prevText: 'prev'
	});

	

	//PARALLAX EFFECTS
	jQuery('.parallax-bg1').parallax("50%", 0.5);
	jQuery('.parallax-bg2').parallax("50%", 0.5);
	jQuery('.parallax-bg3').parallax("50%", 0.1);
	jQuery('.parallax-bg4').parallax("50%", 0.4);

	
			
	
	
	//BLOG SLIDER
	jQuery(".gallery").bxSlider({
		pager: false,
		nextSelector: ".gallery-next",
		prevSelector: ".gallery-prev",
		nextText: "next",
		prevText: "prev"
	});	

	//FULLSCREEN SLIDER CONTROLS
	jQuery('#vegas-next').click(function(){
		jQuery.vegas('next');

		return false;
	});
	jQuery('#vegas-prev').click(function(){
		jQuery.vegas('previous');

		return false;
	});

};



/* =Window Load Trigger
-------------------------------------------------------------- */
jQuery(window).load(function(){

	jQuery(window).trigger( 'hashchange' );
	jQuery(window).trigger( 'resize' );
  	jQuery('[data-spy="scroll"]').each(function () {
    	var $spy = $(this).scrollspy('refresh');
	});

});
/* END ------------------------------------------------------- */


/* =Document Ready Trigger
-------------------------------------------------------------- */
jQuery(document).ready(function(){

	initializeGfi();

	jQuery('#parallax-no').click(function(){
		jQuery('.parallax').each(function(){
			jQuery(this).addClass('no-parallax')
		});

		return false;
	});

	jQuery('#parallax-yes').click(function(){
		jQuery('.parallax').each(function(){
			jQuery(this).removeClass('no-parallax')
		});

		return false;
	});

	jQuery('#default').click(function(){
		return false;
	});

});
/* END ------------------------------------------------------- */

jQuery(document).ready(function($) {
		$(".icongfi").longshadows({
			boxShadowLength : 0,
			textShadowColor : "#222222",
			textShadowLength : 100
		});
	});