<?
	/*
	DBPATH �������� ���ǰ� �Ϸ�Ǹ�, ����� ���� �޾Ƽ� �̿����� DB�� ���� �մϴ�.
	���� �Ϸ�� ���ÿ� DBPATH�� ����� �����ϰ�, DBPATH�� ���� return �޽�����
	Ȯ���� �Ǹ�, ó�� ���� ���̴� ���� â�� ���� ó�� �Ϸ� �������� ����մϴ�.
	����, DBPATH�� �� �������� ��쿡�� ������ ������ �� �� �ֽ��ϴ�.
	*/

	if (phpversion() >= 4.2) { // POST, GET ��Ŀ� ���� ���� ����ϱ� ���ؼ�
		if (count($_POST)) extract($_POST, EXTR_PREFIX_SAME, 'VARS_');
		if (count($_GET)) extract($_GET, EXTR_PREFIX_SAME, '_GET');
	}

	/*
		�Ʒ��� ���� ���� POST ������� ���۵˴ϴ�. �ڼ��� ������ �Ŵ����� ����ٶ��ϴ�.
	// ����
	$result_yn		// ó�� �������� ����['Y':����/'N':����]
	$result_msg		// ó���޽���
	$mx_issue_no	// ó����ȣ
	$mx_issue_date	// ó������
	$ret_param		// �̿����� ��
	$mem_id			// ȸ����ȣ
	$mem_nm			// �̿����� ȸ������
	$mx_hash		// �ؽ���
	$auth_key		// ȿ������key
	// �ǽð�CMS ����
	$pay_flag			// ���� �� ��ð��� ó������(�ǽð�CMS ����)
	$pay_result_yn		// ��� ���� ���� ����(�ǽð�CMS ����)
	$pay_result_msg		// ��� ��� �޽���(�ǽð�CMS ����)
	$pay_result_amount	// ��� ��� �ݾ�(�ǽð�CMS ����)
	$pay_fee			// ��� ������(�ǽð�CMS ����)

	*/
	/*
	ó�� ������ ��/���� ���θ� Ȯ���ϱ� ����,
	�ֿ� ó�� ������ MD5 ��ȣȭ �˰������� HASH ó���� mx_hash ���� �޾�
	������ ��Ģ���� DBPATH���� ������ ��(output)�� ���մϴ�.
	*/

	/*
	MD5 �˰����� �̿��� HASH �� ����
	*/
	$output = md5("F&" . $mem_id . $mx_issue_no . $mx_issue_date);

	$isOK = 0;
	$returnMsg = "ACK=200OKOK";

	/*
	mx_hash ���� output ���� ���� ���ؼ� ��ġ�ϴ� ��쿡�� ��� ����
	*/

//return �޽���('ACK=200OKOK' or 'ACK=400FAIL')�� ����ؾ� ���� ó���˴ϴ�.
echo $returnMsg; 
?>
<? echo $returnMsg;?>
<? //return �޽���('ACK=200OKOK' or 'ACK=400FAIL')�� ����ؾ� ���� ó���˴ϴ�. ?>

