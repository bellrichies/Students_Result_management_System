<?php
	require_once(__DIR__ . "../../app_dbase/connection.php");
	require_once(__DIR__ . "../../app_function/function.php");
	$db = new Databases;
	
	$stud_class 		= $_POST['level'];
	$stud_semester	 	= $_POST['semester'];
	$stud_subject	    = $_POST['subjet'];

	//get class label
	$where = array('id'=>$stud_class);
	if ($rows = $db->selectWhere('tbl_admin_class',$where)) {
		$class_label = $rows[0]['class'];
	}

	//get subject label
	$where = array('id'=>$stud_subject);
	if ($rows = $db->selectWhere('tbl_admin_subject',$where,"subject_title")) {
		$subjet_label = $rows[0]['subject_title'];
	}

	if ($stud_semester == 1) {
		$heading = $class_label . " - 1st Semester - {$subjet_label}";
	}else{
		$heading = $class_label . " - 2nd Semester - {$subjet_label}";

	}


	switch ($stud_class) {
		case 1 :
		case 2 :
		$course = "Certificate";
		break;

		case 3:
		case 4:
		$course = "Diploma";
		break;

		default:
		$course = "Bachelor";
		break;
	}

	//fetch students belong to the same class
	$where = array("student_level"=>$stud_class ,"student_course"=>$course);
	$totalstudent = $db->selectWhere('tbl_student_admin',$where,"student_matric");
	$seria_no=0;
	?>

<form method='post' id='rsForm' style='font-size:12px;'>
	<div class="text-primary row" style="padding: 0 15px;">

		<div class="col-md-8" style="padding-right: 15px; font-weight: 700" >
			<?php echo $heading ?><br>Total Student: <?php echo count($totalstudent);?>
		</div>
		<div class="col-md-4">
			<button class="btn btn-sm btn-primary" id= "savesheet" style="float: right">Save</button>
		</div>
	</div>	
	<div class="table table-responsive" id="scoresheet_table">
		<table class='table table-condensed table-bordered'>
			<thead>
				<tr class="bg-primary text-white">
					<th></th>
					<th >Matric No.</th>
					<th class="text-left">Student Names</th>
					<th >CA Scores</th>
					<th >Exam Scores</th>
					<th >Total</th>
					<th>Grade</th>
				</tr>	
			</thead>	
			<tbody>
				<?php
				$color=0;
				$colorbg ="#fff";
				if ($rows = $db->selectWhere('tbl_student_admin',$where,"student_matric")) {
					foreach ($rows as $row) {
						$color++;
						$seria_no++;
						$id     = $row['id'];
						$matric = $row['student_matric'];
						$name   = $row['student_surname'].' '.$row['student_othernames'].' '.$row['student_firstname'];
						$where = array('student_id'=>$id,'semester_id'=>$stud_semester, 'class_id'=>$stud_class, 'subject_id'=>$stud_subject);
						if ($score=$db->selectWhere('tbl_student_result', $where)) {
							$ca   = $score[0]["ca_score"];
							$exam = $score[0]["exam_score"];
							$total= $ca+$exam;
						}else {
							$ca   = 0;
							$exam = 0;
							$total= 0;
						}

						if ($color % 2 > 0) {
							$colorbg = "#EBD3EF";
						}else{
							$colorbg = "#fff";
						}
						?>
						<tr style="background: <?php echo $colorbg; ?>"> 
							<td><?php echo $seria_no ?></td>
							<td><?php echo strtoupper($matric); ?></td>
							<td style="width: 100%;" class="text-left"><?php echo strtoupper($name);?></td>
							<td>
								<input type="text" name="ca_score[]" id="ca-<?php echo $id;?>" class="scores" value="<?php echo $ca;?>" style="width:80px;">
							</td>
							<td>
								<input type="text" name="ex_score[]" id="ex-<?php echo $id;?>" class="scores" value="<?php echo $exam;?>" style="width:80px;">
							</td>
							<td id="tot-<?php echo $id; ?>"><?php echo $total ?></td>
							<td id="grd-<?php echo $id; ?>"><?php echo get_grade($db, $total); ?></td>
						</tr>
						<input type = "hidden" name = "student_id[]"  value = "<?php echo $id ?>">	
						<input type = "hidden" name = "semester_id[]" value = "<?php echo $stud_semester ?>">
						<input type = "hidden" name = "class_id[]"    value = "<?php echo $stud_class ?>">
						<input type = "hidden" name = "subject_id[]"  value = "<?php echo $stud_subject ?>"> 
						<?php
					}
				}
				?>
			</tbody>
		</table>
	</div>		
</form>	
<script >
	$(document).ready(function(){
		$('#rsForm').on('submit',function(event){
	        event.preventDefault();
	        var form_data = $(this).serialize();
	        var total = $("#totalstudent").html();
	        $("#savesheet").addClass("hidden");
	        $.ajax({
	            url:"app_model/savesheet.php",
	            method:"POST",
	            data:form_data,
	            success:function(data){
	              if (data=="success") {
	              	$("#message").hide();
	              	$("#message").html('<span class="text-success" style="float:right;"> Successfully saved</span>');
	              	$("#message").show(1000);
	              	setTimeout(function(){ $("#message").hide('slow') }, 3000);
	              	$("#savesheet").removeClass("hidden");		
	              }else{
	              	$("#message").html('<span class="text-danger" style="float:right;">Error occur during record saving</span>');
	              	$("#savesheet").removeClass("hidden");	
	              }
	            }
	        });  
      	});

      	$(".scores").on("blur",function(){
      		var id = $(this).attr("id")
      		id = id.split("-");
      		id =id[1];

      		var ca_score = parseInt($("#ca-"+id).val());
      		var ex_score = parseInt($("#ex-"+id).val());
      		var tot_score= ca_score + ex_score;
      		$("#tot-"+id).text(tot_score);
      		$.ajax({
      			url:"app_model/grading.php",
      			method: "POST",
      			data:{score:tot_score},
      			success:function(data){
      				$("#grd-"+id).text(data);
      			}
      		})
      	});
      	
	});
</script>