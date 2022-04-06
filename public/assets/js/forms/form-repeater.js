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
	$('.produit-repeater').repeater({
        show: function () {
			$(this).slideDown();
		},
		hide: function(remove) {
		  if (confirm('Voulez vous retirer ce produit ?')) {
              $(this).slideUp(remove);
              document.getElementById('poids').focus();
			}
		}
	});

    $('.conteneur-repeater').repeater({
        show: function () {
            $(this).slideDown();
        },
        hide: function(remove) {
            if (confirm('Voulez vous retirer ce conteneur ?')) {
                $(this).slideUp(remove);
                document.getElementById('numconteneurm').focus();
            }
        }
    });

    $('.vehicule-repeater').repeater({
        show: function () {
            $(this).slideDown();
        },
        hide: function(remove) {
            if (confirm('Voulez vous retirer ce véhicule ?')) {
                $(this).slideUp(remove);
                document.getElementById('numvehicule').focus();
            }
        }
    });


})(window, document, jQuery);
