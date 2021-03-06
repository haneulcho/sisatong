var intervalId;
var slidetime = 2500; // milliseconds between automatic transitions

(function($){
$(document).ready(function() {	

  // Comment out this line to disable auto-play
	// intervalID = setInterval(cycleImage, slidetime);

	$(".main_image .desc").show(); // Show Banner
	$(".main_image .block").animate({ opacity: 0.65 }, 1 ); // Set Opacity

	// Click and Hover events for thumbnail list
	$(".image_thumb ul li:first").addClass('active'); 
	$(".image_thumb ul li").click(function(){ 
		// Set Variables
		var imgAlt = $(this).find('img').attr("alt"); //  Get Alt Tag of Image
		var imgTitle = $(this).find('.hiddenImage').data('src'); // Get Main Image URL
		var imgDesc = $(this).find('.hiddenBlock').html(); 	//  Get HTML of block
		var imgDescHeight = $(".main_image").find('.block').height();	// Calculate height of block
		var imgHref = $(this).find('a').attr("href"); // Get item url
		
		if ($(this).is(".active")) {  // If it's already active, then...
			return false; // Don't click through
		} else {
			// Animate the Teaser
			$(".main_image .block").animate({ opacity: 0, marginBottom: -imgDescHeight }, 250 , function() {
				$(".main_image .block").html(imgDesc).animate({ opacity: 0.85,	marginBottom: "0" }, 250 );
				$(".main_image img").attr({ src: imgTitle , alt: imgAlt });
				$(".main_image img").parents('a').attr({ href: imgHref });
			});
		}
		
		$(".image_thumb ul li").removeClass('active'); // Remove class of 'active' on all lists
		$(this).addClass('active');  // add class of 'active' on this list only
		return false;
		
	}) .hover(function(){
		$(this).addClass('hover');
		}, function() {
		$(this).removeClass('hover');
	});
			
	// Toggle Teaser
	$("a.collapse").click(function(){
		$(".main_image .block").slideToggle();
		$("a.collapse").toggleClass("show");
	});
	
	// Function to autoplay cycling of images
	// Source: http://stackoverflow.com/a/9259171/477958
	function cycleImage(){
	var onLastLi = $(".image_thumb ul li:last").hasClass("active");       
	var currentImage = $(".image_thumb ul li.active");
	
	
	if(onLastLi){
	  var nextImage = $(".image_thumb ul li:first");
	} else {
	  var nextImage = $(".image_thumb ul li.active").next();
	}
	
	$(currentImage).removeClass("active");
	$(nextImage).addClass("active");
	
	// Duplicate code for animation
	var imgAlt = $(nextImage).find('img').attr("alt");
	var imgTitle = $(nextImage).find('.hiddenImage').data('src');;
	var imgDesc = $(nextImage).find('.block').html();
	var imgDescHeight = $(".main_image").find('.block').height();
	var imgHref = $(nextImage).find('a').attr("href");
	$(".main_image .block").animate({ opacity: 0, marginBottom: -imgDescHeight }, 250 , function() {
		$(".main_image .block").html(imgDesc).animate({ opacity: 0.65,	marginBottom: "0" }, 250 );
		$(".main_image img").attr({ src: imgTitle , alt: imgAlt});
		$(".main_image img").parents('a').attr({ href: imgHref });
		});
	};
	
});// Close Function
})(jQuery);