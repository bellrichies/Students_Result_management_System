<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/portal/app_dbase/connection.php");
$db = new Databases; 

$error =false;

for ($count=0; $count < count($_POST['ca_score']) ; $count++) { 
	
	$ca  = (int) $_POST['ca_score'][$count];
	$ex  = (int) $_POST['ex_score'][$count];

	if (!is_int($ca)) {

		$ca = 0;
	}

	if (!is_int($ex)) {

		$ex = 0;
	}

	$fields=array(
		'student_id' 	=> $_POST['student_id'][$count],
		'semester_id' 	=> $_POST['semester_id'][$count],
		'class_id' 		=> $_POST['class_id'][$count],
		'subject_id' 	=> $_POST['subject_id'][$count],
		'ca_score' 		=> $ca,
		'exam_score' 	=> $ex,
	);

	$where = array(
		'student_id' => $_POST['student_id'][$count],
		'subject_id' => $_POST['subject_id'][$count],
	); 

	$rows =count($db->selectWhere('tbl_student_result',$where));
	if ($rows>0) {
		if ($db->update('tbl_student_result',$fields,$where)) {
			$error = false;
		}else{
			$error = true;
		}
		
	}else{
		if ($saveData = $db->insert('tbl_student_result',$fields)) {
			$error = false;
		}else{
			$error = true;
		}
	}	
}

if ($error == true) {
	echo 'error';
}else {
	echo 'success';
}
?>
