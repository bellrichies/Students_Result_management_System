<form method="POST" id="frmMatric">
    <div class="row" style="padding-right: 15px; padding-left: 15px;">
      <div class="col-8"><p class="text-primary" style="margin-top:15px;">Student Awaiting Matric number</p></div>
      <div class="col-4"><button class="btn btn-sm btn-rose btn-update" style="float: right;">Save</button></div>
    </div>
    <table class="table table-condensed table-striped table-bordered">
        <tbody>
          <?php
            require_once(__DIR__ . "../../app_dbase/connection.php");
            $db = new Databases;
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
