<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/portal/app_dbase/connection.php");
$db = new Databases;

if (isset($_POST['action'])) {
	$matric = htmlentities(stripslashes($_POST['query_matric']));
	$where = array('student_matric'=>$matric);
	if ($result = $db->selectWhere('tbl_student_admin',$where)) {
		$profile_image      = $result[0]['student_image'];
		$student_surname    = $result[0]['student_surname'];
		$student_firstname  = $result[0]['student_firstname'];
		$student_othernames = $result[0]['student_othernames'];
		$student_gender  	= $result[0]['student_gender'];
		$student_email      = $result[0]['student_email'];
		$student_dob  		= $result[0]['student_dob'];
		$student_password 	= $result[0]['student_password'];
		$student_course 	= $result[0]['student_course'];
		$student_matric 	= $result[0]['student_matric'];
		$student_address 	= $result[0]['student_address'];
		$student_phone 		= $result[0]['student_phone'];
		$student_comment	= $result[0]['student_comment'];
	?>
	<p><br></p>
	<form method='POST' id='frmUpdateRecord'>
		<div class="card">
			<div class="card-header card-header-primary text-center" style="font-size: 24px; font-weight: 600"><?php echo $student_matric; ?></div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-3">
						<input type="hidden" name="matric" value = "<?php echo $student_matric ?>">
						<input type="hidden" name="oldImage" value ="<?php echo $profile_image; ?>">
						<img id="pix" src="images/profile/<?php echo $profile_image; ?>" style="width: 150px;">
						<label for="profile_image" style="display: inline-block;"><i class="fa fa-edit"></i>change</label>
						<input type="file" name="image" id="profile_image" class="form-control inputFileHidden" style="display:none">
					</div>
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-4">
								<input type="text" name="surname"    value="<?php echo $student_surname; ?>"    class='form-control'>
							</div>
							<div class="col-md-4">
								<input type="text" name="firstname"  value="<?php echo $student_firstname; ?>"  class='form-control'>
							</div>
							<div class="col-md-4">
								<input type="text" name="middlename" value="<?php echo $student_othernames; ?>" class='form-control'>
							</div>
							<div class="col-md-4">
								<input type="text" name="mobile" value="<?php echo $student_phone; ?>" class='form-control'>
							</div>
							<div class="col-md-4">
								<input type="text" name="email" value="<?php echo $student_email; ?>" class="form-control">
							</div>
							<div class="col-md-4">
								<input type="text" name="datebirth" value="<?php echo $student_dob;?>" class="form-control datetimepicker">
							</div>
							<div class="col-12">
								<textarea rows ='2' class='form-control' name='address'><?php echo $student_address; ?></textarea>
							</div>
							<div class="col-md-4">
								<select class='form-control' name='gender' >
									<option value="<?php echo $student_gender; ?>"><?php echo $student_gender; ?></option>
									<option value='Male'>Male</option>
									<option value='Female'>Female</option>
								</select>
							</div>
							<div class="col-md-4">
								<select class="form-control" name="course">
									<option value="<?php $student_course; ?>"><?php echo $student_course; ?></option>
									<option value="Certificate">Certificate</option>
									<option value="Diploma">Diploma</option>
									<option value="Bachelor">Bachelor</option>
								</select>
							</div>
							<div class="col-md-4">
								<input type="hidden" name="oldPass" value="<?php echo $student_password; ?>">
								<input type="hidden" name="oldComment" value="<?php echo $student_comment;?>">
								<input type="password" name="password"  class="form-control" placeholder="Password">
							</div>
							<div class="col-md-4">
								<input type="hidden" name="action" value='save_update_record'>
								<input type="submit" value="Update" class='btn btn-sm btn-primary pull-right'>
							</div>

						</div>
					</div>	
				</div>
				
			</div>
		</div>
	</form>
	<?php
	}
}
?>
<script>
	$(document).on('submit','#frmUpdateRecord', function(e){
	    e.preventDefault();
	    $.ajax({
	        url:"app_model/savestudentinfo.php",
	        method:"POST",
	        data: new FormData(this),
	        contentType:false,
	        processData:false,
	        success:function(data){
	          if (data=="success") {
	          	Swal.fire({
				  icon: 'success',
				  title: 'Updated...',
				  text: 'Data successfully saved!',
				  footer: '<a href="#">Why do I have this issue?</a>'
				})
	          }

	          if (data=="invalid format") {
	          	Swal.fire({
				  icon: 'error',
				  title: 'Invalid file',
				  text: 'You have supplied invalid file!',
				  footer: '<a href="#">Why do I have this issue?</a>'
				})
	          }

	          if (data =="error") {
	          	Swal.fire({
				  icon: 'error',
				  title: 'Oops...',
				  text: 'Something went wrong!',
				  footer: '<a href="#">Why do I have this issue?</a>'
				})
	          }
	        }
	    });
	  });
	$(document).on('change','#profile_image', function(e){
        e.preventDefault();
        var filePath = URL.createObjectURL(e.target.files[0]);
        var fileName = e.target.files[0].name;
        $("#pix").attr('src',filePath);
        if (fileName == "") {
          alert('Please upload your profile picture');
          return false;
        }
      });
</script>