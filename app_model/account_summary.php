<?php
require_once(__DIR__ . "../../app_dbase/connection.php");
$db = new Databases;

if (isset($_POST['option'])) {
	
	$option = $_POST['option'];
	$period = $_POST['period'];

	$output ="";
	$where = array("student_level"=>$option);
	if ($rows = $db->selectWhere("tbl_student_admin", $where, "student_matric")) {
		$output .="<table class='table table-condensed table-bordered table-striped'>
			<thead>
				<tr class='bg-primary text-white'>
					<th>SN</th>
					<th>Matric No.</th>
					<th>Student Name</th>
					<th>Total Payment</th>
					<th>Payment Due</th>
					<th>Balance</th>
				</tr>
			</thead>
			<tbody>";
		$sn =0;
		foreach ($rows as $row) {
			$sn++;
			$student_id = strtoupper($row['student_matric']);
			$student_name = strtoupper($row['student_surname']." ". $row['student_firstname']." ".$row['student_othernames']);
			$where = array("student_id"=>$student_id, "payment_session"=>$period,);
			if ($rows=$db->selectWhere("tbl_admin_account", $where)) {
				$total_payment=0;
				foreach ($rows as $row) {
					$total_payment += $row['payment_amount'];
					$due_payment = $row['payment_due'];
				}
				$balance = number_format($due_payment - $total_payment,2);
				$total_payment = number_format($total_payment,2);
				$due_payment = number_format($due_payment,2);
				$output .= "<tr>
							<td>{$sn}</td>
							<td>{$student_id}</td>
							<td class='text-left'>{$student_name}</td>
							<td class='text-right'>{$total_payment}</td>
							<td class='text-right'>{$due_payment}</td>
							<td class='text-right'>{$balance}</td></tr>";
			}		
		}
	}

	$output .="</tbody></table>";
	echo $output;
}