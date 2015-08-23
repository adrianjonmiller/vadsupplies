DLN.Behaviors.header_collapse = function(container){
	console.log("success");
	var container_height = container.height(),
	nav_height = container.find('nav').height();

	if(!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {

		$(document).on("scroll", function(){
			offset_header();
		});

		$(document).on("load", function(){
			offset_header();
		});
	}
	
	function offset_header() {
		var offset = $(this).scrollTop();

		if(offset >= 0) {
			if ( container_height - nav_height >= offset ) {
				container.height(container_height - offset);
			} else {
				container.height(nav_height);
			}
		} else {
			container.height(container_height);
		}
	}
};


DLN.Behaviors.masonry = function(container){
	container.imagesLoaded(function() {
		container.masonry({
	  	itemSelector: '.product',
	  	gutter: 18
		});
	});
};

DLN.Behaviors.select_menu = function(container) {
	container.select2({
		minimumResultsForSearch: -1
	});

	container.change(function() { 
		window.location = jQuery(this).find("option:selected").val();
	});
}


// jQuery( ".select-menu" ).change(function() { 
// 		        window.location = jQuery(this).find("option:selected").val();
// 		    });