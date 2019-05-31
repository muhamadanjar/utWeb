/*
Copyright (c) 2016 Micky
------------------------------------------------------------------
[Master Javascript]
Project: Micky
-------------------------------------------------------------------*/
(function($) {
	"use strict";
	var Micky = {
		initialised: false,
		version: 1.0,
		mobile: false,
		init: function() {
			if (!this.initialised) {
				this.initialised = true;
			} else {
				return;
			}
			/*-------------- Micky Functions Calling ---------------------------------------------------
			------------------------------------------------------------------------------------------------*/
			this.RTL();
			this.Slider();
			this.menu_active();
			this.Responsive_menu();
			this.testimonial();
			this.app_crousel();
			this.selectpicker();
			this.map_toggle();
			this.videopopup();
			this.Mail_function();
			this.wow_js();
		},
		/*-------------- Micky Functions definition ---------------------------------------------------
		---------------------------------------------------------------------------------------------------*/
		RTL: function() {
			// On Right-to-left(RTL) add class 
			var rtl_attr = $("html").attr('dir');
			if (rtl_attr) {
				$('html').find('body').addClass("rtl");
			}
		},
		//Slider
		Slider:function(){
		//slider script
		  var tpj = jQuery;
		  var revapi4;
		  tpj(document).ready(function() {
			if (tpj("#rev_slider_4_1").revolution == undefined) {
			  revslider_showDoubleJqueryError("#rev_slider_4_1");
			} else {
			  revapi4 = tpj("#rev_slider_4_1").show().revolution({
				sliderType: "standard",
				jsFileLocation: "../../revolution/js/",
				sliderLayout: "fullscreen",
				dottedOverlay: "none",
				delay: 8000,
				navigation: {
				  keyboardNavigation: "off",
				  keyboard_direction: "horizontal",
				  mouseScrollNavigation: "on",
				  onHoverStop: "off",
				  touch: {
					touchenabled: "on",
					swipe_threshold: 75,
					swipe_min_touches: 1,
					swipe_direction: "horizontal",
					drag_block_vertical: false
				  },
				  arrows: {
					style: "zeus",
					enable: false,
					hide_onmobile: true,
					hide_under: 1300,
					hide_onleave: true,
					hide_delay: 200,
					hide_delay_mobile: 1200,
					tmp: '<div class="tp-title-wrap">  	<div class="tp-arr-imgholder"></div> </div>',
					left: {
					  h_align: "left",
					  v_align: "center",
					  h_offset: 30,
					  v_offset: 0
					},
					right: {
					  h_align: "right",
					  v_align: "center",
					  h_offset: 30,
					  v_offset: 0
					}
				  },
				  bullets: {
					enable: false,
					hide_onmobile: true,
					hide_under: 600,
					style: "metis",
					hide_onleave: true,
					hide_delay: 200,
					hide_delay_mobile: 1200,
					direction: "horizontal",
					h_align: "center",
					v_align: "bottom",
					h_offset: 0,
					v_offset: 30,
					space: 5,
					tmp: '<span class="tp-bullet-img-wrap">  <span class="tp-bullet-image"></span></span><span class="tp-bullet-title">{{title}}</span>'
				  }
				},
				viewPort: {
				  enable: true,
				  outof: "pause",
				  visible_area: "80%"
				},
				gridwidth: [1240, 1024, 778, 480],
				gridheight: 780,
				lazyType: "none",
				parallax: {
				  type: "mouse",
				  origo: "slidercenter",
				  speed: 2000,
				  levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 50],
				},
				shadow: 0,
				spinner: "off",
				stopLoop: "off",
				stopAfterLoops: -1,
				stopAtSlide: -1,
				shuffle: "off",
				autoHeight: "off",
				hideThumbsOnMobile: "off",
				hideSliderAtLimit: 0,
				hideCaptionAtLimit: 0,
				hideAllCaptionAtLilmit: 0,
				debugMode: false,
				fallbacks: {
				  simplifyAll: "off",
				  nextSlideOnWindowFocus: "off",
				  disableFocusListener: false,
				}
			  });
			}
		  });
		},
		//menu active on click
		menu_active:function(){
			$('.menu a').on('click', function() {
				$('.menu').find(".active_menu").removeClass('active_menu');
				$(this).parent().addClass('active_menu');
			});
		},
		//Responsive menu
		Responsive_menu:function(){
			//navigation toogle
			$(".navbar_toogle").on("click", function() {
				$(".mk_top_navigations").slideToggle(500);
			});
			
			//navigation right
			var navright = $(".navigaton_right");
			var menuclose = $(".navigaton_right, .side_navigation_second");
			var close = $(".close_button");
			$(".navbar_toogle_right").on("click", function() {
				navright.slideToggle(400);
				$(".header_orange").css("background-color", "#f9ce89");
			});
			close.on("click", function() {
				menuclose.slideToggle(400);
				$(".header_orange").css("background-color", "#f39c12");
			});

			//add class in navigation menu
			$("ul.sub-menu").parents("li").addClass("dropdown_menu");
			$(".dropdown_menu").prepend("<i></i>");
			$(".dropdown_menu>i").addClass("caret_down");
			//responsive  menu toogle
			$('.menu').find('>li.dropdown_menu').on('click', function() {
				if ($(window).width() < 991) {
					$('.mk_top_navigations ul li > ul.sub-menu').not($(this).children(".mk_top_navigations ul li ul.sub-menu")
					.slideToggle()).hide();
				}
				else {}
			});
			//responsive  menu toogle right navigation
			$('.navigaton_right .menu').find('>li.dropdown_menu').on('click', function() {
				$('li > ul.sub-menu').not($(this).children("ul.sub-menu").slideToggle()).hide();
			});
		},
		//testimonial crousel
		testimonial:function(){
			$("#testimonial_crousel").owlCarousel({
				mode: 'fade',
				autoPlay: true,
				items: 1,
				singleItem: true,
				touchDrag: true,
				paginationSpeed: 1000,
				slideSpeed: 1000,
				smartSpeed: 250,
				pagination: false,
				dots: false
			});
		},
		//app_crousel
		app_crousel:function(){
			$(".app_crousel").owlCarousel({
				mode: 'fade',
				autoPlay: true,
				margin: 20,
				items: 4,
				touchDrag: true,
				responsiveClass: true,
				responsive: {
					0: {
						items: 1
					},
					480: {
						items: 2
					},
					600: {
						items: 2
					},
					1000: {
						items: 4
					}
				},
				paginationSpeed: 1000,
				slideSpeed: 1000,
				smartSpeed: 250
			});
		},
		//selectpicker
		selectpicker:function(){
			$('.selectpicker').selectpicker({
				style: 'btn-info',
				size: 4
			});
		},
		//toggle on map
		map_toggle:function(){
			$(".heading_toggle").on("click", function() {
				if ($(window).width() < 767) {
				  $(".bottom_details").slideToggle();
				}
				else {}
			});
		},
		//video popup
		videopopup:function(){
			$('.video_popup').magnificPopup({
				disableOn: 700,
				type: 'iframe',
				mainClass: 'mfp-fade',
				removalDelay: 160,
				preloader: false,
				fixedContentPos: false
			});
		},
		//mail function
		Mail_function:function(){
			// mail function
			$('#form_submit').on("click",function(){
				var un=$('#uname').val();
				var em=$('#uemail').val();
				var uphone=$('#uphone').val();
				var meesg=$('#message').val();
				$.ajax({
					type: "POST",
					url: "ajaxmail.php",
					data: {
						'username':un,
						'useremail':em,
						'userphone':uphone,
						'mesg':meesg
						},
					success: function(msg) {
				var full_msg=msg.split("#");
						if(full_msg[0]=='1')
						{
							$('#uname').val("");
							$('#uemail').val("");
							$('#uphone').val("");
							$('#message').val("");
							$('#err').html( full_msg[1] );
						}
						else
						{
							$('#uname').val(un);
							$('#uemail').val(em);
							$('#uphone').val(uphone);
							$('#message').val(meesg);
							$('#err').html( full_msg[1] );
						}
					}
				});
			});
		},
		//scrolling js
		wow_js:function(){
			new WOW().init();
		},
   };
	Micky.init();
	 //fixed menu on scrolling
	$(window).on('bind scroll', function(e) {
		if ($(window).scrollTop() > 100) {
			$('.header_top_main').addClass('fixed_menu');
		} 
		else {
			$('.header_top_main').removeClass('fixed_menu');
		}
	});
})(jQuery);