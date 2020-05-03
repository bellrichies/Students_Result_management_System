<div class="bg_form">
	<form id="frmCourse" method="POST" class="no_margin">
		<div class="row">	
			<div class="col-md-2">
				<select class="form-control" id="class_index" name="class_index" style="font-size: 12px;">
					<?php 
					$rows=$db->selectAll('tbl_admin_class');
					foreach ($rows as $row) {
					  	$label = strtoupper($row['class']);
			            if ($label=="GRANDUAT") {
			              
			            }else{
			              echo "<option value='".$row['id']."'>".$label."</option>";
			            }
					} ?>
				</select>
			</div>
			<div class="col-md-2">
				<select class="form-control" name="semester_index" id="semester_index" style="font-size: 12px;">
				  <option value="1">1st SEMESTER</option>
				  <option value="2">2nd SEMESTER</option>
				</select>
			</div>
			<div class="col-md-2">
				<input type="text" class="form-control" name="course_title"  id="course_title" autocomplete="off" placeholder="Title" align="center">
			</div>
			<div class="col-md-1">
				<input type="text" class="form-control" name="course_code"   id="course_code"  autocomplete="off" placeholder="Code">
			</div>
		
			<div class="col-md-1">
				<input type="text" class="form-control" name="course_unit"   id="course_unit"   placeholder="Unit">
			</div>
			<div class="col-md-1">
				<input type="text" class="form-control" name="course_status" id="course_status" placeholder="Status">
			</div>
			<div class="col-md-2">
				<input type="hidden" name="action" value="addsubject">
				<input type="submit" value="Add" class="btn btn-sm btn-block btn-primary">
			</div>
		</div>
	</form>
</div>
<script>
	$(document).ready(function(){
		class_index    = $("#class_index").val();
		semester_index = $("#semester_index").val();
		$.ajax({
          url:"app_model/subjects.php",
          method:"POST",
          data: {class_index:class_index,semester_index:semester_index},
          success:function(data) {
            $(".contents").html(data)
          }
        });
	})

	$("#frmCourse").on("submit",function(e){
		e.preventDefault();
		$.ajax({
			url:"app_model/academic.php",
			method:"POST",
			data: new FormData(this),
			contentType:false,
			processData:false,
			success:function(data) {
				if (data=="success") {
					class_index    = $("#class_index").val();
					semester_index = $("#semester_index").val();
					$.ajax({
						url:"app_model/subjects.php",
						method:"POST",
						data: {class_index:class_index,semester_index:semester_index},
						success:function(data) {
						  $(".contents").html(data)
						}
					});
					Swal.fire(
						'Added',
						'Subject added successfully!',
						'success'
					)
				}else{
					Swal.fire(
						'Error',
						'Please fill all required fields...',
						'error'
					)
				}
			}
		})


	})

	$("#class_index").on("change",function(e){
		class_index    = $("#class_index").val();
		semester_index = $("#semester_index").val();
		$.ajax({
          url:"app_model/subjects.php",
          method:"POST",
          data: {class_index:class_index,semester_index:semester_index},
          success:function(data) {
            $(".contents").html(data)
          }
        });
	})
	$("#semester_index").on("change",function(e){
		class_index    = $("#class_index").val();
		semester_index = $("#semester_index").val();
		$.ajax({
          url:"app_model/subjects.php",
          method:"POST",
          data: {class_index:class_index,semester_index:semester_index},
          success:function(data) {
            $(".contents").html(data)
          }
        });
	})
</script>