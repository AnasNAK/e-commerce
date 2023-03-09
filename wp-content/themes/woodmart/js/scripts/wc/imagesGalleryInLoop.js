/* global woodmart_settings */
(function($) {
	$.each([
		'frontend/element_ready/wd_products.default',
		'frontend/element_ready/wd_products_tabs.default',
		'frontend/element_ready/wd_archive_products.default',
	], function(index, value) {
		woodmartThemeModule.wdElementorAddAction(value, function() {
			woodmartThemeModule.imagesGalleryInLoop();
		});
	});

	woodmartThemeModule.imagesGalleryInLoop = function() {
		$('.product-grid-item')
			.on('mouseover mouseout', '.wd-product-grid-slide', function( e ) {
				let $hoverSlide          = $(this);
				let $product             = $hoverSlide.closest('.product-grid-item');
				let $productsHolder      = $product.closest('.products');
				let productsGalleryAtts  = $productsHolder.length > 0 && $productsHolder.data('grid-gallery') ? $productsHolder.data('grid-gallery') : {};
				let grid_gallery_control = woodmart_settings.grid_gallery_control;

				if ( productsGalleryAtts.hasOwnProperty( 'grid_gallery_control' ) && ( null === productsGalleryAtts.grid_gallery_control || ( 'string' === typeof productsGalleryAtts.grid_gallery_control && productsGalleryAtts.grid_gallery_control.length > 0 ) ) ) {
					grid_gallery_control = productsGalleryAtts.grid_gallery_control;
				}

				if ( 'hover' !== grid_gallery_control || woodmartThemeModule.$window.width() <= 1024 || $product.hasClass('wd-loading') ) {
					return;
				}

				let $imagesIndicator    = $product.find('.wd-product-grid-slider-pagin');
				let $productImage       = $product.find('img');
				let $productImageSource = $product.find('picture source');
				let hoverImageUrl;
				let hoverImageSrcSet;
				let currentImagesIndicator;

				if ( 'mouseover' === e.type ) {
					let hoverSliderId      = $hoverSlide.data('image-id');
					hoverImageUrl          = $hoverSlide.data('image-url');
					hoverImageSrcSet       = $hoverSlide.data('image-srcset');
					currentImagesIndicator = $imagesIndicator.find(`[data-image-id="${hoverSliderId}"]`);
				} else {
					hoverImageUrl          = $product.find('.wd-product-grid-slide[data-image-id="0"]').data('image-url');
					hoverImageSrcSet       = $product.find('.wd-product-grid-slide[data-image-id="0"]').data('image-srcset');
					currentImagesIndicator = $imagesIndicator.find('[data-image-id="0"]');
				}

				$product.addClass('wd-loading');
				currentImagesIndicator.siblings().removeClass('wd-active');
				currentImagesIndicator.addClass('wd-active');

				$productImage.attr('src', hoverImageUrl );

				if ( hoverImageSrcSet ) {
					$productImage.attr('srcset', hoverImageSrcSet );
					$productImageSource.attr('srcset', hoverImageSrcSet );
				}

				$product.removeClass('wd-loading');
			})
			.on('click', '.wd-prev, .wd-next', function( e ) {
				e.preventDefault();
				let $navButton                 = $(this);
				let $productsHolder            = $navButton.closest('.products');
				let productsGalleryAtts        = $productsHolder.length > 0 && $productsHolder.data('grid-gallery') ? $productsHolder.data('grid-gallery') : {};
				let grid_gallery_control       = woodmart_settings.grid_gallery_control;
				let grid_gallery_enable_arrows = woodmart_settings.grid_gallery_enable_arrows;

				if ( productsGalleryAtts.hasOwnProperty( 'grid_gallery_control' ) && ( null === productsGalleryAtts.grid_gallery_control || ( 'string' === typeof productsGalleryAtts.grid_gallery_control && productsGalleryAtts.grid_gallery_control.length > 0 ) ) ) {
					grid_gallery_control = productsGalleryAtts.grid_gallery_control;
				}

				if ( productsGalleryAtts.hasOwnProperty( 'grid_gallery_enable_arrows' ) && ( null === productsGalleryAtts.grid_gallery_enable_arrows || ( 'string' === typeof productsGalleryAtts.grid_gallery_enable_arrows && productsGalleryAtts.grid_gallery_enable_arrows.length > 0 ) ) ) {
					grid_gallery_enable_arrows = productsGalleryAtts.grid_gallery_enable_arrows;
				}

				if ( ( woodmartThemeModule.$window.width() < 1024 && ( ! grid_gallery_enable_arrows || 'none' === grid_gallery_enable_arrows ) ) || ( woodmartThemeModule.$window.width() > 1024 && ( ! grid_gallery_control || 'arrows' !== grid_gallery_control ) ) ) {
					return;
				}

				let $product            = $navButton.closest('.product-grid-item');
				let $productImage       = $product.find('img');
				let $productImageSource = $product.find('picture source');
				let $imagesList         = $product.find('.wd-product-grid-slide');
				let index               = $imagesList.hasClass('wd-active') ? $product.find('.wd-product-grid-slide.wd-active').data('image-id') : 0;

				if ( $(this).hasClass('wd-prev') ) {
					index--;
				} else if ( $(this).hasClass('wd-next') ) {
					index++;
				}

				if ( -1 === index ) {
					index = $imagesList.length - 1;
				} else if ( $imagesList.length === index ) {
					index = 0;
				}

				let $currentImage    = $product.find(`.wd-product-grid-slide[data-image-id="${index}"]`);
				let hoverImageUrl    = $currentImage.data('image-url');
				let hoverImageSrcSet = $currentImage.data('image-srcset');

				$imagesList.removeClass('wd-active');
				$currentImage.addClass('wd-active');

				$productImage.attr('src', hoverImageUrl )

				if ( hoverImageSrcSet ) {
					$productImage.attr('srcset', hoverImageSrcSet );
					$productImageSource.attr('srcset', hoverImageSrcSet );
				}
			})
			.on('wdImagesGalleryInLoopOff', function( e, neededProduct = this ) {
				$( neededProduct )
					.off( 'mouseover mouseout', '.wd-product-grid-slide' )
					.off( 'click', '.wd-prev, .wd-next' );
			});
	};

	woodmartThemeModule.$document.on('pjax:complete, wdProductsTabsLoaded, wdShopPageInit, wood-images-loaded', function() {
		woodmartThemeModule.imagesGalleryInLoop();
	});

	woodmartThemeModule.$body.on('click', '.wd-swatches-grid .wd-swatch', function() {
		if ( ! $(this).hasClass('wd-active') ) {
			return;
		}

		woodmartThemeModule.imagesGalleryInLoop();
	});

	$(document).ready(function() {
		woodmartThemeModule.imagesGalleryInLoop();
	});
})(jQuery);
