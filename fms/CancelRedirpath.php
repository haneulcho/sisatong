<?
	/*
	해지창 종료, 회원(이용자) 해지 결과 확인 페이지(RESULT 페이지)를 호출하기 위한 페이지 입니다.
	(해지 완료 -> DBPATH 결과전송 -> REDIRPATH 페이지 -> 해지창 종료 -> RESULT 페이지)
	*/

	if (phpversion() >= 4.2) { // POST, GET 방식에 관계 없이 사용하기 위해서
        if (count($_POST)) extract($_POST, EXTR_PREFIX_SAME, 'VARS_');
        if (count($_GET)) extract($_GET, EXTR_PREFIX_SAME, '_GET');
    }

	$RESULTPATH = "/../fmail/CancelResult.php"; // 결과 확인 페이지의 페이지명과 경로를 설정합니다.
	$CLOSETYPE = "OFF"; // 창을 여기서 닫을 것인지 다음 페이지에서 닫을 것인지. (일반적으로 OFF)

	/*
	$result_yn		// 처리 성공실패 여부['Y':성공/'N':실패]
	$result_msg		// 처리메시지
	$mx_issue_no	// 처리번호
	$mx_issue_date	// 처리일자
	$ret_param2			// 이용기관용 값
	$mem_id			// 회원번호
	$mem_nm			// 이용기관용 회원정보
	$auth_key		// 효성인증key

	*/

	if($mem_id == null) $mem_id = "";
	if($mstr2 == null) $mstr2 = "";
	if($result_msg == null) $result_msg = "";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<script language="javascript">
<!--//

	function proceed() {
		opener.document.ssignform.result_yn.value = "<?=$result_yn?>";
		opener.document.ssignform.result_msg.value = "<?=$result_msg?>";
		opener.document.ssignform.mx_issue_no.value = "<?=$mx_issue_no?>";
		opener.document.ssignform.mx_issue_date.value = "<?=$mx_issue_date?>";		
		opener.document.ssignform.ret_param2.value = "<?=$ret_param2?>";
		opener.document.ssignform.mem_id.value = "<?=$mem_id?>";
		opener.document.ssignform.mem_nm.value = "<?=$mem_nm?>";
		opener.document.ssignform.auth_key.value = "<?=$auth_key?>";
		opener.document.ssignform.action = "<?=$RESULTPATH?>";
		opener.document.ssignform.method = "post";
		opener.document.ssignform.target = "_self";
		opener.document.ssignform.submit(); //전송

<? if($CLOSETYPE=="OFF")  {   ?>
		self.close(); //창닫기!
	}
<? } ?>

	proceed();


//-->
</script>
</head>
<body>
</body>
</html>
