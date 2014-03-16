<?
    /*
    REDIRPATH 페이지에서 redirection 되는 처리 결과 정보 확인 페이지 입니다.
    */

    if (phpversion() >= 4.2) { // POST, GET 방식에 관계 없이 사용하기 위해서
        if (count($_POST)) extract($_POST, EXTR_PREFIX_SAME, 'VARS_');
        if (count($_GET)) extract($_GET, EXTR_PREFIX_SAME, '_GET');
    }


    /*
    아래와 같은 값이 전송됩니다. 자세한 설명은 매뉴얼을 참고바랍니다.

	$result_yn		// 처리 성공실패 여부['Y':성공/'N':실패]
	$result_msg		// 처리메시지
	$mx_issue_no	// 처리번호
	$mx_issue_date	// 처리일자
	$ret_param2			// 이용기관용 값
	$mem_id			// 회원번호
	$mem_nm			// 이용기관용 회원정보
	$auth_key		// 효성인증key

    */
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>::::: 해지 결과 확인(PHP) :::::</title>
<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
	<b>해지 결과 :</b>
	<? if($result_yn!=null && ($result_yn) == "Y"){ ?>
		<b>&nbsp;해지 성공했습니다.(PHP)</b><br/>
	<? }else{ ?>
		<b>&nbsp;해지 실패했습니다.(PHP)</b><br/>
	<? } ?>
	<br/>
	<br/>
	<p>해지 정보 확인</p>
	처리번호 :&nbsp;<?=$mx_issue_no!=null ? $mx_issue_no : "" ?><br/>
	동의일자 :&nbsp;<?=$mx_issue_date!=null ? $mx_issue_date : "" ?><br/>
	회원정보 :&nbsp;<?=$mem_id!=null ? $mem_id : "" ?><br/>
	결과구분 :&nbsp;<?=$result_yn!=null ? $result_yn : "" ?><br/>
	결과메시지 :&nbsp;<?=$result_msg!=null ? $result_msg : "" ?><br/>
</body>
</html>