<?php
	/**
	 * @class sisatongcastlist
	 * @author 이한결 (mrrays@naver.com)
	 * @brief Sisatong 메인화면 글 목록을 출력하는 위젯
	 **/

	class sisatongcastlist extends WidgetHandler {

		/**
		 * @brief 위젯의 실행 부분
		 *
		 * ./widgets/위젯/conf/info.xml 에 선언한 extra_vars를 args로 받는다
		 * 결과를 만든후 print가 아니라 return 해주어야 한다
		 **/

		function proc($args) {
			// 정렬 대상
			if(!in_array($args->order_target, array('list_order','update_order','regdate','rand()','voted_count','readed_count'))) $args->order_target = 'list_order';

			// 정렬 순서
			if(!in_array($args->order_type, array('asc','desc'))) $args->order_type = 'desc';

			// 필진 리스트 출력하는 부분
			// 위젯 자체적으로 설정한 변수들을 체크
			if (!$args->title) $args->title = '출연진';
			if (!$args->widget_width) $args->widget_width = 200;
			if (!$args->widget_height) $args->widget_height = 200;

			$list_count = (int)$args->list_count;
			if(!$list_count) $list_count = 20;

			$tmp_groups = explode(",",$args->target_group);
			$count = count($tmp_groups);
			for($i=0;$i<$count;$i++) {
				$group_name = trim($tmp_groups[$i]);
				if(!$group_name) continue;
				$target_group[] = $group_name;
			}

			if(!count($target_group)) {
				$site_module_info = Context::get('site_module_info');
				$oMemberModel = &getModel('member');
				$group_list = $oMemberModel->getGroups((int)$site_module_info->site_srl);
				if(!$group_list) return;
				$target_group = array_keys($group_list);
			}

			$obj->selected_group_srl = implode(',',$target_group);
			$obj->list_count = $list_count;
			$output = executeQuery('member.getMemberListWithinGroup', $obj);
			$widget_info->member_list = $output->data;
			$widget_info->title = $args->title;
			$widget_info->widget_width = $args->widget_width;
			$widget_info->widget_height = $args->widget_height;

			$oTemplate = &TemplateHandler::getInstance();

			Context::set('colorset', $args->colorset);
			Context::set('widget_info', $widget_info);

			$tpl_path = sprintf('%sskins/%s', $this->widget_path, $args->skin);
			Context::set('skin_path', $tpl_path);
			$act = Context::get('act');
			if($act == "dispPageAdminContentModify" || $act == "procWidgetGenerateCodeInPage")
				return $oTemplate->compile($tpl_path, "editor");
			return $oTemplate->compile($tpl_path, "list");
		}
	}

	class sisatongcastlistItem extends Object {

		var $browser_title = null;
		var $has_first_thumbnail_idx = false;
		var $first_thumbnail_idx = null;
		var $contents_link = null;
		var $domain = null;

		function coinsliderItem($browser_title=''){
			$this->browser_title = $browser_title;
		}
		function setContentsLink($link){
			$this->contents_link = $link;
		}
		function setFirstThumbnailIdx($first_thumbnail_idx){
			if(is_null($this->first_thumbnail) && $first_thumbnail_idx>-1) {
				$this->has_first_thumbnail_idx = true;
				$this->first_thumbnail_idx= $first_thumbnail_idx;
			}
		}
		function setLink($url){
			$this->add('url',$url);
		}
		function setTitle($title){
			$this->add('title',$title);
		}

		function setThumbnail($thumbnail){
			$this->add('thumbnail',$thumbnail);
		}
		function setContent($content){
			$this->add('content',$content);
		}
		function setRegdate($regdate){
			$this->add('regdate',$regdate);
		}
		function setNickName($nick_name){
			$this->add('nick_name',$nick_name);
		}

		// 글 작성자의 홈페이지 주소를 저장 by misol
		function setAuthorSite($site_url){
			$this->add('author_site',$site_url);
		}
		function setCategory($category){
			$this->add('category',$category);
		}
		function getBrowserTitle(){
			return $this->browser_title;
		}
		function getDomain() {
			return $this->domain;
		}
		function getContentsLink(){
			return $this->contents_link;
		}

		function getFirstThumbnailIdx(){
			return $this->first_thumbnail_idx;
		}

		function getLink(){
			return $this->get('url');
		}
		function getModuleSrl(){
			return $this->get('module_srl');
		}
		function getTitle(){
			return strip_tags($this->get('title'));
		}
		function getShortTitle($cut_size = 0, $tail='...'){
			$title = strip_tags($this->get('title'));

			if($cut_size) $title = cut_str($title, $cut_size, $tail);

			$attrs = array();
			if($this->get('title_bold') == 'Y') $attrs[] = 'font-weight:bold';
			if($this->get('title_color') && $this->get('title_color') != 'N') $attrs[] = 'color:#'.$this->get('title_color');

			if(count($attrs)) $title = sprintf("<span style=\"%s\">%s</span>", implode(';', $attrs), htmlspecialchars($title));

			return $title;
		}
		function getContent(){
			return $this->get('content');
		}
		function getCategory(){
			return $this->get('category');
		}
		function getNickName(){
			return $this->get('nick_name');
		}
		function getAuthorSite(){
			return $this->get('author_site');
		}
		function getCommentCount(){
			$comment_count = $this->get('comment_count');
			return $comment_count>0 ? $comment_count : '';
		}
		function getTrackbackCount(){
			$trackback_count = $this->get('trackback_count');
			return $trackback_count>0 ? $trackback_count : '';
		}
		function getRegdate($format = 'Y.m.d H:i:s') {
			return zdate($this->get('regdate'), $format);
		}
		function printExtraImages() {
			return $this->get('extra_images');
		}
		function haveFirstThumbnail() {
			return $this->has_first_thumbnail_idx;
		}
		function getThumbnail(){
			return $this->get('thumbnail');
		}
		function getMemberSrl() {
			return $this->get('member_srl');
		}
	}
?>
