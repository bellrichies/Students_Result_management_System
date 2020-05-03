<?php
$rows=$db->selectAll('tbl_admin_class');
?>
<div class="bg_form">
<form id="promotion" method="post" class="no_margin">
	<div class="row">
		<div class="col-md-4">
			<select name="classfrom" id="classfrom" class="form-control">
				<option value="">Select Class Promoting</option>
				<?php
				foreach ($rows as $cl) {
					$id   = $cl['id'];
					$from = $cl['class'];
					echo "<option value='{$id}'>{$from}</option>";
				}
					
				?>
			</select>
		</div>
		<div class="col-md-4">
			<select name="classto" id="classto" class="form-control">
				<option value="">Select class promoting to</option>
				<?php
				foreach ($rows as $cl) {
					$id   = $cl['id'];
					$from = $cl['class'];
					echo "<option value='{$id}'>{$from}</option>";
				}
				?>				
			</select>
		</div>
		<div class="col-md-4">
			<button class="btn btn-sm btn-primary" id="btn-promotion" style="float:right">Promote Now</button>
		</div>
	</div>	
</form>
</div>
<script>
	$('#classfrom').change(function(e){
		e.preventDefault();
		var id   = $('#classfrom').val();
		if (id>=1) {
			$.ajax({
	            url:"app_model/promotion.php",
	            method:"POST",
	            data:{id:id},
	            success:function(data){
	              $('.contents').html(data);
	            }
	        });	
		}  
    });
</script>