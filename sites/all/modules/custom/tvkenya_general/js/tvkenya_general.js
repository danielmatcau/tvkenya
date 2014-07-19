(function ($) {
  Drupal.behaviors.tvkenya_general = {
    attach: function (context) {
		
		// Set content height to fill the whole display
    	var $height = $(document).height();
    	var $leaderboard_height = $('#leaderboard-wrapper').height();
    	var $nav_height = $('#nav-wrapper').height();
    	var $header_height = $('#header-wrapper').height();
    	var $footer_height = $('#footer-wrapper').height();
    	var $content_height = $height - ($leaderboard_height + $nav_height + $header_height + $footer_height);
    	$('#content-wrapper').css('min-height', $content_height);
    	
	}
  }
}) (jQuery);