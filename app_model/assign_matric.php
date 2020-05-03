<?php
require_once(__DIR__ . "../../app_dbase/connection.php");
$db = new Databases;

$id = $_POST['id'];
$name = $_POST['name'];
$matric = $_POST['matric'];

$fields = array("status" => $matric,);
$where  = array('id' => $id,);

if ($rows=$db->update("tbl_student_applications", $fields, $where)) {
	echo $matric ." successfully assigned " . $name ."<br>";
}
// ?>