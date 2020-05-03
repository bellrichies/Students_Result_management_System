<?php
require_once(__DIR__ . "../../app_dbase/connection.php");
$db = new Databases;

if ($_POST['id']) {

	$id = $_POST['id'];
	$where = array('id'=> $id,);
	$table = 'tbl_admin_account';

	if ($success=$db->delete($table, $where)) {
		echo "success";
	}
}
?>