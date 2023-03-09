/* global woodmart_settings */
(function($) {
	woodmartThemeModule.$document.on('wdShopPageInit wdArrowsLoadProducts wdLoadMoreLoadProducts wdProductsTabsLoaded wdSearchFullScreenContentLoaded wdRecentlyViewedProductLoaded', function () {
		woodmartThemeModule.swatchesLimit();
	});

	woodmartThemeModule.swatchesLimit = function() {
		$('.wd-swatch-divider').on('click', function() {
			var $this = $(this).parent();

			$this.find('.wd-swatch').removeClass('wd-hidden');
			$this.addClass('wd-all-shown');

			woodmartThemeModule.$document.trigger('wood-images-loaded');
		});
	};

	$(document).ready(function() {
		woodmartThemeModule.swatchesLimit();
	});
})(jQuery);
