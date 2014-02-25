<?php
	if(!defined("__ZBXE__")) exit();
	
	// 화면에 디스플레이 할때만 동작
	if($called_position != "before_display_content") return;
	
	$oDocument = Context::get('oDocument');
	
	Context::addHtmlHeader('<meta property="og:type" content="article" />');
	Context::addHtmlHeader('<meta name="twitter:card" content="summary" />');

	if($oDocument){
		// Facebook
		Context::addHtmlHeader('<meta property="og:title" content="'.strip_tags($oDocument->getTitle()).'" />');
		Context::addHtmlHeader('<meta property="og:description" content="'.$oDocument->getSummary().'" />');
		if($oDocument->getThumbnail('300','300','crop'))
			Context::addHtmlHeader('<meta property="og:image" content="'.$oDocument->getThumbnail('300','300','crop').'" />');
		else
			Context::addHtmlHeader('<meta property="og:image" content="'.$addon_info->thumbnail.'" />');
		// Twitter
		Context::addHtmlHeader('<meta name="twitter:title" content="'.strip_tags($oDocument->getTitle()).'" />');
		Context::addHtmlHeader('<meta name="twitter:description" content="'.$oDocument->getSummary().'" />');
		if($oDocument->getThumbnail('300','300','crop'))
			Context::addHtmlHeader('<meta name="twitter:image" content="'.$oDocument->getThumbnail('300','300','crop').'" />');
		else
			Context::addHtmlHeader('<meta name="twitter:image" content="'.$addon_info->thumbnail.'" />');

		// Google +
		Context::addHtmlHeader('<meta itemprop="name" content="'.strip_tags($oDocument->getTitle()).'" />');
		Context::addHtmlHeader('<meta itemprop="description" content="'.$oDocument->getSummary().'" />');
		if($oDocument->getThumbnail('300','300','crop'))
			Context::addHtmlHeader('<meta itemprop="image" content="'.$oDocument->getThumbnail('300','300','crop').'" />');
		else
			Context::addHtmlHeader('<meta itemprop="image" content="'.$addon_info->thumbnail.'" />');		

	}else{
		// Facebook
		Context::addHtmlHeader('<meta property="og:title" content="'.$addon_info->site_title.'" />');
		Context::addHtmlHeader('<meta property="og:description" content="'.$addon_info->site_desc.'" />');
		Context::addHtmlHeader('<meta property="og:image" content="'.$addon_info->thumbnail.'" />');

		// Twitter
		Context::addHtmlHeader('<meta name="twitter:title" content="'.$addon_info->site_title.'" />');
		Context::addHtmlHeader('<meta name="twitter:description" content="'.$addon_info->site_desc.'" />');
		Context::addHtmlHeader('<meta name="twitter:image" content="'.$addon_info->thumbnail.'" />');

		// Google +
		Context::addHtmlHeader('<meta itemprop="name" content="'.$addon_info->site_title.'" />');
		Context::addHtmlHeader('<meta itemprop="description" content="'.$addon_info->site_desc.'" />');
		Context::addHtmlHeader('<meta itemprop="image" content="'.$addon_info->thumbnail.'" />');
	}
?>