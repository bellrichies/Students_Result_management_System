<?php
require_once(__DIR__ . "../../app_dbase/connection.php");
$db = new Databases;
if (isset($_POST['class_index'])) {
  $class_index    = $_POST['class_index'];
  $semester_index = $_POST['semester_index'];
  $where = array("class_id"=>$class_index,"semester_id"=>$semester_index);
  $rows = $db->selectWhere("tbl_admin_subject", $where,"subject_title");
  $seria_no =0;
}
?>
<!--<div class="col-12">
  <div class="card">
    <div class="card-body autoscroll"> -->
        <table id="dataTable" class='table table-striped table-bordered table-condensed' style="font-size: 12px;">
        <thead>
          <tr class="bg-primary text-white">
            <th></th>
            <th class="text-left">Course Title</th>
            <th>Course Code</th>
            <th>Unit</th>
            <th>Status</th>
            <th>Action</th>
          </tr> 
        </thead>  
        <tbody>
          <?php
            foreach ($rows as $row) {
              $seria_no++;
              $subject_index = $row['id'];
              $cl = $row['class_id'];
              $title = $row['subject_title'];
              $code  = $row['subject_code'];
              $unit  = $row['subject_unit'];
              $status= $row['subject_status'];
              ?>
              <tr>
                <td width="30"><?php echo $seria_no; ?></td>
                <td class="text-left"><?php echo strtoupper($title);?></td>
                <td width="100"><?php echo strtoupper($code);?></td>
                <td width="100"><?php echo strtoupper($unit);?></td>
                <td width="100"><?php echo strtoupper($status);?></td>
                <td width="100"><i class="fas fa-times text-danger" id="trash-<?php echo $subject_index; ?>"></i></td>
              </tr>
            <?php    }   ?>
          </tbody>
      </table>
<!--    </div>
  </div>
       
</div> -->

<script>
  $(".fa-trash").on("click",function(){
    var xy = $(this).attr("id");
    var explode = xy.split("-");
    var action = explode[0];
    var index = explode[1];
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this, and may affect the record(s) on the database!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url:"app_model/academic.php",
          method:"POST",
          data:{action:action,index:index},
          success:function(data){
            if (data=="success") {
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                onOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })
              Toast.fire({
                icon: 'success',
                title: 'Deleted successfully'
              })
              class_index    = $("#class_index").val();
              semester_index = $("#semester_index").val();
              $.ajax({
                url:"app_model/subjects.php",
                method:"POST",
                data: {class_index:class_index,semester_index:semester_index},
                success:function(data) {
                  $("#function").html(data)
                }
              });
            }
          }
        })
      }
    })
  })
</script>