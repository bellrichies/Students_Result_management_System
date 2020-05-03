<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/portal/app_dbase/connection.php");
$db = new Databases;

if (isset($_POST['studentID'])) {
	$where =array('id'=>$studentID = $_POST['studentID'],);
	if ($results=$db->selectWhere('tbl_student_applications',$where)) {
		$image = "images/profile/" . $results[0]['picture'] ;
		$firstname = $results[0]['firstname'];
		$surname   = $results[0]['surname'];
		$othername = $results[0]['othernames'];
		$gender    = $results[0]['gender'];
		$dob       = $results[0]['dob'];
		$email     = $results[0]['email'];
		$address   = $results[0]['address'];
		$pin 	   = $results[0]['form_pin'];
		$mobile    = $results[0]['mobile'];
	}
}
?>
<div class="row">
	<div class="col-md-3">
		<img src="<?php echo $image ;?>" style="width: 100px;">
	</div>
	<div class="col-md-9">
		<table class="table table-condensed table-bordered ">
			<tbody>
				<tr>
					<td colspan="3" style="font-size: 24px; font-weight: 600">
						<?php echo $firstname. " " . $surname. " ".$othername."" ;?>		
					</td>
				</tr>
				<tr>
					<td  class="text-left"><label>D.O.B</label><br><?php echo $dob;?></td>
					<td  class="text-left"><label>Email</label><br><?php echo $email;?></td>
					<td  class="text-left"><label>Gender</label><br><?php echo $gender; ?></td>
				</tr>
				<tr>
					<td  class="text-left" colspan="3"><label>Contact Address</label><br><?php echo $address; ?></td>
				</tr>
				<tr>
					<td class="text-left"><label>Mobile No.</label><br><?php echo $mobile; ?></td>
					<td class="text-left" colspan="2"><label><br>Form Pin</label><br><?php echo $pin; ?></td>
				</tr>

			</tbody>
		</table>
	</div>
</div>
	
