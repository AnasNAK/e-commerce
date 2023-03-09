(function($) {
	const woodmartWishlist = function() {
		function selectControl() {
			if ( typeof ($.fn.select2) === 'undefined' ) {
				return;
			}

			var $select = $('.wc-product-search');

			if ($select.length > 0) {
				$select.each(function() {
					var $field = $(this);

					if ($field.hasClass('xts-field-inited')) {
						return;
					}

					$field.select2({
						theme: 'xts',
						placeholder: 'Select a product',
						allowClear: true,
						ajax: {
							url: ajaxurl,
							data: function (params) {
								return {
									term : params.term,
									action : 'woocommerce_json_search_products_and_variations',
									security: $(this).attr('data-security'),
								};
							},
							processResults: function( data ) {
								var terms = [];
								if ( data ) {
									$.each( data, function( id, text ) {
										terms.push( { id: id, text: text } );
									});
								}
								return {
									results: terms
								};
							},
							cache: true
						},
						minimumInputLength: 3,
					});

					$field.addClass('xts-field-inited');
				});
			}
		}

		function userSelectControl() {
			if ( typeof ($.fn.select2) === 'undefined' ) {
				return;
			}

			var $select = $('.xts-users-search');

			if ($select.length > 0) {
				$select.each(function() {
					var $field = $(this);

					if ($field.hasClass('xts-field-inited')) {
						return;
					}

					$field.select2({
						theme: 'xts',
						placeholder: 'Select a user',
						allowClear: true,
						ajax: {
							url: ajaxurl,
							data: function (params) {
								return {
									term : params.term,
									action : 'woodmart_json_search_users',
									security : $(this).attr('data-security'),
								};
							},
							processResults: function(data) {
								var terms = [];

								if (data) {
									$.each( data, function( id, text ) {
										terms.push( { id: id, text: text } );
									});
								}

								return {
									results: terms
								};
							},
							cache: true
						},
						minimumInputLength: 3,
					});

					$field.addClass('xts-field-inited');
				});
			}
		}

		function dateControl() {
			if ( typeof ($.fn.datepicker) === 'undefined' ) {
				return;
			}

			var $dateInput = $('.date-picker');

			if ($dateInput.length > 0) {
				$dateInput.each(function(  ) {
					$(this).datepicker();
				});
			}
		}

		return {
			init: function() {
				selectControl();
				userSelectControl();
				dateControl();
			}
		}
	}

	$(document).ready(function() {
		woodmartWishlist().init();
	});
})(jQuery);
