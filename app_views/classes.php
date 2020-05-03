<div class="bg_form">
	<form method="POST" id="formAddClass" class="no_margin">
		<div class="row">
			<div class="col-md-3">
				<select name="program" id="program" class="form-control">
					<option value="Certificate">Certificate</option>
					<option value="Diploma">Diploma</option>
					<option value="Bachelor">Bachelor</option>
				</select>
			</div>
			<div class="col-md-3">
				<input type="text" name="classname" class="form-control" placeholder="Class Name">
				<input type="hidden" name="action" value="addclass">
			</div>
			<div class="col-md-3">
				<input type="text" name="classRank" class="form-control" placeholder="Rank Class">
			</div>
			<div class="col-md-3"><input type="submit" value="Add Class" class="btn btn-sm btn-primary"></div>	
		</div>
	</form>
</div>

<script>
	$(document).ready(function(){
		value = $("#program").val();
		$.ajax({
			url:"app_model/classes.php",
			method:"POST",
			data:{value:value},
			success:function(data){
				$(".contents").html(data);
			}
		})
	})

	$('#program').on('change',function(e){
		value = $("#program").val();
		$.ajax({
			url:"app_model/classes.php",
			method:"POST",
			data:{value:value},
			success:function(data){
				$(".contents").html(data);
			}
		})
	})

	$("#formAddClass").on("submit",function(e){
		e.preventDefault();
		$.ajax({
			url:"app_model/academic.php",
			method:"POST",
			data: new FormData(this),
			contentType:false,
			processData:false,
			success:function(data) {
				if (data=="success") {

					value = $("#program").val();
					$.ajax({
						url:"app_model/classes.php",
						method:"POST",
						data:{value:value},
						success:function(data){
							$(".contents").html(data);
						}
					})

					Swal.fire(
						'Added',
						data,
						'Subject added successfully!'
					)
				}else{
					Swal.fire(
						'Error',
						'Impossible to add class now!',
						'danger'
					)
				}
			}
		})

			})
</script>