<?php
require_once(__DIR__ . "../../app_dbase/connection.php");
$db = new Databases;

if (isset($_POST['action'])) {

	$action = $_POST['action'];
	if ($action == "trash") {
	  $index   = $_POST['index'];
	  $where = array('id'=>$index,) ;
	  $db->delete('tbl_admin_subject', $where);
	  echo "success";
	}

	if ($_POST['action']=="addsubject") {

		$class_id  		= htmlentities(strtoupper($_POST['class_index']));
		$semester_id 	= htmlentities(strtoupper($_POST['semester_index']));
		$subject_title 	= htmlentities(strtoupper($_POST['course_title']));
		$subject_code	= htmlentities(strtoupper($_POST['course_code']));
		$subject_unit	= htmlentities(strtoupper($_POST['course_unit']));
		$subject_status	= htmlentities(strtoupper($_POST['course_status']));

		$data = array(  "class_id" 		=> $class_id,   
						"semester_id" 	=> $semester_id,
						"subject_title" => $subject_title,  
						"subject_code" 	=> $subject_code,     
						"subject_unit" 	=> $subject_unit,   
						"subject_status"=> $subject_status,   
					);

		if (!empty($subject_title) && !empty($subject_code) &&
			!empty($subject_unit)  && !empty($subject_status)) {
			if ($db->insert('tbl_admin_subject', $data)) {
				echo "success";
			}
		}else{
			echo "error";
		}
	  
	}

	if ($_POST['action']=="addclass") {
		$data = array( 'programme'=>$_POST['program'],
					   'class'  => $_POST['classname'],
					   'rank'   => $_POST['classRank'],
					);
		if ($db->insert('tbl_admin_class', $data)) {
		    echo "success";
		}
	}

	if ($_POST['action']=='deleteclass') {
		$index = $_POST['id'];
		$where = array('id'=>$index,);
		if ($db->delete('tbl_admin_class', $where)) {
			echo "success";
		}
	}

	if ($_POST['action']=='admit') {
		$admitted_year = date("Y");
		$status = "admitted";
		$studentID = $_POST['action'];
		$data = array(
			"status"		=>	$status,
			"admitted_year"	=>	$admitted_year,
		);

		$where =array(
			'id'=>$_POST["studentID"],
		);

		if ($db->update("tbl_student_applications", $data, $where)) {
			echo "success";
		}
	}
}



?>