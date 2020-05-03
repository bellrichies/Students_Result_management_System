<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/portal/app_dbase/connection.php");
$db = new Databases;
?>
<p><br></p>
<div id="grade_table" class="table table-responsive">
	<form method="POST" id="frmForm">
		<input type="submit" value="Update" class="btn btn-sm btn-primary" >
				<table class="table table-condensed table-bordered">
			      <thead>
			        <tr class="bg-primary text-white">
			          <td>Score From</td>
			          <td>Score To</td>
			          <td>Point</td>
			          <td>Grade</td>
			          <td>GP From</td>
			          <td>GP To</td>
			          <td>Grade 1</td>
			          <td>Grade 2</td>
			        </tr> 
			      </thead>  
			      <tbody>
			      <?php $rows =$db->selectAll('tbl_admin_grades');
			      	$color=0;
					$colorbg ="#fff";
					foreach ($rows as $row) {
						$color++;
						$grId  = $row['id'];
						$from  = $row['score_start'] ;
						$to    = $row['score_end'];
						$point = $row['point'];
						$grade = $row['grade'];
						$gpfrm = $row['gp_from'];
						$gpto  = $row['gp_to'];
						$diplomaGrade = $row['remarks'];
						$degreeGrade= $row['remarks2'];
						if ($color % 2 > 0) {
							$colorbg = "#EBD3EF";
						}else{
							$colorbg = "#fff";
						}

						?>

						
					<tr style="background: <?php echo $colorbg; ?>">
					  <td><input type="hidden"  name="grId" value="<?php echo $grId;?>">
					  	  <input type="text"    name="scFro" value="<?php echo $from; ?>"></td>
					  <td><input type="text"    name="scTo" value="<?php echo $to; ?>"></td>
					  <td><input type="text"    name="scPoint" value="<?php echo $point; ?>"></td>
					  <td><input type="text"    name="scGrade" value="<?php echo $grade; ?>"></td>
					  <td><input type="text"    name="gpFro" value="<?php echo $gpfrm; ?>"></td>
					  <td><input type="text"     name="gpTo" value="<?php echo $gpto; ?>"></td>
					  <td><input type="text"    name="diplomaGrade" value="<?php echo $diplomaGrade; ?>"></td>
					  <td><input type="text" name="degreeGrade" value="<?php echo $degreeGrade; ?>"></td>
					</tr>
			            <?php
			          }
			        ?>
			      </tbody>
			    </table>		
			</div>
		</div>
	</form>
</div>
<script>
 	$('#frmForm').on('submit',function(event){
        event.preventDefault();
        var values = $(this).serializeArray();
	    $.ajax({
	        url:"app_model/grades.php",
	        method:"POST",
	        data:{values:values},
	        success:function(data){
	          if (data=="success") {
	          	const Toast = Swal.mixin({
				  toast: true,
				  position: 'top-end',
				  showConfirmButton: false,
				  timer: 5000,
				  timerProgressBar: true,
				  onOpen: (toast) => {
				    toast.addEventListener('mouseenter', Swal.stopTimer)
				    toast.addEventListener('mouseleave', Swal.resumeTimer)
				  }
				})
				Toast.fire({
				  icon: 'success',
				  title: 'Grades data update successfully!'
				})
	          }
	        }
	    });  
    });
 </script>