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
<title>�û��� - ���� ����(CMS �ڵ���ü) ����</title>
<link rel="stylesheet" href="style.css" type="text/css">
<script language='javascript'>
	function reqMemberCancle() {
		var ssignform = document.getElementById('ssignform');  //FORM
		SSIGN_REQUEST(ssignform); //â ���� ��ũ��Ʈ
	}
</script>
</head>

<body>

<!-- ��������������-->
<form name="ssignform" id="ssignform" method="POST">
<!-- �������� ����� REDIRPATH ������ ������ ���� parameter ���� (�������� ����) -->
	<input type="hidden" name="result_yn" value="" />
	<input type="hidden" name="result_msg" value="" />
<!-- �������� ����� REDIRPATH ������ ������ ���� parameter �� -->

<!-- �ش�Ǵ� parameter�� ������ ���� �����մϴ�. -->
<!-- ���� parameter ���� ���� -->
	<input type="hidden" name="work_kind" value="D" />		<!-- ��ϱ���:D[����] -->
	<input type="hidden" name="pay_type" value="01" />		<!-- �������ܱ���:['01':CMS/'02':CARD/'03':�ǽð�CMS] -->
	<input type="hidden" name="cust_id" value="magazinen" />	<!-- �̿��� ID[�ʼ�] -->

	<input type="hidden" name="mx_issue_no" value="M<?php echo date('YmdHis', time()); ?>"/>				<!-- ó�� ��ȣ(�̿��� ����, �ߺ�X) -->
	<input type="hidden" name="mx_issue_date" value="<?php echo date('YmdHis', time()); ?>" />				<!-- ó�� ����(�̿��� ����, YYYYMMDDhhmmss) -->
	<input type="hidden" name="job_mode" value="00" />		<!-- ó�� ���('11':�������/00:�׽�Ʈ) -->
	<input type="hidden" name="ret_param" value="" />			<!-- �̿����� ��, DBPATH�� return -->
	<input type="hidden" name="ret_param2" value="" />		<!-- �̿����� ��, REDIRPATH�� return -->
	<!-- �̿��� ���� ������ ���� �Ǵ� ������ ('http://' ����, ��:'www.test.com' ��Ʈ�� ���� ��� www.test.com:8080 �� ���� ���) -->
	<input type="hidden" name="host" value="<?php echo $_SERVER['HTTP_HOST']; ?>" />
	<input type="hidden" name="dbpath" value="fms/Dbpath.php" />			<!-- ��� ���� ���� ���(��:'/regmem/dbpath.php') -->
	<input type="hidden" name="redirpath" value="fms/Redirpath.php" />	<!-- ��� ȭ�� ���� ���(��:'/regmem/redirpath.php') -->
<!-- ���� parameter ���� �� -->

<!-- ȸ�������� parameter ���� ���� -->
	<input type="hidden" name="mem_id" value="<?php echo $logged_info->member_srl; ?>" />		<!-- ȸ����ȣ (mem_reg_flag='Y'�� �ʼ�, ��üȸ����ȣ �ڵ��ο� ��, ���õ�) -->
	<input type="hidden" name="auth_key" value="" />	<!-- ȿ������ ���� Key, ����/���� �� �ʼ� -->
	<input type="hidden" name="mem_nm" value="<?php echo $logged_info->nick_name; ?>" />		<!-- ȸ����, �̿����� ȸ������ -->
	<input type="hidden" name="join_cert" value="N" />		<!-- ���Ǵ��� ����(Y, N) -->
<!-- ȸ�������� parameter ���� �� -->

</form>
<!--��������������,��-->

<!-- <p>(ȸ�� ����....PHP)</p> -->
<p>�û��� ���ڼ����� ���Ǹ� �����մϴ�.</p>

<p><input type='button' value='���� ����' onClick='reqMemberCancle();'></p>

</body>
</html>