<?php
require_once(__DIR__ . "../../app_dbase/connection.php");
$db = new Databases;

if ($_POST['id']) {

	$id    = $_POST['id'];
	$key   = $_POST['column_name'];
	$value = $_POST['text'];

	$fields = array($key=> $value,);
	$where  = array('id'=> $id,);
	$tbl_name = 'tbl_admin_account';

	$success=$db->update($tbl_name, $fields, $where);
	echo "success";
}
?>