/*=========================================================================================
		File Name: form-repeater.js
		Description: Repeat forms or form fields
		----------------------------------------------------------------------------------------
		Item Name: Robust - Responsive Admin Theme
		Version: 3.0
		Author: PIXINVENT
		Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

(function(window, document, $) {
	'use strict';

	// Custom Show / Hide Configurations
	$('.contact-repeater').repeater({
        show: function () {
			$(this).slideDown();
		},
		hide: function(remove) {
		  if (confirm('Voulez vous retirer ce produit ?')) {
                $(this).slideUp(remove);
			}
		}
	});


})(window, document, jQuery);
