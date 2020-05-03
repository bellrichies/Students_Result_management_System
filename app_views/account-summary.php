<div class="bg_form">
<form id="form_account_summary" class="form" style="margin:0;">
	<div class="row">
		<div class="col-md-3" >
			<select id="select_class" class="form-control vertical_align">
				<option value="-1" >SELECT CLASS</option>
				<?php 
				$results = $db->selectAll('tbl_admin_class');
				foreach ($results as $result) {
					$course = strtoupper($result['class']);
					if ($course == "GRANDUAT") {
						# code...
					}else {
						echo "<option value='".$result['id']."'>{$course}</option>";
					}
				}
				
				?>
			</select>
		</div>
		<div class="col-md-3">
			<input type="text" id="period" name="period" placeholder="2020/2021" class="form-control vertical_align ">
		</div>
		<div class="col-md-3">
			<input type="submit" value="Summarise" class="btn btn-primary btn-block">
		</div>
		<div class="col-md-3">
			<a href="#" class="btn btn-link btn-primary settings vertical_align no_margin"><i class="fas fa-cog"></i> Settings</a>
		</div>
	</div>
</form>
</div>

<script>
	$(document).ready(function(){
		$("#form_account_summary").on("submit",function(e){
			e.preventDefault();
			var option = $("#select_class").val();
			var period = $("#period").val();

			if (option =="-1" || period == "") {
				alert("undefined");
				return false;
			}


			$.ajax({
				url:"app_model/account_summary.php",
				method:"POST",
				data:{option:option, period:period},
				success:function(data){
					$(".contents").html(data);
				}
			});

		});
	})
</script>