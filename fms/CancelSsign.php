<?php
	if (!$_SESSION['is_logged']) {
		header("Location: http://sisatong.net");
	} else {
		$logged_info = Context::get('logged_info');
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="charset=utf-8">
<script charset="euc-kr" src="http://ap.efnc.co.kr/fnpay/ssign/comm/ssign.js"></script>
<title>시사통 - 정기 구독(CMS 자동이체) 해지</title>
<link rel="stylesheet" href="style.css" type="text/css">
<script language='javascript'>
	function reqMemberCancle() {
		var ssignform = document.getElementById('ssignform');  //FORM
		SSIGN_REQUEST(ssignform); //창 연동 스크립트
	}
</script>
</head>

<body>

<!-- 동의해지정보용-->
<form name="ssignform" id="ssignform" method="POST">
<!-- 동의해지 결과의 REDIRPATH 페이지 전송을 위한 parameter 시작 (수정하지 말것) -->
	<input type="hidden" name="result_yn" value="" />
	<input type="hidden" name="result_msg" value="" />
<!-- 동의해지 결과의 REDIRPATH 페이지 전송을 위한 parameter 끝 -->

<!-- 해당되는 parameter를 다음과 같이 설정합니다. -->
<!-- 공통 parameter 설정 시작 -->
	<input type="hidden" name="work_kind" value="D" />		<!-- 등록구분:D[해지] -->
	<input type="hidden" name="pay_type" value="01" />		<!-- 결제수단구분:['01':CMS/'02':CARD/'03':실시간CMS] -->
	<input type="hidden" name="cust_id" value="magazinen" />	<!-- 이용기관 ID[필수] -->

	<input type="hidden" name="mx_issue_no" value="M<?php echo date('YmdHis', time()); ?>"/>				<!-- 처리 번호(이용기관 생성, 중복X) -->
	<input type="hidden" name="mx_issue_date" value="<?php echo date('YmdHis', time()); ?>" />				<!-- 처리 일자(이용기관 생성, YYYYMMDDhhmmss) -->
	<input type="hidden" name="job_mode" value="00" />		<!-- 처리 모드('11':실제등록/00:테스트) -->
	<input type="hidden" name="ret_param" value="" />			<!-- 이용기관용 값, DBPATH로 return -->
	<input type="hidden" name="ret_param2" value="" />		<!-- 이용기관용 값, REDIRPATH로 return -->
	<!-- 이용기관 서버 도메인 네임 또는 아이피 ('http://' 제외, 예:'www.test.com' 포트가 있을 경우 www.test.com:8080 과 같이 기술) -->
	<input type="hidden" name="host" value="<?php echo $_SERVER['HTTP_HOST']; ?>" />
	<input type="hidden" name="dbpath" value="fms/Dbpath.php" />			<!-- 결과 저장 파일 경로(예:'/regmem/dbpath.php') -->
	<input type="hidden" name="redirpath" value="fms/Redirpath.php" />	<!-- 결과 화면 파일 경로(예:'/regmem/redirpath.php') -->
<!-- 공통 parameter 설정 끝 -->

<!-- 회원정보용 parameter 설정 시작 -->
	<input type="hidden" name="mem_id" value="<?php echo $logged_info->member_srl; ?>" />		<!-- 회원번호 (mem_reg_flag='Y'시 필수, 업체회원번호 자동부여 시, 무시됨) -->
	<input type="hidden" name="auth_key" value="" />	<!-- 효성발행 인증 Key, 수정/해지 시 필수 -->
	<input type="hidden" name="mem_nm" value="<?php echo $logged_info->nick_name; ?>" />		<!-- 회원명, 이용기관용 회원정보 -->
	<input type="hidden" name="join_cert" value="N" />		<!-- 동의대행 접근(Y, N) -->
<!-- 회원정보용 parameter 설정 끝 -->

</form>
<!--동의해지정보용,끝-->

<!-- <p>(회원 정보....PHP)</p> -->
<p>시사통 전자서명의 동의를 해지합니다.</p>

<p><input type='button' value='동의 해지' onClick='reqMemberCancle();'></p>

</body>
</html>