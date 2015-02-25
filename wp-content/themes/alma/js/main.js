//cache vars
var window_height;
var _body = jQuery('body');
var $container = jQuery('.portfolio-items');
var preloader  = jQuery('#preloader');

var header_menu_style = ( jQuery('header.menu').hasClass('nav2') ? 'nav2' : 'nav1');
var logo_height = jQuery('.navbar-brand').height();

var header_menu = jQuery('header.menu');//:not(.nav2)

var menu_clone  = jQuery('.navbar-nav').clone();
var menu_desktop = jQuery('#menu-desktop');
var menu_mobile  = jQuery('#menu-mobile');

// For use within normal web clients 
var isiPad = navigator.userAgent.match(/iPad/i) != null;
var is_safari = !!navigator.userAgent.match(/Version\/[\d\.]+.*Safari/)

// keydown nav
var existeMenus = jQuery( "nav.menu-desktop ul.nav" ).find( "li" ).hasClass( "active");
var firstNavBt  = jQuery( "nav.menu-desktop ul.nav li:first-child");
var lastNavBt   = jQuery( "nav.menu-desktop ul.nav li:last-child");
var nextNavBt;

jQuery(document).keydown(function(e) {
	
	if (e.keyCode == 40) { /* Focus Down */

		if (existeMenus) {
			nextNavBt = jQuery('nav.menu-desktop ul.nav li.active').next('li');

			// Se for o ultimo ele volta para cima
			if (jQuery(nextNavBt).length == 1) {
				jQuery(nextNavBt).children("a").trigger('click');
			} else {
				jQuery(firstNavBt).children("a").trigger('click');
			}
			
		} else {
			existeMenus = true;
			jQuery(firstNavBt).children("a").trigger('click');
		}

		return false;
	} else if (e.keyCode == 38) { /* Focus Up */

		nextNavBt = jQuery('nav.menu-desktop ul.nav li.active').prev('li');
		jQuery(nextNavBt).children("a").trigger('click');

		return false;
	}
});


jQuery(document).ready(function() {

	// SON NOS BTS
	if (pt_settings.playSounds == true && isiPad == false) {

		AudioHtml   = '<audio id="beep0" controls preload="auto"><source src="'+ pt_settings.template_url + '/sound/clack.mp3" controls></source><source src="'+ pt_settings.template_url + '/sound/clack.ogg" controls></source></audio>';
		AudioHtml  += '<audio id="beep1" controls preload="auto"><source src="'+ pt_settings.template_url + '/sound/plusBtn.mp3" controls></source><source src="'+ pt_settings.template_url + '/sound/plusBtn.ogg" controls></source></audio>';
		
		jQuery( "body" ).append( AudioHtml );

		jQuery(".nav.navbar-nav a")
		.each(function(i) {
			if (i != 0) { 
				jQuery("#beep0")
				.clone()
				.attr("id", "beep0" + i)
				.appendTo(jQuery(this).parent()); 
			}
			jQuery(this).data("beeper", i);
		})
		.mouseenter(function() {
			jQuery("#beep0" + jQuery(this).data("beeper"))[0].play();
		});

		var beep1 = jQuery("#beep1")[0];
		//jQuery(".languages").mouseenter(function() { beep1.play(); });
		jQuery(".dropdown-toggle").click(function() { beep1.play(); });
		jQuery(".portfolio-active-category").mouseenter(function() { beep1.play(); });
 
		// Chama Todos
		jQuery("#beep0").attr("id", "beep00");

		// Musica Player
		if(pt_settings.show_musicPlayer == 1) {

			var musicPlayerHtml   = '<div class="musicWrapper"><audio id="pt_music" controls preload loop><source src="'+ pt_settings.musicPlayer + '" ></source></audio><ul class="loader play"><li></li><li></li><li></li><li></li><li></li></ul><span class="sound">'+ pt_settings.musicSound_msg +'</span><span class="on">'+ pt_settings.musicON_msg +'</span><span class="off active">'+ pt_settings.musicOFF_msg +'</span></div>';

			jQuery( "body section" ).first().append( musicPlayerHtml );
			var _music = jQuery("#pt_music")[0];
			_music.play();

			//Action
			jQuery('.musicWrapper').on('click touchstart', function(e) {
				if( jQuery('.loader').hasClass("pause") ) {
					_music.play();
					jQuery('.musicWrapper .loader').removeClass('pause');
					jQuery('.musicWrapper .loader').addClass('play');

					jQuery('.musicWrapper .off').addClass('active');
					jQuery('.musicWrapper .on').removeClass('active');
				} else {
					_music.pause();
					jQuery('.musicWrapper .loader').addClass('pause');
					jQuery('.musicWrapper .loader').removeClass('play');
					
					jQuery('.musicWrapper .on').addClass('active');
					jQuery('.musicWrapper .off').removeClass('active');
				}
			});

		}

	}


	// Responsive Video
	responsiveVideoIframesInit();
	responsiveVideoIframes();
	
	loop();


	// initialize Isotope
	$container.isotope(); 
	// layout Isotope again after all images have loaded
	$container.imagesLoaded( function() {
		$container.isotope('layout');
	});


	reload_js();

	resize_triggers(); 

	//Video Volume
	jQuery("video").each(function(){ this.volume = jQuery(this).attr('volume')/10; });

	//Resize Events
	jQuery(document).resize(function(){
		
		resize_triggers();
		responsiveVideoIframes();

	}).resize();


	_body.imagesLoaded().always( function( instance )
	{
		if ( preloader.height() ) {
			preloader.fadeOut(1000, function() {
				jQuery(this).remove();
				
				menu_animation();
			});
		}
		else
		{
			menu_animation();			
		}
	});


	function menu_animation()
	{
		if ( header_menu.is('.delayed') ) {

			jQuery('section:eq(1)').waypoint(function(direction)
			{
				if (direction === "down") {
					header_menu.addClass('show').delay(500).queue(function() {
						jQuery(this).dequeue();
					});
				}
				else {
					header_menu.removeClass('show');
				}
			}, { offset: '75%' });
		} else
		{
			header_menu.addClass('show').delay(500).queue(function() {
				jQuery(this).dequeue();
			});
		} 

		if ( header_menu.is('.hide_menu_bg_first_page') ) {
			if( header_menu.hasClass("delayed") ) {
				header_menu.removeClass('hide_menu_bg_first_page show');
			}
			else { 

				jQuery('section:eq(1)').waypoint(function(direction)
				{
					if ( direction === "down" ) {
						header_menu.removeClass('hide_menu_bg_first_page');
					}
					else {
						header_menu.addClass('hide_menu_bg_first_page').delay(500).queue(function() {
							jQuery(this).dequeue();
						});
					}
				}, { offset: '75%' });
			}
		}

		if ( !_body.hasClass('navbar-on-bottom') ) {
			var header_menu_offset = header_menu.offset();

			if ( header_menu_offset.top > jQuery(window).height()/2 ) {

				header_menu.addClass('show').delay(500).queue(function() {
					jQuery(this).dequeue();
				});

				header_menu.removeClass('hide_menu_bg_first_page');
			}
		}
	}


	// Abre procura
	jQuery('.navbar-search').on('click touchstart', function(e) {
		header_menu.addClass('searchOn');
	});

	// Fecha procura
	jQuery('.search_close').on('click touchstart', function(e) {
		header_menu.removeClass('searchOn');
	});


	//Menu Mobile
	jQuery('.navbar-toggle').bigSlide({
		'menu'      : '#menu-mobile',	//The attribute ID of the navigation menu
		//'push'      : '.pages-holder',	//The class given to additional elements to 'push' when the nav is toggled
		'side'      : 'left',	//The side of the navigation menu (either 'right' or 'left')
		'menuWidth' : '50%',	//The width of the navigation menu
		'speed'     : '300'		//The speed (in milliseconds) of the navigation menu
	});

	jQuery('.navbar-toggle').on('click touchstart', function(e) {
		header_menu.toggleClass('move');
	});


/* 
	TEAM ON IPAD/IPHONE
*/
	// Open / Close
	jQuery('.pt_team').on('touchstart', function(e) {
		if ( !jQuery(this).hasClass('visible') ) {
			jQuery(this).addClass('visible');
		} else {
			jQuery(this).removeClass('visible');
		}
	});


/* 
	Portfolio categories
*/
	
	// Open
	jQuery('.portfolio-active-category').on('mouseenter click', function(e) {
		e.stopPropagation();

		jQuery(this).next('.portfolio-categories').addClass('pt_CatAnimeIn fadeIn').removeClass('pt_CatAnimeOut');
		jQuery(this).addClass('active');
		
		e.preventDefault();
	});


	// Close
	jQuery('.portfolio-categories').on('mouseleave', function(e) {
		jQuery(this).addClass('pt_CatAnimeOut').removeClass('pt_CatAnimeIn fadeIn');
		jQuery(this).next('.portfolio-active-category').removeClass('active');
		
		e.preventDefault();
	});


	// Open on Mobile
	jQuery('.portfolio-active-category').on('touchstart', function(e) {
		e.stopPropagation();

		jQuery(this).next('.portfolio-categories').addClass('pt_CatAnimeIn fadeIn').removeClass('pt_CatAnimeOut');
		jQuery(this).addClass('active');
		
		e.preventDefault();
	});

	//Portfolio categories tablet/mobile
	jQuery('html').on('touchstart', function (e) {

		if ( jQuery('.portfolio-active-category').hasClass('active') ) {

			jQuery('.portfolio-categories').addClass('pt_CatAnimeOut').removeClass('pt_CatAnimeIn fadeIn');
			jQuery('.portfolio-active-category').removeClass('active');

			e.preventDefault();
		}
	});


/* 
	Portfolio Thumbs
*/
	
	// filter items when filter link is clicked
	jQuery('.portfolio-categories a').on('click touchend', function(e) {
		var selector 			= jQuery(this).attr('data-filter');
		var category 			= jQuery(this).find('span').html();
		var _thisPortfolio 		= jQuery(this).parentsUntil( ".portfolio-content" );
		var _thisCategoriList 	= jQuery(this).parents();
		
		_thisPortfolio.find('.portfolio-items').isotope({ filter: selector });

		_thisCategoriList.find('.portfolio-categories a').removeClass('selected');
		_thisPortfolio.find('.portfolio-active-category span').html(category);
		
		jQuery(this).addClass('selected');

		e.preventDefault();
	});

	//Portfolio Load More
	jQuery(document).on('click', '.load-portfolio a', function() {

		var count = 1;
		var portfolio_items = jQuery(this).parent().prev('.portfolio-items');
		var total_show = portfolio_items.attr('data-total-show');

		portfolio_items.find('li.to-show:lt('+ total_show +')').each(function( index ) {
			console.log(jQuery(this).attr('class') );
			if (jQuery(this).hasClass('to-show'))
			{
				jQuery(this).removeClass('to-show hidden').addClass('fadeIn animated delay' + count);
				count++;
			}
		});

		$container.isotope('layout');

		if ( !portfolio_items.find('li.to-show').length ) {
			jQuery(this).hide();
		}

		return false;
	});


	// Porfolio Detail Lightbox	
	jQuery('.portfolio-items .pt_portfolio_1 a').magnificPopup({
		type: 'ajax',
		//alignTop: true,
		removalDelay: 500, //delay removal by X to allow out-animation
		overflowY: 'scroll',
		callbacks: {
			ajaxContentAdded: function() {
				reload_js();
				resize_triggers();
			}
		}
	});

	jQuery('.portfolio-items .pt_portfolio_3').magnificPopup({
		delegate: 'a',
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		mainClass: 'mfp-img-mobile',
		image: {
			verticalFit: true
		},
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		callbacks: {
			beforeOpen: function(item) {

				var portfolio_id = this.st.el.attr('data-id')

				jQuery.ajax({
					url: pt_settings.ajaxurl,
					data:{'action':'pt_portfolio_ajax_gallery_function', 'portfolio_id': portfolio_id},
					dataType: 'JSON',
					success:function(data){
						if (data) {
							jQuery.magnificPopup.open({
								items: data,
								type: 'image'
							}, 0);
						}
					},
					error: function(errorThrown){
						console.log(errorThrown);
					}
				});
			}
		}
	});


	// Parallax
	jQuery('.parallax').each(function(index, el) {
		
		if (isiPad == false) {
			jQuery(this).parallax("50%", 0.2);
		} else
		{
			jQuery(this).addClass('parallax-ipad');
		}
	});



	/* localScroll */
	//jQuery.localScroll({
	jQuery('header, .localscroll').localScroll({
		easing : 'easeInOutExpo',
		hash : true,
		offset : 1
	});


	/* Scroll Top */
	jQuery(document).on('click', '.scroll-top', function() {
		jQuery('body').scrollTo({top : 0, left: 0}, 1200, {easing:'easeInOutExpo'});
		return false;
	});

	jQuery('.scroll-top').waypoint({
		handler: function(direction) {
			if (direction == 'down') {
				jQuery(this).addClass('visible');
			}
			else {
				jQuery(this).removeClass('visible');
			}
		},
		offset: '10%'
	});


	/* Page Bg Slider */
	jQuery('.slider-pt').bxSlider({
		pause: 8000, //The amount of time (in ms) between each auto transition
		speed: 600, //Slide transition duration (in ms)
		minSlides: 1,
		maxSlides: 1,
		slideMargin: 0,
		auto: true,
		video: true,
		easing: 'cubic-bezier(0.175, 0.885, 0.320, 1.275)',
		mode: 'fade',
		onSliderLoad: function(){
			//is_page_bg_slider_loaded = true;
			refresh_section_sliders();
		}
	});

	
	/* Bx slider Carousel */
	// jQuery('.pt-carousel').bxSlider({
	// 	minSlides: 1,
	// 	maxSlides: 1,
	// 	slideMargin: 0,
	// 	auto: false,
	// 	easing: 'cubic-bezier(0.77, 0, 0.175, 1)',
	// 	mode: 'horizontal',
	// 	adaptiveHeight: true
	// });

	jQuery('.pt-carousel').owlCarousel({
		'singleItem' : true,
		'autoHeight' : true
	});

});



function resize_triggers()
{
	var window_height = jQuery(window).height();
	var footer_height = jQuery('footer').height();

	jQuery('header.menu').removeClass('style');

	//clone menu for mobile version to avoid conflict
	if ( Modernizr.mq("screen and (max-width: 991px)") ) {
		header_menu.removeClass(header_menu_style);
		menu_clone.appendTo(menu_mobile);
		menu_desktop.empty();
	}
	else{
		header_menu.addClass(header_menu_style);
		menu_clone.appendTo(menu_desktop);
		//header_menu.removeClass('move');
		//menu_mobile.empty().css('left', '-50%');
	}

	refresh_section_sliders();

	jQuery.waypoints('refresh');

	if ( Modernizr.mq('only screen and (min-width: 768px)') ) {
		jQuery('.full-height, .full-height .content').css({'height' : window_height});
	}else{
		jQuery('.full-height, .full-height .content').css({'height' : '', 'min-height' : window_height});
	}
	
	jQuery('.footer-push').css({'height' : footer_height});

	jQuery('body').scrollspy('refresh');
}


function reload_js() 
{
	if (typeof pt_settings.js_composer !== "undefined" && pt_settings.js_composer == true) {

		/* VComposer */
		vc_twitterBehaviour();
		vc_toggleBehaviour();
		vc_tabsBehaviour();
		vc_accordionBehaviour();
		vc_teaserGrid();
		vc_carouselBehaviour();
		vc_slidersBehaviour();
		vc_prettyPhoto();
		vc_googleplus();
		vc_pinterest();
		vc_progress_bar();
		vc_waypoints();
		if ( typeof window['vc_pieChart'] !== 'undefined' ) {
			vc_pieChart();
		}
	
		/* Shortcodes */
		pt_magnificPopup();
		pt_swipebox();
		pt_textillate();
		pt_twitter_feed();
		pt_origami();
		pt_testimonials();
		pt_counter();
		pt_tipTop();
		pt_progress_bar();
		pt_countdown();
		pt_gallery();
		pt_contact_map();
		pt_lightwindow_share();
		pt_newsletter_form();
		pt_contact_form();
		pt_data_animation();
	}
}


function refresh_section_sliders()
{
	var parent_height;

	jQuery('.pt-slider-cover').each(function(index, val) {
		parent_height = jQuery(this).parents('section').height();
		jQuery(this).height(parent_height);
	});
}


/* Swipebox */
if ( typeof window['swipebox'] !== 'function' ) {
	function pt_swipebox() {
		if(jQuery().swipebox)
		{
			jQuery(".swipebox").swipebox();
		}
	}
}


/* MagnificPopup */
if ( typeof window['magnificPopup'] !== 'function' ) {
	function pt_magnificPopup() {
		if(jQuery().magnificPopup)
		{
			jQuery('.magnificPopup').magnificPopup({
				type: 'image',
				closeOnContentClick: true,
				closeBtnInside: false,
				mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
				image: {
					verticalFit: true
				},
				zoom: {
					enabled: true,
					duration: 300 // don't foget to change the duration also in CSS
				}
			});

			jQuery('.pt_gallery').magnificPopup({
				delegate: 'li:not(.bx-clone) a:not(.swipebox)',
				type: 'image',
				closeOnContentClick: true,
				closeBtnInside: false,
				mainClass: 'mfp-img-mobile',
				image: {
					verticalFit: true
				},
				gallery: {
					enabled: true,
					navigateByImgClick: true,
				preload: [0,1] // Will preload 0 - before current, and 1 after the current image
				}
			});
		}
	}
}


/* Textillate */
if ( typeof window['textillate'] !== 'function' ) {
	function pt_textillate()
	{
		jQuery('.tlt').textillate({
			loop: true,
			minDisplayTime: 2500,
			in: {
				effect: 'bounceInUp',
				delayScale: 1.5,
				delay: 50,
				sync: false,
				shuffle: false
			},
			out: {
				effect: 'bounceOutDown',
				delayScale: 1.5,
				delay: 50,
				sync: false,
				shuffle: false
			}
		});
	}
}


/* Twitter Feed */
if ( typeof window['tweet'] !== 'function' ) {
	function pt_twitter_feed()
	{
		if (typeof pt_settings.pt_twitter_username !== "undefined" && pt_settings.pt_twitter_username !== '' && pt_settings.pt_twitter_username !== ' ')
		{
			if (typeof pt_settings.pt_twitter_count == "undefined" || pt_settings.pt_twitter_count == '') {
				pt_settings.pt_twitter_count = 3;
			}

			var tweet = jQuery(".twitterfeed-feed").tweet({
				modpath: pt_settings.pt_twitter_path,
				join_text : "",
				count : pt_settings.pt_twitter_count,
				loading_text : "loading tweets...",
				username : pt_settings.pt_twitter_username,
				template : "{text}{join}{time}"
			});
		}
		else {
			jQuery('.twitterfeed').hide().remove();
		}
	}
}


/* Fold Button */
if ( typeof window['origami'] !== 'function' ) {
	function pt_origami()
	{
		jQuery('.fold-button').origami();
	}
}


/* Data Animation */
function pt_data_animation()
{
	jQuery('[data-animation]').waypoint({
		triggerOnce: true,
		offset: '90%',
		handler: function() {

			var ele = jQuery(this);
			var fx = ele.attr('data-animation');
			var delay = ele.attr('data-delay');

			if ( typeof delay === "undefined" ) {
				delay = 0;
			} else {
				delay = parseFloat(delay.replace(",","."));
			}

			setTimeout(function() {
				ele.addClass('animated ' + fx);
			}, delay*1000); 
		}
	});

	jQuery('.mfp-wrap [data-animation]').waypoint({
		triggerOnce: true,
		offset: '90%',
		context: '.mfp-wrap',
		handler: function() {

			var ele = jQuery(this);
			var fx = ele.attr('data-animation');
			var delay = ele.attr('data-delay');
			
			if ( typeof delay === "undefined" ) {
				delay = 0;
			} else {
				delay = parseFloat(delay.replace(",","."));
			}

			setTimeout(function() {
				ele.addClass('animated ' + fx);
			}, delay*1000); 
		}
	});
}


/* Testimonials */
function pt_testimonials()
{
	jQuery('.pt-testimonials').each(function() {

		var this_element = jQuery(this);

		this_element.owlCarousel({
			'singleItem' : true,
			'autoHeight' : true,
			'autoPlay'   : jQuery.parseJSON( this_element.attr('data-autoplay') ),
		});
	});


	jQuery('.pt-testimonials-image').each(function() {

		var this_element = jQuery(this);

		this_element.owlCarousel({
			'singleItem' : true,
			'autoHeight' : false,
			'pagination' : false,
			'slideSpeed' : 450,
			'paginationSpeed' :1700,

			'autoPlay'   : jQuery.parseJSON( this_element.attr('data-autoplay') ),
			'navigation' : jQuery.parseJSON( this_element.attr('data-navigation') ),
			'navigationText': [
			"<span class='owl-arrow-prev'></span>",
			"<span class='owl-arrow-next'></span>"
			]
		});
	});

}


/* Counter */
function pt_counter()
{
	jQuery('.pt-counter span').waypoint(function() {
		jQuery(this).each(function(index) {
			jQuery(this).countTo();
		});
	}, { offset: '85%'});

	jQuery('.mfp-wrap .pt-counter span').waypoint(function() {
		jQuery(this).each(function(index) {
			jQuery(this).countTo();
		});
	}, { offset: '85%', context: '.mfp-wrap' });
}


/* Progress Bar */
function pt_progress_bar()
{
	jQuery('.pt-progress-bar').waypoint(function() {
		jQuery(this).each(function(index) {
			var bar = jQuery(this).find('.progress-bar');
			var val = bar.attr('data-value');
			setTimeout(function(){ bar.css({"width" : val+'%'}); }, index*200);
		});
	}, { offset: '85%' });

	jQuery('.mfp-wrap .pt-progress-bar').waypoint(function() {
		jQuery(this).each(function(index) {
			var bar = jQuery(this).find('.progress-bar');
			var val = bar.attr('data-value');
			setTimeout(function(){ bar.css({"width" : val+'%'}); }, index*200);
		});
	}, { offset: '85%', context: '.mfp-wrap' });
}


/* Clientes Toltips */
function pt_tipTop()
{
	jQuery('.pt_clients a[title]').tipTop({'offsetVertical': 20,'offsetHorizontal':20});
}


/* Countdown */
function pt_countdown()
{
	jQuery('.pt-countdown[data-countdown]').each(function() {
		var $this = jQuery(this), finalDate = jQuery(this).data('countdown');
		$this.countdown(finalDate, function(event) {
			$this.html(event.strftime(''
				+ ' <div>%w<span> ' + pt_settings.text_weeks 	+ '</span></div>'
				+ ' <div>%d<span> ' + pt_settings.text_days		+ '</span></div>'
				+ ' <div>%H<span> ' + pt_settings.text_hours	+ '</span></div>'	
				+ ' <div>%M<span> ' + pt_settings.text_minutes	+ '</span></div>'
				//+ ' <div>%S<span> ' + pt_settings.text_seconds	+ '</span></div>'
			));
		});
	});
}


/* Image Gallery */
function pt_gallery()
{
	jQuery('.pt_gallery').each(function() {

		var this_element = jQuery(this);
	   
		this_element.bxSlider({
			mode: this_element.attr('data-mode'),
			auto: (this_element.attr('data-auto') == 'true' ? true : false),
			pause: this_element.attr('data-pause'),
			speed: this_element.attr('data-speed'),
			easing: this_element.attr('data-easing'),
			adaptiveHeight: (this_element.attr('data-adaptiveheight') == 'true' ? true : false),
		});
	});
}


/* Google Maps Maps*/
function pt_contact_map()
{
	if (jQuery('#contact_map').length)
	{
		startGmap();
	}
}


/* Lightwindow Share */
function pt_lightwindow_share()
{	
	jQuery('[data-action="open-lightwindow"]').click(function(){
		var lightwindow = jQuery(this).attr('data-target');
		var title_lightwindow = jQuery(this).attr('data-title');
		var id_lightwindow = jQuery(this).attr('data-id');

		jQuery('body, html').addClass('no-scroll');
		jQuery('.lightwindow-share h2').text(title_lightwindow);

		jQuery(lightwindow).attr('id', id_lightwindow);

		jQuery(lightwindow).fadeIn('slow', function() {
			if ( Modernizr.mq('only screen and (min-width: 768px)') || !Modernizr.csstransitions ) {
				jQuery(lightwindow).children('.lightwindow-content').center({
					against : 'parent'
				});
			}
			jQuery(lightwindow).children('.lightwindow-content').css({'opacity' : 1});
		});

		return false;
	});

	/* Lightwindow close*/
	jQuery('[data-action="close-lightwindow"]').click(function(){
		var lightwindow = jQuery(this).parents('.lightwindow-share');

		lightwindow.fadeOut('fast', function() {
			lightwindow.children('.lightwindow-content').css({'opacity' : 0});
			jQuery('body, html').removeClass('no-scroll');
			lightwindow.removeAttr('id');
		});

		return false;
	});
}


/* Newsletter */
function pt_newsletter_form()
{
	jQuery('.pt-newsletter-form').submit(function() {

		var _this = jQuery(this);
		var form_data = jQuery(this).serialize();
		var email = jQuery(this).find('input[name="newsletter_email"]').prop('value');

		form_data += '&action=pt-ajax-newsletter-form';

		if (validateEmail(email)) {

			jQuery.post(pt_settings.ajaxurl, form_data, function(data) {
				
				_this.addClass('pt_NewsletterAnime');

				_this.find('.error, .success').addClass('hide').removeClass('show');
				_this.find('.success').addClass('show').removeClass('hide');

			});
		} 
		else
		{

			_this.on('click touchstart', function(e) {
				_this.removeClass('pt_NewsletterAnime');
			});

			_this.addClass('pt_NewsletterAnime pt_newsletterErro');
			_this.find('.error, .success').addClass('hide').removeClass('show');
			_this.find('.error').addClass('show').removeClass('hide');
		}

		return false;
	});
}




/* Contact Form */
function pt_contact_form()
{
	jQuery(document).on('submit', '.pt-contact-form', function() {

		var _this = jQuery(this);
		var form_data = _this.serialize();

		var name 			= _this.find('input.pt_contact_name').attr('value');
		var email 			= _this.find('input.pt_contact_email').attr('value');
		var message 		= _this.find('textarea.pt_contact_message').attr('value');
		var subject 		= _this.find('input.pt_contact_subject').attr('value');

		var msgs_divs 		= _this.find('.msg');
		var message_ok 		= _this.find('.msg-success');
		var message_error 	= _this.find('.msg-error');
		var button 			= _this.find('.btn');

		form_data += '&action=pt-ajax-contact-form';


		var goodToGo = false;
		if(is_safari) {
			
			//Verefica se existe algum campo vazio e dispara o alerta
			if( _this.find('input.pt_contact_name').is(':required') && name == ""  ) 		{ _this.find('input.pt_contact_name').addClass('erro'); 		} else { _this.find('input.pt_contact_name').removeClass('erro'); }
			if( _this.find('input.pt_contact_subject').is(':required') && subject == ""  ) 	{ _this.find('input.pt_contact_subject').addClass('erro'); 		} else { _this.find('input.pt_contact_subject').removeClass('erro'); }

			if( email == ""  ) 				{ _this.find('input.pt_contact_email').addClass('erro'); 		} else { _this.find('input.pt_contact_email').removeClass('erro'); }
			if( !validateEmail(email) ) 	{ _this.find('input.pt_contact_email').addClass('erro'); 		} else { _this.find('input.pt_contact_email').removeClass('erro'); }
			if( message == "" ) 			{ _this.find('textarea.pt_contact_message').addClass('erro'); 	} else { _this.find('textarea.pt_contact_message').removeClass('erro'); }
			
			// Caso não existe nenhum campo por preencher ele continua.

			if(!_this.find('textarea, input').hasClass('erro')) { goodToGo = true;}

		} else {
			goodToGo = true;
		}


		if (goodToGo) {

			jQuery.post(pt_settings.ajaxurl, form_data, function(data) {

				if (data=="true")
				{
					msgs_divs.addClass('hide').removeClass('show');
					message_ok.addClass('show').removeClass('hide');
					
					_this.addClass('formSent');
					_this.find('textarea, input').attr('disabled', 'disabled');
					
				} else {
					msgs_divs.addClass('hide').removeClass('show');
					message_error.addClass('show').removeClass('hide');
				}
			});
		}

		return false;
	});
}


// Blog Video
function responsiveVideoIframesInit()
{
	jQuery('iframe').each(function(){
		var $src = jQuery(this).attr('src');

		if ($src) {

			if ( $src.toLowerCase().indexOf("youtube") >= 0 || $src.toLowerCase().indexOf("vimeo") >= 0  || $src.toLowerCase().indexOf("twitch.tv") >= 0 || $src.toLowerCase().indexOf("kickstarter") >= 0 || $src.toLowerCase().indexOf("dailymotion") >= 0) {
				jQuery(this).wrap('<div class="iframe-embed"/>');	
				jQuery(this).attr('data-aspectRatio', this.height / this.width).removeAttr('height').removeAttr('width');

				//add wmode=transparent to all youytube embeds to fix z-index issues in IE
				if($src.indexOf('wmode=transparent') == -1) {
					if($src.indexOf('?') == -1){
						jQuery(this).attr('src', $src + '?wmode=transparent');
					} else {
						jQuery(this).attr('src', $src + '&wmode=transparent');
					}
				}
			}
		}
	});
}

function responsiveVideoIframes()
{
	 jQuery('iframe[data-aspectRatio]').each(function() {
	 	var newWidth = jQuery(this).parent().width();
	 	 
		var $el = jQuery(this);
		
		$el.width(newWidth).height(newWidth * $el.attr('data-aspectRatio'));
	});
}


// opacity Animated loop
function loop() { jQuery('.opacity_animated_loop img').animate({opacity:0, paddingTop:"0px" },800).animate({opacity:1, paddingTop:"20px" },800,loop); }

/* Twitter Callback */
function tweet_callback(){ "use strict"; jQuery('.tweet_list').cycle({ fx: 'custom', cssBefore: { top:50, height: 100, opacity: 0, display: 'block' }, animIn: { top: 0, opacity: 1 }, animOut: { opacity: 0, top: -50 }, cssAfter: { zIndex: 0, display: 'none' }, speed: 1750, sync: false, easeIn: 'easeOutBack', easeOut: 'easeInBack' }); }

/* validate email */ 
function validateEmail(a){ var b=/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/; return b.test(a); }

/* Google Maps */
function startGmap(){if(typeof google=="undefined"){return false}else{var q={zoom:parseInt(pt_settings.google_maps_zoom),center:new google.maps.LatLng(pt_settings.google_maps_point_1.latitude,pt_settings.google_maps_point_1.longitude),mapTypeControl:true,mapTypeControlOptions:{style:google.maps.MapTypeControlStyle.DROPDOWN_MENU,mapTypeIds:["ptMap",google.maps.MapTypeId.SATELLITE,google.maps.MapTypeId.HYBRID,google.maps.MapTypeId.TERRAIN]},scrollwheel:false,zoomControl:true,zoomControlOptions:{style:google.maps.ZoomControlStyle.SMALL}};map=new google.maps.Map(document.getElementById("contact_map"),q);var i=pt_settings.google_maps_marker;var m=[{featureType:"landscape",stylers:[{visibility:"on"},{color:pt_settings.google_maps_landscape_color}]},{featureType:"administrative",stylers:[{visibility:"on"}]},{featureType:"poi",stylers:[{visibility:"off"}]},{featureType:"road",elementType:"geometry",stylers:[{color:pt_settings.google_maps_roads_color},{visibility:"on"}]},{featureType:"transit",stylers:[{visibility:"off"}]},{featureType:"water",stylers:[{gamma:1},{color:pt_settings.google_maps_water_color}]},{},{featureType:"road",elementType:"geometry.fill",stylers:[{visibility:"on"}]},{featureType:"road",elementType:"geometry.stroke",stylers:[{visibility:"on"}]},{featureType:"transit.line",elementType:"labels",stylers:[{visibility:"on"}]},{}];var o={name:"Map"};var h,s,l,j,r;var n=new google.maps.StyledMapType(m,o);map.mapTypes.set("ptMap",n);map.setMapTypeId("ptMap");if(pt_settings.google_maps_point_1.latitude&&pt_settings.google_maps_point_1.longitude){h=parseFloat(pt_settings.google_maps_point_1.latitude);s=parseFloat(pt_settings.google_maps_point_1.longitude);;j=new google.maps.LatLng(h,s);r=new google.maps.Marker({position:j,map:map,zIndex:99999,optimized:false,icon:i})}if(pt_settings.google_maps_point_2.latitude&&pt_settings.google_maps_point_2.longitude){h=parseFloat(pt_settings.google_maps_point_2.latitude);s=parseFloat(pt_settings.google_maps_point_2.longitude);;j=new google.maps.LatLng(h,s);r=new google.maps.Marker({position:j,map:map,zIndex:99999,optimized:false,icon:i})}if(pt_settings.google_maps_point_3.latitude&&pt_settings.google_maps_point_3.longitude){h=parseFloat(pt_settings.google_maps_point_3.latitude);s=parseFloat(pt_settings.google_maps_point_3.longitude);;j=new google.maps.LatLng(h,s);r=new google.maps.Marker({position:j,map:map,zIndex:99999,optimized:false,icon:i})}if(pt_settings.google_maps_point_4.latitude&&pt_settings.google_maps_point_4.longitude){h=parseFloat(pt_settings.google_maps_point_4.latitude);s=parseFloat(pt_settings.google_maps_point_4.longitude);;j=new google.maps.LatLng(h,s);r=new google.maps.Marker({position:j,map:map,zIndex:99999,optimized:false,icon:i})}}};

/* Get Real Menu WIdth*/
function realWidth(obj){ var clone = obj.clone(); clone.find('ul li').css("display","block"); jQuery('body').append(clone); var width = clone.outerWidth(); clone.remove(); return width; }