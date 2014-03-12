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

	// 공통
	$result_yn			// 처리 성공실패 여부['Y':성공/'N':실패]
	$result_msg			// 처리메시지
	$mx_issue_no		// 처리번호
	$mx_issue_date		// 처리일자
	$ret_param2			// 이용기관용 값
	$mem_id				// 회원번호
	$mem_nm				// 이용기관용 회원정보
	$auth_key			// 효성인증key
	// 실시간CMS 전용
	$pay_flag			// 동의 후 즉시결제 처리유무(실시간CMS 전용)
	$pay_result_yn		// 출금 성공 실패 여부(실시간CMS 전용)
	$pay_result_msg		// 출금 결과 메시지(실시간CMS 전용)
	$pay_result_amount	// 출금 결과 금액(실시간CMS 전용)
	$pay_fee			// 출금 수수료(실시간CMS 전용)
    */
?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title> 시사통 - 정기 구독(CMS 자동이체) 신청 결과</title>
<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<table width="475" height="400" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="475" height="101" style="width:420px; padding:0; border-bottom:none;">
			<img src="images/title_ok.jpg" alt="시사통 정기 구독 신청 결과"></td>
		</td>
	</tr>
	<tr>
		<td style="width:420px; height:250px; padding-top:1px; padding-left:12px; background-color:#fff; border:none;">
        <table width="461" style="margin-left:25px;" border="0" cellpadding="0" cellspacing="0">
<tr> 
<? if($result_yn!=null && ($result_yn) == "Y"){ ?>
<td colspan="2" height="50"><span class="theadt">
				<strong>시사통 정기 구독 전자동의 결과, 동의에 <font color="red">성공</font>했습니다. 참여해주셔서 감사합니다!<br>
　아래의 신청 정보를 확인하세요.</strong></span>
				<? }else{ ?>
<td colspan="2" height="70"><span class="theadt">
				<strong>시사통 정기 구독 전자동의 결과, 동의에 <font color="red">실패</font>했습니다.<br>
　아래의 신청 정보를 확인하세요.</strong></span>
				<? } ?></td>
</tr>

<tr> 
<td width="83" height="30"><span class="theadt">이름</span></td>
<td width="378" colspan="3"><?=$mem_nm!=null ? $mem_nm : "" ?></td>
</tr>

<tr> 
<td width="83" height="30"><span class="theadt">처리번호</span></td>
<td width="378" colspan="3"><?=$mx_issue_no!=null ? $mx_issue_no : "" ?></td>
</tr>

<tr> 
<td width="83" height="30"><span class="theadt">동의일자</span></td>
<td width="378" colspan="3"><?=$mx_issue_date!=null ? $mx_issue_date : "" ?></td>
</tr>

<tr> 
<td width="83" height="30"><span class="theadt">결과</span></td>
<td width="378" colspan="3"><?=$result_yn!=null ? $result_yn : "" ?></td>
</tr>

<tr> 
<td width="83" height="30"><span class="theadt">결과메시지</span></td>
<td width="378" colspan="3"><?=$result_msg!=null ? $result_msg : "" ?></td>
</tr>

<tr> 
<td width="83" height="30"><span class="theadt">인증키</span></td>
<td width="378" colspan="3"><?=$auth_key!=null ? $auth_key : "" ?></td>
</tr>
</table>
		</td>
	</tr>
	<tr>
		<td style="width:420px; padding-top:16px; border:none;">
        <p align="center"><p align="center"><input type='button' class="okbtn" value='창닫기' onClick="window.open('','_self').close();"></p></p></td>
	</tr>
</table>
</body>
</html>