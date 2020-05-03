<form method='POST' id='frmDeffer' class="no_margin">
    <div class="row no_margin">
      <div class='col-4'>
        <input type='text' name='query_matric' id='query_matric' placeholder='Student Matric Number' class='form-control'>
      </div>
      <div class="col-4">
        <input type='hidden' name='action' value='deffer_admission'>
        <input type='submit' value='Find Student' class="btn btn-sm btn-primary">
      </div>
    </div>
</form>

<script>
	$(document).on('submit','#frmDeffer', function(e){
      e.preventDefault();
      $.ajax({
          url:"app_model/deffer.php",
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
