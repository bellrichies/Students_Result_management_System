<?php 
require_once($_SERVER["DOCUMENT_ROOT"]."/portal/app_dbase/connection.php");
$db = new Databases;
if (isset($_POST['studentIds'])){
	$length = count($_POST['studentIds']);

	for ($i=0; $i < $length ; $i++) { 
		echo $student_Id = $_POST['studentIds'][$i];
		$fields = array('student_level'=>$_POST['classto']);
		$where  = array('id'=>$student_Id);
		if ($db->update("tbl_student_admin", $fields, $where)){
		}
		
	}

}

?>
	

