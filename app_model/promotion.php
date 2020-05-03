<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/portal/app_dbase/connection.php");
$db = new Databases;
if (isset($_POST['id'])) {
	$id = $_POST['id'];
	$where = array('id'=>$id);
	if ($hd =$db->selectWhere('tbl_admin_class',$where)) {
		$heading = $hd[0]['class'];
	}
	$where = array('student_level'=>$_POST['id']);
	$rows = $db->selectWhere('tbl_student_admin',$where,"student_matric");
	if (!empty($rows)) {
		?>

		<strong class="text-primary"><?php echo "Promoting " .$heading; ?></strong>
		<form method="post" id="admission-form" style="font-size: 12px;">
			<table class='table table-striped table-bordered table-condensed' style="font-size: 12px;">
				<thead>
					<tr class="bg-primary text-white">
						<th width="7%" >
							<input type="checkbox" class="form-checkbox" name="selectAll" id="selectAll" style="margin-top: 3px;">
							<label for='selectAll' style="margin:0" class="text-white">Select All</label>
						</th>
						<th width="20%" class="text-left">Matric Number</th>
						<th width="40%" class="text-left">Student Name</th>
						<th width="" ></th>
					</tr>
				</thead>	
				<tbody>
				<?php
					foreach ($rows as $key => $row) {
						$matric =strtoupper($row['student_matric']);
						$fullname = strtoupper($row['student_surname']." ".$row['student_firstname']." ".$row['student_othernames']);
						$course = strtoupper($row['student_course']);
						if (!empty($fullname)) {
						?>
					
						<tr>
							<td><input type="checkbox" value="<?php echo $row['id']; ?>" class="studentIds"></td>
							<td class="text-left"><?php echo $matric;?></td>
							<td class="text-left"><?php echo $fullname;?></td>
							<td><?php echo $course;?></td>
						</tr>
						<?php
						}
					}
				?>
				</tbody>
			</table>
		</form>	
		<?php
	}else{
		echo "<span class='notice notice-warning'>Warning <i class='fas fa-exclamation'></i> No data in this class</span>";
	}
}

?>
<script>
    $(document).on('click',"#btn-promotion",function(e){ 
	  	e.preventDefault();

	    var from = $('#classfrom').val();
	    var to   = $('#classto').val();
	    var formData = $(this).serialize();

	    if (to == "") {
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
			  icon: 'warning',
			  title: 'You have not specify the class promoting to'
			})
	    }else{
	    	if (from > to || from == to ) {
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
				  icon: 'error',
				  title: 'Invalid parameters supplied, try again!'
				})
	    	}else {
	    		var studentIds = [];
	    		$('.studentIds').each(function(){
	    			
	    			if ($(this).is(":checked")) {
	    				studentIds.push($(this).val());
	    			}
	    		});
	    		//promote = promote.toString();

	    		$.ajax({
		            url:"app_model/promote.php",
		            method:"POST",
		            data:{classto:to, studentIds:studentIds},
		            success:function(data){
	            		var id = $("#classfrom").val();
					    $.ajax({
				            url:"app_model/load_promotion_list.php",
				            method:"POST",
				            data:{id:id},
				            success:function(data){
				              $(".contents").html(data);
				            }
				        });	

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
						  title: 'Students are successfully promoted!'
						})
		            }
		         });
	    	}
	    }
      
	});
	$("#selectAll").click(function(){
        $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
	});
</script>