<?php
require_once(__DIR__ . "../../app_dbase/connection.php");
$db = new Databases;

if ($_POST['id']) {

	$id = $_POST['id'];
	$celldat = $_POST['cell1'];
	$cellban = $_POST['cell2'];
	$cellrec = $_POST['cell3'];
	$celldue = $_POST['cell4'];
	$cellpay = $_POST['cell5'];
	$cellses = $_POST['cell6'];

	$data  = array( 
					'student_id'		=> $id,
					'payment_date'		=> $celldat,
					'payment_due' 		=> $celldue,
					'payment_amount' 	=> $cellpay,
					'payment_bank'		=> $cellban,
					'payment_receipt'	=> $cellrec,
					'payment_session'	=> $cellses,
				);

	$tbl_name = 'tbl_admin_account';
	if ($success=$db->insert($tbl_name,$data)) {
		echo "success";
	}
}
?>