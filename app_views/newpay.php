<div class="bg_form">
	<form id="formFindStudent" class="form" style="margin:0;" >
		<div class="row" style="margin: 0;">
			<div class="col-md-4">
				<input type="text" name="matric" placeholder="Student Matric No." id="matric" class="vertical_align form-control" autocomplete="off">
			</div>
			<div class="col-md-4">
				<input type="submit" value="Get History" class="btn btn-primary btn-block">
			</div>
			<div class="col-md-4">
				<a href="#" class="btn btn-link btn-primary settings"><i class="fas fa-cog"></i> Settings</a>
			</div>
		</div>
	</form>
</div>

<script>
	$(document).ready(function(){

		
		function fetchHistory(){

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
					$(".contents").html(data);
				}
			});
		}

		$("form").on("submit",function(e){
			e.preventDefault();
			fetchHistory();
		});
		

		$(".settings").on('click',function(){
	        alert("settings");
	    })

	    
	})
</script>