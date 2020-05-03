<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/portal/app_dbase/connection.php");
$db = new Databases;
?>
  
<form method="POST" id="frmMatric">
    <div class="row" style="padding-right: 15px; padding-left: 15px;">
      <div class="col-8"><p class="text-primary" style="margin-top:15px;">Student Awaiting Matric number</p></div>
      <div class="col-4"><button class="btn btn-sm btn-rose btn-update" style="float: right;">Save</button></div>
    </div>
    <table class="table table-condensed table-striped table-bordered">
        <tbody>
          <?php
            $value = $_POST["value"];
            $where = array("status"=>"admitted","course"=>$value);
            if ($rows = $db->selectWhere("tbl_student_applications",$where)) {
              foreach ($rows as $row) {
                $surname    = $row["surname"];
                $firstname  = $row["firstname"];
                $middlename = $row["othernames"];
                $student_id = $row["id"];
                $picture    = $row['picture'];
                if ($picture=='') {
                  $picture =  "images/profile/noimage.jpg";
                }else {
                  $picture =  "images/profile/" . $picture ;
                }
                $student_name = $surname." ".$firstname." ".$middlename." ";
              ?>

              <tr>
                <td width="32"><img src="<?php echo $picture; ?>" style="height:28px"></td>
                <td style="font-size:11px; line-height: 32px" class="text-left">&nbsp; &nbsp;
                   <?php echo strtoupper($row['surname'])." " .
                      strtoupper($row['othernames'])." ".
                      strtoupper($row['firstname']);?>
                </td>
                <td>
                  <input id="name-<?php echo $student_id;?>" type='hidden' name="student_name[]" value="<?php echo $student_name; ?>">
                  <input id="matric-<?php echo $student_id;?>" type='text' name="matric_no[]" class="form-control matric" autocomplete="off" placeholder=" Matric Number">
                </td>
                <td>
                  <input id="id-<?php echo $student_id;?>" type="hidden" name="student_id[]" value="<?php echo $student_id; ?>">
                  <button class="btn btn-sm btn-primary btn_view" id="<?php echo $student_id;?>">
                    view
                  </button>
                </td>
              </tr>
          <?php
            }
          }
          ?>
        </tbody>
    </table>
</form>
<div class="modal" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Student Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal_detail">
      </div>
    </div>
  </div>
</div>    

<script>
$(document).ready(function(){

  function get_awaiting_admission(value){
    $.ajax({
      url:"app_model/matric.php",
      method:"POST",
      data:{value:value},
      success:function(data){
        $('.contents').html(data);
      }
    });
  }


  function assign_matric(id, name, matric){
    $.ajax({
      url:"app_model/check_matric.php",
      method:"POST",
      data:{value:matric},
      success:function(data){
        if (data == "available") {
          $.ajax({
            url:"app_model/assign_matric.php",
            method:"POST",
            data:{id:id, name:name, matric:matric},
            success:function(data){
              console.log(data);
            } 
          });
        }else {
          console.log(data);
        }
      }
    });
  }


  $(document).on('click',".btn_view",function(e){
    e.preventDefault();
    var studentID = $(this).attr("id");
    $.ajax({
      url:"app_model/student_detail.php",
      method:"POST",
      data:{studentID:studentID},
      success:function(data){
        $("#modal_detail").html(data);
        $('#myModal').modal("show");
      }
    })
  });

  $(document).on('click','.btn-update', function(e){
    e.preventDefault();
    var course_list = $("#choice").val();
    $("#message").html("");
    $('.matric').each(function(){

      var matric = $(this).val();
      if (matric != "") { 
        var text = $(this).attr('id');
        text = text.split("-");
        var id = text[1];

        var name   = $('#name-'+id).val();
        var id     = $('#id-'+id).val();


        assign_matric(id, name, matric);
        $.ajax({
          url:"app_model/load_matric_list.php",
          method:"POST",
          data:{value:course},
          success:function(data){
            $('.contents').html(data);
          }
        });
      } 
    });


    //get_awaiting_admission(course_list);
    

    // // //var formData = $(this).serializeArray();
    // // var course_list = $("#choice").val();
    // // $.ajax({
    // //   url:"app_model/savematric.php",
    // //   method:"POST",
    // //   data: new FormData(this),
    // //   contentType:false,
    // //   processData:false,
    // //   success:function(data) {
    // //     // $('#message').html("");
    // //     // $('#message').show(500);
    // //     // setTimeout(function(){
    // //     //   //$('#message').html("");
    // //     // },5000);
        
    // //     $('#message').html(data);
    // //     get_awaiting_admission(course_list);
    // //   }
    // }); 
  });
})

  
</script>