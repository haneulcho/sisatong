jQuery(document).ready(function($){
	$(".pdf-ppt-viewer").css('width',$(".pdf-ppt-viewer").parent().width()+'px');
	$(".pdf-ppt-viewer").css('height',($(".pdf-ppt-viewer").width()/100) * 141+'px');
});