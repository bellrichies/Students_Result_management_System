<?php
require_once(__DIR__ . "../../app_dbase/connection.php");
$db = new Databases;

if (isset($_SESSION['loggedin'])) {
	header("Location: dashboard.php");
}else{
	$report ="";
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if (!empty($_POST['form_email']) && !empty($_POST['form_password'])) {
			$where = array('email' => $_POST['form_email'],'password' => md5($_POST['form_password']),);
			try {
				$admin = $db->selectWhere("tbl_admin",$where);
				if ($admin) {
					if (!isset($_SESSION['loggedin'])) {
						session_start();
						$_SESSION['loggedin'] = $_POST['form_email'];
						$report = "success";
					}
					
				}else { $report = "error"; }
			} catch (Exception $e) { $report = "error"; }
		}else {
		 $report = "error"; }
	}
	echo $report;
}



