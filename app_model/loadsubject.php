<option value="">Select Subject</option>
<?php 
	require_once(__DIR__ . "../../app_dbase/connection.php");
	$db = new Databases;

	$level    = $_POST['level'];
	$semester = $_POST['semester'];

	$where = array('class_id'=>$level, 'semester_id'=>$semester);
	$subj=$db->selectWhere('tbl_admin_subject',$where,"subject_title");
	foreach ($subj as $sub) {
		$title =$sub['subject_title'];
		$id = $sub['id'];
		echo "<option value='{$id}'>{$title}</option>";

	}
?>