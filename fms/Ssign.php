<?php
	if (!$_SESSION['is_logged']) {
		header("Location: http://sisatong.net");
	} else {
		$logged_info = Context::get('logged_info');
	}
?>

<load target="style.css" type="text/css" />
<script src="http://ap.efnc.co.kr/fnpay/ssign/comm/ssign.js" charset="euc-kr"></script>


<table width="475" height="425" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="475" height="101" style="width:420px; padding:0; border-bottom:none;">
			<img src="images/title.jpg" alt="시사통 구독 신청">
		</td>
	</tr>
	<tr>
		<td style="width:420px; height:240px; padding-top:1px; padding-left:12px; background-color:#fff; border:none;">
			<table width="461" style="margin-left:25px;" border="0" cellpadding="0" cellspacing="0">
				<form name="f1" id="f1" method="post">
				<input type="hidden" name="mode" value="send">

				<tr> 
					<td width="132" height="30"><span class="theadt">예금주 (신청인)</span></td>
					<td colspan="3"><input id="bankname" name="bankname" type="text" size="15" maxlength="100" value="<?php echo $logged_info->supporter_name; ?>"></td>
				</tr>

				<tr>
					<td width="132" height="30"><span class="theadt">휴대폰<br />('-', 공백 없이 숫자만 입력)</span></td>
					<td colspan="3"><input id="mem_tel" name="mem_tel" type="text" style="width:156px" maxlength="12" value="<?php echo preg_replace('/\D/', '', $logged_info->supporter_phone); ?>"></td>
				</tr>

				<tr>
					<td width="132" height="30"><span class="theadt">월 구독료</span></td>
					<td colspan="3">
						<input type="radio" class="bnone pay_d_amount" name="pay_d_amount" value="5000">5,000원 
						<input type="radio" class="bnone pay_d_amount" name="pay_d_amount" value="10000">10,000원 
						<input type="radio" class="bnone pay_d_amount" name="pay_d_amount" value="20000">20,000원 
						<input type="radio" class="bnone pay_d_amount" name="pay_d_amount" value="30000">30,000원 
						<input type="radio" id="is_pay_custom" class="bnone pay_d_amount" name="pay_d_amount" value="custom">직접입력 
						<input type="text" id="pay_custom_amount" name="pay_custom_amount" maxlength="6" placeholder="숫자만 입력" disabled>
					</td>
				</tr>

				<tr> 
					<td width="132" height="30"><span class="theadt">현금영수증 발급</span></td>
					<td colspan="3">
						<input type="radio" name="receipt" value="false" class="bnone is_recv_receipt">안함 
						<input type="radio" name="receipt" value="true" class="bnone is_recv_receipt" id="is_recv_recipt_true">발급(-제외, 숫자만) 
						<input name="receipt_info" type="text" size="15" maxlength="20" id="receipt_info" disabled>
					</td>
				</tr>
				</form>
			</table>
		</td>
	</tr>
	<tr>
		<td height="83" style="width:420px; padding-top:6px; border:none;">
        <p align="center"><input id="submit" type='button' class="okbtn" value="시사통 구독 신청하기"></p></td>
	</tr>
</table>

<!--효성FMS-->
<form name="ssignform" id="ssignform" method="POST">
<!-- 동의 결과 페이지 전송을 위한 parameter 시작 (수정하지 말것) -->
	<input type="hidden" name="result_yn" value="" />
	<input type="hidden" name="result_msg" value="" />

	<!-- 실시간출금 결과를 위한 parameter -->
	<input type="hidden" name="pay_result_yn" value="" />
	<input type="hidden" name="pay_result_msg" value="" />
	<input type="hidden" name="pay_result_amount" value="" />
	<input type="hidden" name="pay_fee" value="" />
<!-- 동의 결과 페이지 전송을 위한 parameter 끝 -->

<!-- 공통 parameter 설정 시작 -->
	<input type="hidden" name="work_kind" value="N" />		<!-- 등록구분:N[신규] -->
	<input type="hidden" name="pay_type" value="01" />		<!-- 결제수단구분:['01':CMS/'02':CARD/'03':실시간CMS] -->
	<input type="hidden" name="cust_id" value="sisatong04" />	<!-- 이용기관 ID[필수] -->
	<input type="hidden" name="mx_issue_no" value="M<?php echo date('YmdHis', time()); ?>"/>				<!-- 처리 번호(이용기관 생성, 중복X) -->
	<input type="hidden" name="mx_issue_date" value="<?php echo date('YmdHis', time()); ?>" />				<!-- 처리 일자(이용기관 생성, YYYYMMDDhhmmss) -->
	<input type="hidden" name="job_mode" value="11" />		<!-- 처리 모드('11':실제등록/00:테스트) -->
	<input type="hidden" name="ret_param" value="" />		<!-- 이용기관용 값, DBPATH로 return -->
	<input type="hidden" name="ret_param2" value="" />		<!-- 이용기관용 값, REDIRPATH로 return -->
	<input type="hidden" name="host" value="<?php echo $_SERVER['HTTP_HOST']; ?>" />	<!-- 이용기관 서버 도메인 네임 또는 아이피 ('http://' 제외, 예:'www.test.com' 포트가 있을 경우 www.test.com:8080 과 같이 기술) -->
	<input type="hidden" name="dbpath" value="/fms/Dbpath.php" />		<!-- 결과 저장 파일 경로(예:'/regmem/dbpath.asp') -->
	<input type="hidden" name="redirpath" value="/fms/Redirpath.php" />	<!-- 결과 화면 파일 경로(예:'/regmem/redirpath.asp') -->
	<input type="hidden" name="pay_flag" value="N" />		<!-- 동의 후 즉시결제 처리유무(Y, N) -->

	<!-- 회원정보용 parameter 설정 시작 -->
	<input type="hidden" name="mem_id" value="<?php echo $logged_info->member_srl; ?>" />		<!-- 회원번호 (업체회원번호 자동부여 시, 무시됨) -->
	<input type="hidden" name="auth_key" value="0" />				<!-- 효성발행 인증 Key, 수정/해지 시 필수-->
	<input type="hidden" name="mem_nm" value="<?php echo $logged_info->nick_name; ?>" />		<!-- 회원명, 이용기관용 회원정보 -->
	<!-- 공통 parameter 설정 끝 -->

	<!-- 요청 paremeter, 옵션 -->
	<input type="hidden" name="pay_dt" value="25" />		<!-- 약정일:01일~30일 (생략시 01일) -->
	<input type="hidden" name="email" value="<?php echo $logged_info->email_address; ?>">
	<input type="hidden" name="pay_start" value="" />		<!-- 결제시작일 (생략시 오늘) -->
	<input type="hidden" name="pay_end" value="" />			<!-- 결제종료일 (생략시 99991231) -->
	<input type="hidden" name="pay_amount" value="" />		<!-- 회원기본결제금액 (생략시 0원) -->
	<input type="hidden" name="sms_flag" value="Y" />		<!-- SMS수신여부(Y/N) -->
	<input type="hidden" name="mem_tel" value="" />			<!-- 회원전화번호(휴대폰번호) -->
	<input type="hidden" name="mem_text" value="" />		<!-- 회원메모 -->
	<input type="hidden" name="receipt_flag" value="Y" />	<!-- 현금영수증사용여부(Y/N) -->
	<input type="hidden" name="receipt_key" value="" />		<!-- 현금영수증정보 -->
	<input type="hidden" name="mem_reg_flag" value="Y" />	<!-- 결제회원 자동등록(Y, N) -->
	<input type="hidden" name="join_cert" value="N" />		<!-- 동의대행 접근(Y, N) -->
	<input type="hidden" name="acct_nm" value="" />			<!-- 예금주 이름 -->

<!-- 회원정보용 parameter 설정 끝 -->
</form>

<script>
(function($){
$(document).ready(function() {	
	// var sisatongCharset = document.charset;  //시사통 utf-8에서 효성 euc-kr로 넘기기

	$('.pay_d_amount').change(function() {
		if ($('#is_pay_custom').attr('checked')) {
			$('#pay_custom_amount').removeAttr('disabled');
		} else {
			$('#pay_custom_amount').attr('disabled', 'disabled');
		}
	});

	$('.is_recv_receipt').change(function() {
		if ($('#is_recv_recipt_true').attr('checked')) {
			$('#receipt_info').removeAttr('disabled');
		} else {
			$('#receipt_info').attr('disabled', 'disabled');
		}
	});

	$('#submit').click(function () {
		if (confirm('시사통 전자동의 서비스로 이동하시겠습니까?') == true) {
			document.charset = 'EUC-KR';  //form 넘길 때는 euc-kr
			var $input_bankname = $('#bankname');
			var $input_mem_tel = $('#mem_tel');
			var $input_pay_custom_amount = $('#pay_custom_amount');
			var $input_receipt_info = $('#receipt_info');
			
			if ($.trim($input_bankname.val()) == '') {
				alert('예금주(신청인)을 입력해주세요.');
				$input_bankname.focus();
				return;
			}
			if ($.trim($input_mem_tel.val()) == '') {
				alert('휴대폰(연락처)를 입력해주세요.');
				$input_mem_tel.focus();
				return;
			}
			if (isNaN($.trim($input_mem_tel.val()))){
				alert('휴대폰(연락처)에는 숫자만 입력해주세요.');
				$input_mem_tel.focus();
				return;
			}
			var $mem_tel_root = $.trim($input_mem_tel.val()).substring(0,3);
			if ($mem_tel_root != '010' && $mem_tel_root != '011' && $mem_tel_root != '016' && $mem_tel_root != '017' && $mem_tel_root != '018' && $mem_tel_root != '019') {
				alert('제대로된 휴대폰(연락처) 번호를 입력해주세요.');
				$input_mem_tel.focus();
				return;
			}
			if (!$('.pay_d_amount').is(':checked') || ($('.pay_d_amount:checked').val() == 'custom' && $.trim($input_pay_custom_amount.val()) == '')) {
				alert('구독료를 정해주세요.');
				$('.pay_d_amount').focus();
				return;
			}
			if ($('.pay_d_amount:checked').val() == 'custom' && isNaN($.trim($input_pay_custom_amount.val()))) {
				alert('구독료에는 숫자만 입력해주세요.');
				$input_pay_custom_amount.focus();
				return;
			}
			if ($('.pay_d_amount:checked').val() == 'custom' && Number($.trim($input_pay_custom_amount.val())) < 1000) {
				alert('구독료는 1000원 이상부터 가능합니다.');
				$input_pay_custom_amount.focus();
				return;
			}
			if (!$('.is_recv_receipt').is(':checked')) {
				alert('현금영수증 발급 여부를 선택해주세요.');
				$('.is_recv_receipt').focus();
				return;
			}
			if ($('#is_recv_recipt_true').is(':checked') && $.trim($input_receipt_info.val())) {
				alert('현금영수증 발급 번호(휴대폰 또는 발급카드)는 숫자만 입력하실 수 있습니다.');
				$input_receipt_info.focus();
				return;
			}
			if ($('#is_recv_recipt_true').is(':checked') && isNaN($.trim($input_receipt_info.val()))) {
				alert('현금영수증 발급 번호(휴대폰 또는 발급카드)는 숫자만 입력하실 수 있습니다.');
				$input_receipt_info.focus();
				return;
			}
			document.ssignform.acct_nm.value = $.trim($input_bankname.val()); //이름
			document.ssignform.mem_tel.value = $.trim($input_mem_tel.val()); //핸드폰번호
			document.ssignform.pay_amount.value = $('#is_pay_custom').is(':checked')? $.trim($input_pay_custom_amount.val()): $.trim($('.pay_d_amount:checked').val());
			if ($('#is_recv_recipt_true').is(':checked')) {
				document.ssignform.receipt_flag.value = 'Y';
				document.ssignform.receipt_key.value = $.trim($input_receipt_info.val());
			} else {
				document.ssignform.receipt_flag.value = 'N';
				document.ssignform.receipt_key.value = '';
			}

			// console.log(document.ssignform.acct_nm.value);
			// console.log(document.ssignform.mem_tel.value);
			// console.log(document.ssignform.pay_amount.value);
			// console.log(document.ssignform.receipt_flag.value);
			// console.log(document.ssignform.receipt_key.value);

			var ssignform = document.getElementById('ssignform');  //FORM
			SSIGN_REQUEST(ssignform); //창 연동 스크립트
			// document.charset = sisatongCharset; //form 넘기고 나서는 다시 utf-8로 돌아오게
		}
	});
});
})(jQuery);
</script>