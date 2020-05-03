<div class="bg_form no_margin" >
  <form id="scoresheetform" method="post" class="no_margin">
  	<div class='row no_margin'>
  		<div class="col-md-3">
  			<select name="level" id="classlist" class="form-control">
  				<option value="">Select Class</option>
  				<?php 
  					$classes=$db->selectAll('tbl_admin_class');
  					$x=1;
  					$y=count($classes);
  					foreach ($classes as $class) {
  						if ($x<$y) {
  							echo "<option value='".$class['id']."'>".$class['class']."</option>";
  							$x++;
  						}
  						
  					}
  				?>
  			</select>
  		</div>
  		<div class="col-md-3 ">
  			<select name="semester" id="semesterlist" class="form-control">
  				<option value="1">1st Semester</option>
  				<option value="2">2nd Semester</option>
  			</select>	
  		</div>	
  		<div class="col-md-3">
  			<select name="subjet" id="subjectlist" class="form-control">
  				<option value="">Select Subject</option>	
  			</select>
  		</div>
      <div class="col-md-3" style="margin:0; padding:0;">
        <span class="btn btn-sm btn-primary" id="loadform"><i class="fas fa-loading"></i>Load</span>
        
        <span class="btn btn-sm btn-primary" id="export_scoresheet_excel"><i class="fas fa-loading"></i>Excel</span>
        
      </div>
  	</div>
  </form>	
</div>

<script>
 $('#classlist').change(function(){
    var level = $(this).val();
    var semester = $('#semesterlist').val();
    $.ajax({
      url:"app_model/loadsubject.php",
      method:"POST",
      data:{level:level,semester:semester},
      success:function(data){
        $('#subjectlist').html(data);
      }
    });  
  });
$('#semesterlist').change(function(){
    var semester = $(this).val();
    var level= $('#classlist').val();
    $.ajax({
      url:"app_model/loadsubject.php",
      method:"POST",
      data:{level:level,semester:semester},
      success:function(data){
        $('#subjectlist').html(data);
      }
    });  
  });

$('#loadform').on('click',function(event){
      event.preventDefault();
      var level = $('#classlist').val();
      var semester = $('#semesterlist').val();
      var subjet  = $('#subjectlist').val();
      if (level == "" || semester == "" || subjet == "") {
        alert("All fields are required, try again!");
      }else {
        $.ajax({
          url:"app_model/scoresheet.php",
          method:"POST",
          data:{level:level,semester:semester,subjet:subjet},
          success:function(data){
            $(".contents").html(data);
          }
        });  
      }
  });

$(document).on('click','#export_scoresheet_excel', function(){
      var class_id      = $("#classlist").val();
      var class_name    = $("#classlist option:selected").html();
      var semester_name = $("#semesterlist").val();
      var subject_name  = $("#subjectlist").val(); 

    if (class_id === undefined || class_id  === "" || subject_name =="" ||subject_name===undefined ) {
      alert ("One or more fields are empty!");
      return false;
    }else {
        $.ajax({
          url:"app_model/export_scoresheet.php",
          method: "POST",
          data:{class_id:class_id,class_name:class_name, semester_name:semester_name, subject_name:subject_name},
          success:function(x){
            // /$(".contents").html(x);
          }
        })      

    }      
  });
</script>