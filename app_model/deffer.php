<?php 
require_once(__DIR__ . "../../app_dbase/connection.php");
$db = new Databases;
$student = strtoupper(htmlentities(stripslashes($_POST['query_matric'])));
$where = array('student_matric'=>$student);
if ($result = $db->selectWhere('tbl_student_admin',$where)) {
	$pix  = 'images/profile/'. $result[0]['student_image'];
	$name = $result[0]['student_surname'].' '. $result[0]['student_othernames'].' '.$result[0]['student_firstname'];
	$level = $result[0]['student_level'];
	$where =array('id'=> $level);
	if ($row=$db->selectWhere('tbl_admin_class',$where)) {
		$curClass = strtoupper($row[0]['class']);
	}?>
		<form method='POST' id='frmDifferProcess'>
			<div class="card">
				<div class="card-header text-center card-header-primary">
					<strong style="font-size: 30px; font-weight: 600; line-height: 30px;"><?php echo $name;?></strong>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-3">
							<img src="<?php echo $pix; ?>" style="width: 100px;">
						</div>
						<div class="col-sm-6" style="font-size: 18px; line-height: 24px"><br>
							Matric Number - <?php echo $student; ?> <br>
							Study Program - <?php echo $result[0]['student_course'];?><br>
							Current Class - <?php echo $curClass; ?>

						</div>
						<div class="col-md-3 text-center">
							<div style="padding: 15px 5px;margin-top: 15px;" class="bg-primary text-white">
								<p>Current CGPA</p>
								<span style="font-size: 38px; font-weight: 600">3.6</span>
							</div>
						</div>
						<p><br></p>
						<div class="col-md-6">
							<select class='form-control' name='newclass'>
								<option>Select new class for student</option>";
								<?php
									$x=0;
									if ($rows = $db->selectAll('tbl_admin_class')) {
										$y=count($rows)-1;
										foreach ($rows as $row) {
											$x++;
											if ($x<=$y) {
											  echo "<option value='{$row['id']}'>{$row['class']}</option>";
											}
										}
									}
								?>
							</select>
						</div>
						<div class="col-md-6">
							<input type='hidden' name='student' value='<?php echo $student; ?>'>
							<input type='hidden' name='action' value='Deffer Student Now'>
							<input type='submit' value='Differ Student Now' class='btn btn-sm btn-primary'>
						</div>
					</div>
				</div>
			</div>
		</form>
	<?php
}
?>

<script>
	$(document).on('submit','#frmDifferProcess', function(e){
        e.preventDefault();
        $.ajax({
            url:"app_model/deffer2.php",
            method:"POST",
            data: new FormData(this),
            contentType:false,
            processData:false,
            success:function(data){
              if (data=="success") {
              	const Toast = Swal.mixin({
	                toast: true,
	                position: 'top-end',
	                showConfirmButton: false,
	                timer: 3000,
	                timerProgressBar: true,
	                onOpen: (toast) => {
	                  toast.addEventListener('mouseenter', Swal.stopTimer)
	                  toast.addEventListener('mouseleave', Swal.resumeTimer)
	                }
	              })
	              Toast.fire({
	                icon: 'success',
	                title: 'Deleted successfully'
	              })
              }else{
              	Swal.fire({
				  icon: 'error',
				  title: 'Oops...',
				  text: 'You have not select a valid new class',
				  footer: '<a href="#">Why do I have this issue?</a>'
				})

              }
            }
        });
      });
</script>