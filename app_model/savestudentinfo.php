<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/portal/app_dbase/connection.php");
$db = new Databases;
if (isset($_POST['action'])) {
	$oldImage 		= $_POST['oldImage'];
	$profile_pix   	= $_FILES['image']['name'];
	$tempFile  	   	= $_FILES['image']['tmp_name'];

	$path ="";

	if (!empty($profile_pix)) {
		$slipt	   = explode(".", $profile_pix);
		$extension = strtolower($slipt[1]);
		$allowed   = array("jpg","jpeg","png","gif");
		if (in_array($extension, $allowed)) {
			$profile_pix =rand().".".$extension;
			$path = $_SERVER['DOCUMENT_ROOT'] . "/portal/images/profile/".$profile_pix;
		}else {
			echo "invalid format";
		}
	}else {
	    $profile_pix = $oldImage;
	}

	$newPass = $_POST['password'];
	$oldPass = $_POST['oldPass'];

	if (empty($newPass)) {
		$student_password 	= $_POST['oldPass'];
		$student_comment    = $_POST['oldComment'];
	}else {
		$student_comment 	= htmlentities(stripslashes($_POST['password']));
		$student_password   = md5($_POST['password']);
	}

	$student_image   	= $profile_pix;
	$student_matric 	= htmlentities(stripslashes($_POST['matric']));
	$student_surname    = htmlentities(stripslashes($_POST['surname']));
	$student_firstname  = htmlentities(stripslashes($_POST['firstname']));
	$student_othernames = htmlentities(stripslashes($_POST['middlename']));
	$student_gender  	= htmlentities(stripslashes($_POST['gender']));
	$student_email      = htmlentities(stripslashes($_POST['email']));
	$student_dob  		= htmlentities(stripslashes($_POST['datebirth']));
	$student_course 	= htmlentities(stripslashes($_POST['course']));
	$student_address 	= htmlentities(stripslashes($_POST['address']));
	$student_phone 		= htmlentities(stripslashes($_POST['mobile']));

	$data =array('student_image'	=> $student_image, 
				'student_surname'	=> $student_surname,
				'student_firstname'	=> $student_firstname, 
				'student_othernames'=> $student_othernames, 
				'student_phone'		=> $student_phone, 
				'student_email'		=> $student_email, 
				'student_dob'		=> $student_dob, 
				'student_address'	=> $student_address, 
				'student_gender'	=> $student_gender,
				'student_course'	=> $student_course, 
				'student_password'	=> $student_password,
				'student_comment'	=> $student_comment,
				);

	$where = array('student_matric'	=> $student_matric);

	if ($db->update('tbl_student_admin',$data,$where)) {
		move_uploaded_file($_FILES['image']['tmp_name'], $path);
		echo "success"; 
	}
}
