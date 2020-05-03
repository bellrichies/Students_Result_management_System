<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/portal/app_dbase/connection.php");
$db = new Databases;
?>
	<table id="dt-basic-checkbox" class="table table-striped table-condensed text-dark" style="font-family: Helvetica;">
	<?php 
		$value = $_POST['value'];
		$where = array('course'=>$value,'status'=>'pending');
		if ($freshers = $db->selectWhere('tbl_student_applications', $where)) {
			foreach ($freshers as $fresher) {
				$id = $fresher['id'];
				$student = strtoupper($fresher['surname']. " ". $fresher['othernames']." ". $fresher['firstname']);
				$form_no = $fresher['form_pin'];
				$picture = $fresher['picture'];
				if ($picture=='') {
					$picture =  "images/profile/noimage.jpg";
				}else {
					$picture =  "images/profile/" . $picture ;
				}
				?>

				<tr>
					<td style="padding: 0; font-size:11px; " class="valign" width="32">
						<img src="<?php echo $picture; ?>" class="img-responsive" style="width:32px">
					</td>
					<td class="text-left " style="line-height: 32px; font-size:11px; ">
							&nbsp; &nbsp;<span id="student-<?php echo $id; ?>" class="cmd"><?php echo $student; ?></span>
					</td>
					<td class="text-left" style="line-height: 32px; font-size:11px; ">
						&nbsp; &nbsp;<?php echo $form_no; ?>
					</td>
					<td style="line-height: 32px; font-size:12px; ">
						<a href="#" id="admit-<?php echo $id; ?>" class="cmd btn btn-sm btn-success">
							admit</a>
					</td>
					<td class="text-center"  style="line-height: 32px; font-size:11px;">
						<a href="#" id="view-<?php echo $id;?>" class="cmd btn btn-sm btn-primary">view detail
						</a>
					</td>
				</tr>
				<?php
			}
		}else {
			echo "<strong class='text-danger'>No Record found...</strong>";
		}
	?>	
	</table>

<div class="modal fade" id="showdata" tabindex="-1" role="dialog" aria-labelledby="showdata" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Applicant Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="detail">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
	$('.cmd').on('click',function(e){
		var value = $(this).attr("id");
		var explode = value.split("-");
		var studentID = explode[1];
		var action = explode[0];
		if (action=="view") {
			$.ajax({
				url:"app_model/student_detail.php",
				method:"POST",
				data:{studentID:studentID},
				befoerSend:function(){

				},
				success:function(data){
		          $("#detail").html(data);
		          $('#showdata').modal("show");
				}
			})
		}else{
			$.ajax({
		        url:"app_model/academic.php",
		        method:"POST",
		        data:{studentID:studentID,action:"admit"},
		        success:function(data){
					if (data=="success"){
						$.ajax({
				          url:"app_model/admission.php",
				          method:"POST",
				          data:{value:$("#choice").val()},
				          success:function(data){
				            $('#function').html(data);
				            Swal.fire(
								$("#choice").attr('id'),
								'Student Successfully admitted...',
								'success'
							)
				          }
				        });
					}else{
						Swal.fire(
							data ,
							'Not admitted ...',
							'error'
						)
					}
		        }
	      	});
		}
	});

	$(document).on('click',".student_name",function(e){
      e.preventDefault();
      var value = $(this).attr("id");
      alert(value);
      $.ajax({
        url:"app_model/admission_student.php",
        method:"POST",
        data:{value:value},
        success:function(data){
          $('#selectedFresher').html(data);
        }
      });
    });

    $(document).on('click',"#admitbtn",function(e){
	      e.preventDefault();
	      var value = $(".fresher").attr("id");
	      $.ajax({
		        url:"app_model/admit_student.php",
		        method:"POST",
		        data:{value:value},
		        success:function(data){
		          if (data=="success"){
			        alert("Yes, the student has been admitted!");
			      }else{
			      	alert("error!");
			      }
		        }
	      });
    });

</script>