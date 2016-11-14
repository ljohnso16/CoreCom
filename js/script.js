//default WP Jquery
jQuery(function($) {
	/*this is used to remove the elipses character that apears when you whant the view more link to apear 
	**Note: elipses character not 3 periods.
	*/
	$('.listings div.entry-content p').each(function(){
	    $(this).html($(this).html().split('…').join(""));
	});
//cleans up output of meta links
//i would like to build this functionalilty into the shortcode plugin, make a [baretaxonomy]

	$('#team-members span.entry-terms a').replaceWith(function () {
	    return $(this).text();
	});
	$('#listings-area span.entry-terms a').replaceWith(function () {
	    return $(this).text();
	});	

	$('#listings-area span.entry-terms').each(function(){
	    $(this).html($(this).html().split('/ ').join("/"));
	});

	$('#team-members span.entry-terms').each(function(){
	    $(this).html($(this).html().split('/ ').join("/"));
	});	
	//cleans up output of meta links

//read bio slide	
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