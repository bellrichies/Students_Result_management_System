<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/portal/app_dbase/connection.php");
$db = new Databases;
if ($rows=$db->selectWhere("tbl_student_applications", array("status"=>$_POST['value'],))) {
	
	foreach ($rows as $row) {

		$surname  = $row['surname'];
		$firstname = $row['firstname'];
		$othernames= $row['othernames'];
		echo $_POST['value'] ." already assigned to " . $surname ." ". $firstname ." ".$othernames."<br>";
	}
}else{
	echo "available";
}
?>