(function($){

	"use strict";

	var VideoStories = {

      // Bootstrap Carousels

      carousel: function() {

      	$('.carousel.slide').carousel({
      		cycle: true
      	}); 
      }, 

      matchHeight: function() {
      	$('article.post.type-post, .widget_instagram_feed img').matchHeight({ 
      		property: 'min-height' 
      	});

      },

      magnific: function() {
      	$('.iframe').magnificPopup({
      		type: 'iframe',
      		// gallery: {
      		// 	enabled: true
      		// },
      	});

      	$('.image-popup').magnificPopup({
      		type: 'image',
      		gallery: {
      			enabled: true
      		},
      	});

      },

		// Owl Carousels 

		owlcarousel: function() {
			try { 
				(function($) {

					$(".video-slider").owlCarousel({
						items:3,
						loop:true,
						margin:30,
						nav: false,
						autoplay: true,
						responsive:{
							320:{
								items:1,
								margin: 0,
							},
							480:{
								items:2,
								margin: 0,
							},
							640:{
								items:2,
								margin: 15,
							},
							768:{
								items:3,
								margin: 15,
							}
						}
					});

					$(".trending-slider, .category-slider-01, .related-videos-slider").owlCarousel({
						items:3,
						loop:true,
						margin:25,
						nav: false,
						autoplay: true,
						responsive:{
							320:{
								items:1,
								margin: 0,
							},
							480:{
								items:1,
								margin: 0,
							},
							640:{
								items:2,
								margin: 0,
							},
							768:{
								items:3,
								margin: 15,
							}
						}
					});

					$(".music-video-slider").owlCarousel({
						items:2,
						loop:true,
						margin:25,
						nav: false,
						autoplay: true,
						responsive:{
							320:{
								items:1,
								margin: 0,
							},
							480:{
								items:1,
								margin: 0,
							},
							640:{
								items:2,
								margin: 15,
							}
						}
					});

					$(".weekly-top, .play-list-3 .list-slider").owlCarousel({
						items:1,
						loop:true,
						margin:0,
						nav: false,
						autoplay: true
					});

					$(".tweet-slider").owlCarousel({
						items:1,
						loop:true,
						margin:0,
						nav: false,
						autoplay: true,
						startPosition: 0,
						animateOut: 'slideOutUp',
						animateIn: 'slideInUp'
					});

					$(".title-slider").owlCarousel({
						items:2,
						loop:true,
						margin:0,
						nav: false,
						autoplay: true,
						responsive:{
							320:{
								items:1,
								margin: 0,
							},
							640:{
								items:1,
								margin: 0,
							},
							768:{
								items:2,
								margin: 15,
							}
						}
					});

					$(".list-slider").owlCarousel({
						items:4,
						loop:true,
						margin:30,
						nav: false,
						autoplay: true,
						responsive:{
							320:{
								items:1,
								margin: 0,
							},
							480:{
								items:2,
								margin: 15,
							},
							636:{
								items:2,
								margin: 15,
							},
							768:{
								items:3,
								margin: 15,
							},
							1024:{
								items:4,
								margin: 20,
							}
						}
					});

					$(".latest-videos-slider, .viral-videos-slider").owlCarousel({
						items:2,
						loop:true,
						margin:30,
						nav: false,
						responsive:{
							320:{
								items:1,
								margin: 0,
							},
							480:{
								items:2,
								margin: 15,
							},
							640:{
								items:2,
								margin: 15,
							},
							768:{
								items:2,
								margin: 30,
							}
						}
					});

					$(".latest-videos-slider-2, .viral-videos-slider-2, .exclusive-videos-slider, .upload-videos-slider").owlCarousel({
						items:3,
						loop:true,
						margin:25,
						nav: false,
						responsive:{
							320:{
								items:1,
								margin: 0,
							},
							480:{
								items:2,
								margin: 15,
							},
							636:{
								items:2,
								margin: 15,
							},
							768:{
								items:3,
								margin: 20,
							}
						}
					});

					$(".most-liked").owlCarousel({
						items:3,
						loop:true,
						margin:25,
						nav: false,
						responsive:{
							320:{
								items:1,
								margin: 0,
							},
							480:{
								items:2,
								margin: 15,
							},
							768:{
								items:2,
								margin: 20,
							},
							1024:{
								items:3,
								margin: 20,
							}
						}
					});

					$('.banner-slider-01').owlCarousel({
						center: true,
						items:2,
						autoplay: true,
						loop:true,
						margin:90,
						responsive:{
							320:{
								items:1,
								margin: 0,
							},
							480:{
								items:1,
								margin: 0,
							},
							636:{
								items:1,
								margin: 0,
							},
							768:{
								items:2,
								margin: 15,
							},
							1024:{
								items:2,
								margin: 30,
							},
							1200:{
								items:2,
								margin: 90,
							}
						}
					});

					$('.bottom-slider').owlCarousel({
						items:3,
						autoplay: true,
						loop:true,
						margin:40,
						responsive:{
							767:{
								items:1,
								margin: 0,
							},
							768:{
								items:2,
								margin: 20,
							},
							1024:{
								items:3,
								margin: 30,
							},
							1200:{
								items:3,
								margin: 40,
							}
						}
					});

					$('.banner-slider-02 .banner-slider').owlCarousel({
						items:1,
						autoplay: true,
						loop:true
					});

					$('.most-viewed').owlCarousel({
						items:2,
						autoplay: true,
						loop:true,
						margin:30,
						responsive:{
							320:{
								items:1,
								margin: 0,
							},
							480:{
								items:2,
								margin: 10,
							},
							640:{
								items:2,
								margin: 15,
							},
							768:{
								items:2,
								margin: 20,
							},
							1024:{
								items:2,
								margin: 30,
							}
						}
					});

					$('.recent-movie-slider').owlCarousel({
						items:5,
						autoplay: true,
						loop:true,
						margin:10,
						responsive:{
							320:{
								items:2
							},
							480:{
								items:2
							},
							640:{
								items:3
							},
							768:{
								items:4
							},
							1024:{
								items:5
							}
						}
					});

				})(jQuery);
			} catch(e) { 
				
			} 
		},

		// Facebook Profile Badge Script

		facebook_feed: function() {
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));

		},


	};


	$(document).ready(function() {
		"use strict";

		// Background Img

		$(".background-bg").css('background-image', function () {
			var bg = ('url(' + $(this).data("image-src") + ')');
			return bg;
		});


		$('.section-title, aside .widget-title').each(function() {
			var word = $(this).html();
			var index = word.indexOf(' ');
			if(index == -1) {
				index = word.length;
			}
			$(this).html('<span class="first-word">' + word.substring(0, index) + '</span>' + word.substring(index, word.length));
		});

		$('.style-grid').on("click", function() {
			$(".style-grid").addClass("active");
			$(".style-list").removeClass("active");
			$(".play-list-4").addClass("grid-layout");
			$(".play-list-4 article").addClass("col-sm-6");
			$(".author-videos article").addClass("col-sm-4");
			$(".author-videos").removeClass("list-style");
		});

		$('.style-list').on("click", function() {
			$(".style-list").addClass("active");
			$(".style-grid").removeClass("active");
			$(".play-list-4").removeClass("grid-layout");
			$(".play-list-4 article").removeClass("col-sm-6");
			$(".author-videos article").removeClass("col-sm-4");
			$(".author-videos").addClass("list-style");
		});




		VideoStories.carousel();
		VideoStories.matchHeight();
		VideoStories.magnific();
		VideoStories.owlcarousel();
		VideoStories.facebook_feed();
	});

	if ($(window).width() < 767) {
		"use strict";


		$('.bottom-slider').owlCarousel({
			items:1,
			autoplay: true,
			loop:true,
			margin:0
		});


	};

	// Responsive Menu Open and Close in Mobile

	if ($(window).width() < 767) {
		"use strict";
		$('.menu-item-has-children>a').on('click', function(event) {
			event.preventDefault(); 
			event.stopPropagation(); 
			$(this).parent().siblings().removeClass('open');
			$(this).parent().toggleClass('open');
		});
		
	};



	jQuery(window).on('scroll', function () {
		
		'use strict';

		if (jQuery(this).scrollTop() > 100) {
			jQuery('#scroll-to-top').fadeIn('slow');
		} else {
			jQuery('#scroll-to-top').fadeOut('slow');
		}

	});


	jQuery('#scroll-to-top').on("click", function() {
		
		'use strict';

		jQuery("html,body").animate({ scrollTop: 0 }, 1500);
		return false;
	});



})(jQuery);





/* Working Contact Form Js
-------------------------------------------------------------------*/
    // Email from Validation
    jQuery('#submit').on("click", function(e){ 

    //Stop form submission & check the validation
    e.preventDefault();


    // Variable declaration
    var error = false;
    var k_name = jQuery('#name').val();
    var k_email = jQuery('#email').val(); 
    var k_email = jQuery('#subject').val(); 
    var k_message = jQuery('#message').val();


    /* Post Ajax function of jQuery to get all the data from the submission of the form as soon as the form sends the values to email.php*/
    jQuery.post("email.php", jQuery(".wpcf7-form").serialize(),function(result){
        //Check the result set from email.php file.
        if(result == 'sent'){

          //If the email is sent successfully, remove the submit button
          //$('#name').remove();
          //$('#email').remove();
          //$('#subject').remove();
          //$('#message').remove();
          //$('#submit').remove(); 

          $('.contact-message').html('<i class="fa fa-check contact-success"></i><div>Your message has been sent.</div>').fadeIn();
      } else {
      	// $('.error-message').html('<i class="fa fa-thumbs-down contact-error"></i><div>Your message has not been sent</div>').fadeIn();

      }
  });

}); 





