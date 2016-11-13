jQuery(function($) {
	$('#team-members a.aligncenter').hover(
		
	function() {
	    $(this).append('<div class="bio-text"><span>Read Bio</span></div><div class="clearfix"></div>')
	        $('.both').animate({opacity: 1.0}) 
	}, 
	function(){
        $('#team-members a.aligncenter div.bio-text').fadeOut(1, function(){
            $(this).remove()
        })
	});


});