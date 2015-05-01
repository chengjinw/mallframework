$(function () {
	frameSize();
})

function frameSize(){
	
	var headerHeight;
	
	if( $(window).width() <= 750 ){
		headerHeight = 100;
	}
	else{
		headerHeight = 50;
	}
	
	var sidebarHeight = $(window).height() - headerHeight;
	var contentHeight = $(window).height() - headerHeight;
	var contentWidth = $(window).width() - 230;

	$("#headerBox").height( headerHeight );
	$("#headerFrame").height( headerHeight );
	$("#sidebarBox").height( sidebarHeight );
	$("#sidebarFrame").height( sidebarHeight );
	$("#contentBox").height( contentHeight );
	$("#contentFrame").height( contentHeight );
	
	$("#contentBox").width( contentWidth );
	$("#contentFrame").width( contentWidth );
	$("#contentFrame").find(".content-wrapper").width( contentWidth );

}

$(window).resize(function(){		
	frameSize();	
});