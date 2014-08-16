(function ($) {
  Drupal.behaviors.tvkenya_channels = {
    attach: function (context) {
		
		//Show full schedule for channels
		$('h2.four-shows').click(function () {
			if ($(this).parent().find('.full-schedule').css('display') != 'block') {
				$(this).addClass('four-shows-opened');
				$(this).parent().find('.full-schedule').slideDown('slow');
				$(this).parent().find('.custom-schedule').slideUp('fast');
			}
			else {
				$(this).parent().find('.full-schedule').slideUp('fase');
				$(this).parent().find('.custom-schedule').slideDown('slow');
				$(this).removeClass('four-shows-opened');
			}
		});
		
		// Link finder channel to page element.
		$('#autocomplete .channel').bind('click', function(event){
			event.preventDefault();
		});

	}
  }
}) (jQuery);