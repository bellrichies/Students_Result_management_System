<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/portal/app_dbase/connection.php");
$db = new Databases;

$output = '<div id="payment-data" class="table table-responsive">
<table  class="table table-condensed table-bordered">
	<thead>
		<tr class=" bg-primary text-white">
			<th>Date</th>
			<th>Bank</th>
			<th>Receipt #</th>
			<th>Payment Due</th>
			<th>Amount Paid</th>
			<th>Outstanding</th>
			<th>Session</th>
			<th></th>
		</tr>
		<tr>
			<th colspan="8" style="font-weight:600">Total Outstanding Balance: <span id="outstanding" class="text-primary"></span></th>
		</tr>
	</thead>
	<tbody>
		
		<tr>
			<td><input type="text" class="cell datetimepicker" id="celldat-0" placeholder="yyyy-mm-dd"></td>
			<td><input type="text" class="cell" id="cellban-0" placeholder="bank name" ></td>
			<td><input type="text" class="cell" id="cellrec-0" placeholder="receipt no." ></td>
			<td><input type="text" class="cell" id="celldue-0" placeholder="99999.00" ></td>
			<td><input type="text" class="cell" id="cellpay-0" placeholder="99999.00"></td>
			<td><input type="text" value="₦0.00" class="cell" id="cellbal-0" disabled></td>
			<td><input type="text" class="cell" id="cellses-0" placeholder="yyyy/yyyy" ></td>
			<td><span id="btn_add" class="text-success"><i class="fas fa-plus"></i></span></td>
		</tr>';

if (isset($_POST['value'])) {
	$total_balance = 0;
	$total_due = 0;
	$total_pay = 0;
	$color=0;
	$colorbg ="#fff";
	$where =array('student_id'=>$_POST['value'],);
	if ($table_rows = $db->selectWhere('tbl_admin_account',$where,"payment_date","DESC")) {
		foreach ($table_rows as $row) {
			$color++;
			$total_due += $row['payment_due'];
			$total_pay += $row['payment_amount'];

			$balance = $row['payment_due'] - $row['payment_amount'];
			if ($color % 2 == 1) {
				$colorbg = "#EBD3EF";
			}else{
				$colorbg = "#fff";
			}
			$output .= '<tr style="background:'.$colorbg.'">
				<td><input type="text" name="" value="'.$row['payment_date'].'"    class="cell" id="celldat-'.$row['id'].'" data-name="payment_date"></td>
				<td><input type="text" name="" value="'.$row['payment_bank'].'"    class="cell" id="cellban-'.$row['id'].'" data-name="payment_bank"></td>
				<td><input type="text" name="" value="'.$row['payment_receipt'].'" class="cell" id="cellrec-'.$row['id'].'" data-name="payment_receipt"></td>
				<td><input type="text" name="" value="'.$row['payment_due'].'"     class="cell" id="celldue-'.$row['id'].'" data-name="payment_due" ></td>
				<td><input type="text" name="" value="'.$row['payment_amount'].'"  class="cell" id="cellpay-'.$row['id'].'" data-name="payment_amount"></td>
				<td><input type="text" name="" value="₦'.number_format($balance,2).'"                class="cell" id="cellbal-'.$row['id'].'" disabled></td>
				<td><input type="text" name="" value="'.$row['payment_session'].'" class="cell" id="cellses-'.$row['id'].'" data-name="payment_session"></td>
				<td><span class="text-danger" id="btn_delete" data-id7="'.$row['id'].'"><i class="fas fa-times"></i></span></td>
			</tr>
			';
		}
		$output .= '</tbody></table>';
	}
}

$total_balance = $total_due - $total_pay;
echo $output;
?>

<span id="temp-balance" style="display: none;"><?php echo $total_balance; ?></span>


</div>