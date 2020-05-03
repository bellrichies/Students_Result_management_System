<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/portal/app_dbase/connection.php");
$db = new Databases;
if (isset($_POST['newclass'])) {
	$newclass = htmlentities(stripslashes($_POST['newclass']));
	$student  = strtoupper($_POST['student']);
	$where = array('student_matric'=>$student);
	if ($row = $db->selectWhere('tbl_student_admin',$where)) {
		//delete all scoresheet for the student
		$student_id = $row[0]['id'];
		$where = array('student_id'=>$student_id);
		$db->delete('tbl_student_result',$where);
		//differ admission for another class
		$data  = array('student_level'=>$newclass);
		$where = array('student_matric'=>$student);
		$db->update('tbl_student_admin',$data,$where);
		echo 'success';
	}
}else{
	echo "error";
	}
