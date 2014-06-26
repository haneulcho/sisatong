<?php
	if(!defined("__XE__")) exit();
	if(Context::get('module') == admin) return;
	if($called_position != before_display_content) return;
	
	if(!$addon_info->height) $height = 40;
	else $height = $addon_info->height;
	
	switch ($addon_info->type_pri) {
		case a: $style = '<style type="text/css">body{margin-bottom:'.$height.'px}.mbanner{height:'.$height.'px;position:fixed;bottom:0px;z-index:2;width:100%}'; break;
		case b: $style = '<style type="text/css">body{margin-top:'.$height.'px}.mbanner{height: '.$height.'px;position:fixed;top:0px;z-index:2;width:100%}'; break;
		default:$style = '<style type="text/css">.mbanner{height:'.$height.'px;width:100%}'; break;
	}
	switch ($addon_info->type_con) {
		case a: $html = '<div class="mbanner"><a href="'.$addon_info->link.'"><img src="'.$addon_info->content.'" alt="banner image" style="width:100%;height:'.$height.'px;"></a>'; break;
		case b: $html = '<div class="mbanner">'.$addon_info->content; break;
		case c: $html = '<div class="mbanner"><iframe name="banner_frame" id="banner_frame" src="'.$addon_info->content.'"></iframe>'; break;
	}
	
	if ($addon_info->type_con == 'c') $style .= '#banner_frame{width:100%;height:100%;margin:0;padding:0;border:none}';
	if ($addon_info->type_ifr == 'yes') $script = '<script type="application/javascript">window.onload=function(){try{banner_frame.document.body.style.overflow=\'hidden\';}catch(e){}};</script>';
	if ($addon_info->type_clo == 'yes') {
		$html .= '<a href="#" class="close_lk" onclick="document.getElementsByClassName(\'mbanner\')[0].style.display=\'none\';document.body.style.margin=\'0\';;"><i class="close_btn"></i></a></div>';
		$style .= '.close_lk{padding:6px;display:inline-block;margin-left:-22px;vertical-align:top}.close_btn{background:url(./addons/mbanner/close_btn.png);border:0;display:block;height:10px;overflow:hidden;width:10px;}</style>';
	}else {
		$html .= '</div>';
		$style .= '</style>';
	}
	
	Context::addHtmlheader($style);
	if ($addon_info->type_ifr == 'yes') Context::addHtmlheader($script);
	if ($addon_info->type_pri == 'c') Context::addHtmlheader($html);
	else Context::addHtmlFooter($html);
?>