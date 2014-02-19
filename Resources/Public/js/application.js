/*
 * © 2012 by Noël Bossart – noelboss.ch
 */
;
(function($){
	$(document).ready(function(){
		var $mod = $('.tx-nbogallery');

		if($mod.length < 1){
			return;
		}

		$('.fancybox-thumbs', $mod).fancybox({
			prevEffect : 'none',
			nextEffect : 'none',

			topRatio: 0.9,

			maxHeight: $('html').height()-200,

			closeBtn  : true,
			arrows    : true,
			nextClick : true,

			fitToView : true,

			helpers : {
				thumbs : {
					width  : 50,
					height : 50
				}
			}
		});
	});
})(jQuery);
