/**
 *
 */
(function($, Drupal) {
	/**
	 * slideUP/Down block search
	 */
	function slideUP_Down(context) {

		$('.form-view-exposed-custom .js-options', context).once(
			"some-arbitrary-key").click(function() {
			if ($(".form-view-exposed-custom .form-container.bottom", context)
				.hasClass(
					'open')) {
				$(".form-view-exposed-custom .form-container.bottom", context).slideUp(
					"slow");
				$(".form-view-exposed-custom .form-container.bottom", context).removeClass(
					'open');
			} else {
				$(".form-view-exposed-custom .form-container.bottom", context).slideDown(
					"slow");
				$(".form-view-exposed-custom .form-container.bottom", context).addClass(
					'open');
			}
		});
	};

	/**
	 *
	 */
	Drupal.behaviors.someArbitraryKey = {
		attach: function(context, settings) {
			slideUP_Down(context);
		}
	};
}(jQuery, Drupal));



jQuery(document).ready(function($) {
	/**
	 * la classe 'is-active' est ajouté via un js, on utilise un similaire pour
	 * ajouter 'active' dans le li
	 */
	(function(Drupal, drupalSettings) {
		Drupal.behaviors.activeLinks = {
			attach: function attach(context) {
				var path = drupalSettings.path;
				var link = '';
				// console.log(drupalSettings.path);
				$('a.nav-link').each(function() {
					link = $(this).attr('data-drupal-link-system-path');
					href = $(this).attr('href');
					if (href) {
						href = href.slice(0, 1);
					}
					if (path.isFront) {
						if (href && href == '#') {
							// //
						} else {
							if (link == '<front>') {
								$(this).parent().addClass('active');
							}
						}
					} else {
						if (link == path.currentPath && (href == '#')) {
							$(this).parent().addClass('active');
						}
					}
				});

			}
		};
	})(Drupal, drupalSettings);



	/**
	 * enable tooltiop for all page
	 */
	(function() {
		$(function() {
			$('[data-toggle="tooltip"]').tooltip()
		});
	})();

	/**
	 * menu static
	 */
	(function() {
		var lastScrollTop = 0;
		var menu = $("#header");
		$height = 300; // $("#header").innerHeight();
		var navbarCollapse = function() {
			st = $(window).scrollTop();
			if (st > ($height + 1)) {
				menu.addClass("site-header--fluid");
			} else {
				menu.removeClass("site-header--fluid");
			}
			// direction
			if (st > lastScrollTop) {
				menu.addClass("site-scroll-top");
				menu.removeClass("site-scroll-bottom");
			} else {
				menu.removeClass("site-scroll-top");
				menu.addClass("site-scroll-bottom");
			}
			lastScrollTop = st;
		};
		navbarCollapse();
		$(window).scroll(navbarCollapse);
	})();

});
