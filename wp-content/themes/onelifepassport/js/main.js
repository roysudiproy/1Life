"use strict";

jQuery(document).ready(function(){
	sizeTheBody()
	jQuery( window ).on( "orientationchange", function( event ) { location.reload(); } )
	jQuery( window ).on( "resize", function( event ) { sizeTheBody(); } )
})
function sizeTheBody(){
	var totalheight = jQuery(window).height();
	var contarea = 30+(jQuery('.bodyarea').height());
	
	var headerheight = 30+(jQuery('.headbar').height())
	var trgHeight = totalheight-headerheight;
	if(trgHeight>contarea){
	console.log(totalheight+' : '+contarea+' : '+trgHeight)
	jQuery('.bodyarea').css('height',trgHeight+'px')
	}
}