<?php
require_once(__DIR__ . "../../app_dbase/connection.php");
$db = new Databases;

if (isset($_POST['score'])) {
	$total = $_POST['score'];
	$grades = $db->selectAll('tbl_admin_grades');
	foreach ($grades as $grade) {
	  $start = $grade["score_start"];
	  $stop  = $grade["score_end"];
	  $point = $grade["point"];
	  if ($total >= $start && $total<= $stop) {
	    $remark = $grade["grade"];
	  }
	} 
	echo $remark;	
}
