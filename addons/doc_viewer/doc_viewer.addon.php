<?php
if(!defined("__ZBXE__")) exit();

// 화면에 디스플레이 할때만 동작
if($called_position != "before_display_content") return;

$oDocument = Context::get('oDocument');
if(!$oDocument) return;

if($oDocument->hasUploadedFiles()){
	foreach($oDocument->getUploadedFiles() as $key => $file){
		$ext = explode(".", strtolower($file->source_filename));
		$cnt = count($ext)-1;
		$uploadedfile = $file->uploaded_filename;
		$filename = $file->source_filename;
		$file_size = $file->file_size;
		$url = urlencode(getUrl()."addons/doc_viewer/doc_viewer.php?uploaded_filename="._XE_PATH_.$uploadedfile."&filename=".$filename."&file_size=".$file_size);
		if($ext[$cnt] == 'pdf'){
			$addHTML .= "<iframe class=\"pdf-ppt-viewer\" src=\"https://docs.google.com/gview?url=".$url."&embedded=true\" frameborder=\"0\"></iframe>";
		}
	}
}

if($addHTML){
	Context::addBodyHeader("<script>jQuery(document).ready(function($){ $('.xe_content:eq(0)').append('$addHTML');$('.pdf-ppt-viewer').css('width',$('.pdf-ppt-viewer').parent().width()+'px');$('.pdf-ppt-viewer').css('height',($('.pdf-ppt-viewer').width()/100) * 141+'px'); });</script>");
	Context::addJsFile("./addons/doc_viewer/js/doc_viewer.js");
}
?>