<?php
require_once(__DIR__ . "../../app_dbase/connection.php");
require_once(__DIR__ . "../../app_function/function.php");
$db = new Databases;

if (isset($_POST['matric_no'])) {
	$succes_message = "";
	$err_message  = "";
	$rows = count($_POST['matric_no']); 	//get array length for the post data
	$i=0;				
	while ($i < $rows) { 								// loop true the array contents
		$student_id = $_POST['student_id'][$i];			// extract individual student id data
		$student_name = $_POST['student_name'][$i];		// 					  student name
		$matric_number = $_POST['matric_no'][$i];		// 					  student matric number
		if (!empty($matric_number)) {
			//check if the matric number is assigned to a student already
			$where = array("status"=>$matric_number,);
			if ($result = $db->selectWhere("tbl_student_applications",$where)) {
				$err_message .= '<span class="text-danger">' . $matric_number . ' asigned to '.$student_name.' is already in use by another applicant.</span> <br>';
			}else {
				$succes_message .='<span class="text-success">' . $matric_number . ' is successfully assigned to '.$student_name.' </span> <br>';
				$fields= array('status' => $matric_number,);
				$where = array('id' => $student_id,);
				$db->update('tbl_student_applications',$fields,$where);
			}
		}
		$i++;
	}
	echo $succes_message;
	echo $err_message;
}
?>