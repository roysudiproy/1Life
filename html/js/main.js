"use strict";
$(document).ready(function(){
	sizeTheBody()
	jQuery( window ).on( "orientationchange", function( event ) { location.reload(); } )
	jQuery( window ).on( "resize", function( event ) { sizeTheBody(); } )
})
function sizeTheBody(){
	var totalheight = $(window).height();
	var contarea = 30+($('.bodyarea').height());
	
	var headerheight = 30+($('.headbar').height())
	var trgHeight = totalheight-headerheight;
	if(trgHeight>contarea){
	console.log(totalheight+' : '+contarea+' : '+trgHeight)
	$('.bodyarea').css('height',trgHeight+'px')
	}
}