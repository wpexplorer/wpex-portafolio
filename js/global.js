(function($) {
	"use strict";
	$(document).ready(function(){

		// Menu
		$( 'ul.dropdown-menu li' ).hover(function(){
			$(this).children( 'ul' ).stop(true,true).fadeIn(300);
		},function(){
			$(this).children( 'ul' ).stop(true,true).fadeOut(300);
		});

		// Comment scrolling
		$( '.comment-scroll a' ).click( function( event ) {		
			event.preventDefault();
			$( 'html,body' ).animate({
				scrollTop: $( this.hash ).offset( ).top
			}, 'normal' );
		});

		// Response videos
		if ( $.fn.fitVids != undefined ) {
			$( ".fitvids" ).fitVids();
		}

		// Prepend Mobile menu
		$('#masthead-wrap').append('<nav class="wpex-mobile-nav"></nav>');
		// Grab all content from menu and add into wpex-mobile-nav element
		var mobileMenuContents = $('.main-nav').html();
		$('.wpex-mobile-nav').html('<ul class="wpex-mobile-nav-ul container">' + mobileMenuContents + '</ul>');
		// Remove all classes inside prepended nav
		$('.wpex-mobile-nav-ul, .wpex-mobile-nav-ul *').children().each(function() {
			var attributes = this.attributes;
			$(this).removeAttr("style");
		});
		// Main toggle
		$('.mobile-menu-toggle').click( function(e) {
			$('.wpex-mobile-nav').toggle();
			return false;
		});
		// Close on orientation change and resize
		$( window ).on( "orientationchange", function( event ) {
			$('.wpex-mobile-nav').hide();
		});
		$( window ).on('resize', function() {
			$('.wpex-mobile-nav').hide();
		} );
		

		// Lightbox
		$('.wpex-lightbox').magnificPopup( {
			type: 'image'
		} );
		$('.wpex-gallery-lightbox').each( function() {
			$(this).magnificPopup({
				delegate: '.slide:not(.clone) a',
				type: 'image',
				gallery: {
					enabled: true
				}
			});
		});
		
	
	});
		
	$(window).load(function() {
		// Homepage slider
		if ( $.fn.flexslider != undefined ) {
			$( 'div#home-slider' ).removeClass( 'loading' );
			$( 'div#home-slider.flexslider' ).flexslider({
				animation: 'slide',
				smoothHeight: true,
				controlNav: false,
				prevText: '<i class="fa fa-chevron-left"></i>',
				nextText: '<i class="fa fa-chevron-right"></i>'
			});
			// Portfolio
			$( 'div#single-portfolio-media .flexslider' ).flexslider({
				animation: 'slide',
				slideshow: false,
				smoothHeight: true,
				directionNav: false,
				controlNav: true,
				prevText: '<i class="fa fa-chevron-left"></i>',
				nextText: '<i class="fa fa-chevron-right"></i>'
			});
		}
	});
	
})(jQuery);