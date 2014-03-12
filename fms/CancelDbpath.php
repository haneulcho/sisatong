<?
	/*
	DBPATH �������� ������ �Ϸ�Ǹ�, ����� ���� �޾Ƽ� �̿����� DB�� ���� �մϴ�.
	���� �Ϸ�� ���ÿ� DBPATH�� ����� �����ϰ�, DBPATH�� ���� return �޽�����
	Ȯ���� �Ǹ�, ó�� ���� ���̴� ���� â�� ���� �Ϸ� �������� ����մϴ�.
	����, DBPATH�� �� �������� ��쿡�� ������ ������ �� �� �ֽ��ϴ�.
	*/

	if (phpversion() >= 4.2) { // POST, GET ��Ŀ� ���� ���� ����ϱ� ���ؼ�
		if (count($_POST)) extract($_POST, EXTR_PREFIX_SAME, 'VARS_');
		if (count($_GET)) extract($_GET, EXTR_PREFIX_SAME, '_GET');
	}

	/*
	�Ʒ��� ���� ���� POST ������� ���۵˴ϴ�. �ڼ��� ������ �Ŵ����� ����ٶ��ϴ�.

	$result_yn		// ó�� �������� ����['Y':����/'N':����]
	$result_msg		// ó���޽���
	$mx_issue_no	// ó����ȣ
	$mx_issue_date	// ó������
	$ret_param			// �̿����� ��
	$mem_id			// ȸ����ȣ
	$mem_nm			// �̿����� ȸ������
	$mx_hash		// �ؽ���
	$auth_key		// ȿ������key

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
	$returnMsg = "ACK=400FAIL";

	/*
	mx_hash ���� output ���� ���� ���ؼ� ��ġ�ϴ� ��쿡�� ��� ����
	*/
	if($mx_hash!=null && $mx_hash==$output) {  // ��ġ�ϴ� ���
		if($result_yn=="Y") {  // ó�� �����̸�
			/*
			�� �κп��� DB�� ����� �����ϴ� �ҽ� �ڵ� �ʿ�
			��) isOK = (DB ������Ʈ ���);
			*/
			//
			$isOK=1;

			if($isOK==1) $returnMsg = "ACK=200OKOK";   // DB ���� �����̸�
			else $returnMsg = "ACK=400FAIL";  // DB ���� �����̸�
		} else {  // ���� ������ ���
			/*
			�� �κп��� DB�� ����� �����ϴ� �ҽ� �ڵ� �ʿ� (���� ���� ��� �ʿ��)
			*/
			//
			if($isOK==1) $returnMsg = "ACK=200OKOK";   // DB ���� �����̸�
			else $returnMsg = "ACK=400FAIL";  // DB ���� �����̸�
		}
	} else {  // ���� ������ ��ġ���� �ʴ� ��� : ����Ÿ ������ ���ɼ��� �����Ƿ�, ���� ���
		$returnMsg = "ACK=400FAIL";
	}

echo $returnMsg;

?>