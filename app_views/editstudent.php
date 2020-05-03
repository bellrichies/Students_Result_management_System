<form method='POST' id='frmMatric' class="no_margin">
	<div class="row">
		<div class="col-md-4">
			<input type='text' name='query_matric' id='query_matric' placeholder='Enter Student Matric Number' class='form-control'>
		</div>
		<div class="col-md-4">
			<input type='hidden' name='action' value='update_student_record'>
			<input type='submit' value='Find Student' class="btn btn-sm btn-primary">
		</div>
	</div>
</form>

<script>
	$(document).on('submit','#frmMatric', function(e){
      e.preventDefault();
      $.ajax({
          url:"app_model/editstudent.php",
          method:"POST",
          data: new FormData(this),
          contentType:false,
          processData:false,
          success:function(data){
            $('.contents').html(data);
          }
      });
    });

</script>

