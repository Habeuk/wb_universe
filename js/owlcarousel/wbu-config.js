jQuery(document).ready(function ($) {
	//var responsive = $('.js-carousel').data('responsive');
	$('.owl-carousel').each(function (i, v) {
		var self = this;
		var params = $(self).data('owlresponsive');
		// console.log('OWL responsive : ', params);
		// example : data-owlresponsive='{"items":1,"nav":false,"dots":true,"loop":true,"autoplay":true}'
		var textNav='<svg class="owl-svg-nav" viewBox="0 0 12 12"><path fill-rule="evenodd" d="M10.423 8.764a.811.811 0 01-1.145 0l-3.153-3.14-3.153 3.14a.811.811 0 11-1.145-1.15l4.298-4.28 4.298 4.28a.811.811 0 010 1.15z" clip-rule="evenodd"></path></svg>';
		if (params) {
			params['navText'] = [
				textNav,
				textNav
			];
			/***
			 * after the plugin has initialized.
			 */
			$(self).on('initialized.owl.carousel', function (event) {
				console.log('initialized.owl.carousel');
				
				setTimeout(function () {
					$('.owl-dots', self).addClass('show');
					$('.owl-dots > div', self).each(function (k, value) {
						var src = $(this).html();
						src = src.replace(/(\r\n|\n|\r)/gm, "");
						$(this).html('<img src="' + src + '" class=""img-fluid>')
					});
					$('.owl-dots > div', self).click(function () {
						var owl_index = $('.owl-dots > div', self).index(this);
						$(self).trigger('to.owl.carousel', owl_index);
					});

				}, 200);
				
			});
			$(self).owlCarousel(params);
		}
	});

});
