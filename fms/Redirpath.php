<?
	/*
	����â ����, ȸ��(�̿���) ���� ��� Ȯ�� ������(RESULT ������)�� ȣ���ϱ� ���� ������ �Դϴ�.
	(���� �Ϸ� -> DBPATH ������� -> REDIRPATH ������ -> ����â ���� -> RESULT ������)
	*/

	if (phpversion() >= 4.2) { // POST, GET ��Ŀ� ���� ���� ����ϱ� ���ؼ�
        if (count($_POST)) extract($_POST, EXTR_PREFIX_SAME, 'VARS_');
        if (count($_GET)) extract($_GET, EXTR_PREFIX_SAME, '_GET');
    }

	$RESULTPATH = "/fms/Result.php"; // ��� Ȯ�� �������� ��������� ��θ� �����մϴ�.
	$CLOSETYPE = "OFF"; // â�� ���⼭ ���� ������ ���� ���������� ���� ������. (�Ϲ������� OFF)

	/*
	// ����
	$result_yn			// ó�� �������� ����['Y':����/'N':����]
	$result_msg			// ó���޽���
	$mx_issue_no		// ó����ȣ
	$mx_issue_date		// ó������
	$ret_param2			// �̿����� ��
	$mem_id				// ȸ����ȣ
	$mem_nm				// �̿����� ȸ������
	$auth_key			// ȿ������key
	// �ǽð�CMS ����
	$pay_flag			// ���� �� ��ð��� ó������(�ǽð�CMS ����)
	$pay_result_yn		// ��� ���� ���� ����(�ǽð�CMS ����)
	$pay_result_msg		// ��� ��� �޽���(�ǽð�CMS ����)
	$pay_result_amount	// ��� ��� �ݾ�(�ǽð�CMS ����)
	$pay_fee			// ��� ������(�ǽð�CMS ����)
	*/

	if($mem_id == null) $mem_id = "";
	if($ret_param2 == null) $ret_param2 = "";
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

		opener.document.ssignform.value = "<?=$pay_flag?>";
		opener.document.ssignform.value = "<?=$pay_result_yn?>";
		opener.document.ssignform.value = "<?=$pay_result_msg?>";
		opener.document.ssignform.value = "<?=$pay_result_amount?>";
		opener.document.ssignform.value = "<?=$pay_fee?>";

		opener.document.ssignform.action = "<?=$RESULTPATH?>";
		opener.document.ssignform.method = "post";
		opener.document.ssignform.target = "_self";
		opener.document.ssignform.submit(); //����

<? if($CLOSETYPE=="OFF")  {   ?>
		self.close(); //â�ݱ�!
	}
<? } ?>

	proceed();


//-->
</script>
</head>
<body>
</body>
</html>
