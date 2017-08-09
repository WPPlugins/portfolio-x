
jQuery(document).ready(function ($) {

    if(!(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)){
	
		var c = skrollr.init({
			forceHeight: !1,
			smoothScrolling: !1,
			easing: {
				customEase: function (a) {
					return 5.295 * (a * a * a * a * a) - 18.5325 * (a * a * a * a) + 26.08 * (a * a * a) - 18.59 * (a * a) + 6.7475 * a
				}
			}
		});

		c.refresh(), (window).focus(function () {
			c.refresh();
		});
	
	}
	else{
		$('body').addClass('skrollr-on-mobile');
	}

});





