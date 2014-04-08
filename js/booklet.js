jQuery(document).ready(function() {

	jQuery('.postim').mouseenter(function(e) {
        jQuery(this).children('a').children('img').animate({  left:'0', top:'0', width:'15'}, 300);
 
    }).mouseleave(function(e) {
        jQuery(this).children('a').children('img').animate({ left: '0', top: '0', width:'150'}, 300);
       
    });
	
});