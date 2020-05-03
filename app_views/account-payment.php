<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/portal/app_dbase/connection.php");
$db = new Databases;
?>

<form id="formFindStudent" class="form">
	<div class="row" style="background-color: #fbfbfb">
		<div class="col-md-3" >
			<input type="text" name="matric" id="matric" placeholder="Enter matric number" class="form-control">
		</div>
		<div class="col-md-3" >
			<select class="form-control">
				<option>All Payments</option>
				<?php 
				
				?>
			</select>
		</div>
		<div class="col-1">
			<input type="submit" value="Load" class="btn btn-primary btn-sm">
		</div>
		<div class="col-md-2">
			<a href="#" class="btn btn-link btn-primary settings" ><i class="fas fa-cog"></i> Settings</a>
		</div>
	</div>
</form>

<div id="history"></div>

<script>
	$(document).ready(function(){

		$("form").on("submit",function(e){
			e.preventDefault();
			let value = $("#matric").val();

			if (!value) {
				//flag error
				return false;
			}

			$.ajax({
				url:"app_model/paymenthistory.php",
				method:"POST",
				data:{value:value},
				success:function(data){
					$("#history").html(data);
				}
			});
		});
		$(".settings").on('click',function(){
	        alert("settings");
		});
	});
</script>