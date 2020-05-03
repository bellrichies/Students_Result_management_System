<?php
require_once(__DIR__ . "../../app_dbase/connection.php");
$db = new Databases;

if ($_POST['value']) {
	$value = $_POST['value'];
	$where=array("programme"=>$value,);
}

?>
    <table class="table table-striped table-condensed table-bordered">
      <tbody>
      	<thead>
      		<tr class="bg-primary text-white">
      			<th class="text-left">&nbsp; &nbsp;Programme</th>
      			<th class="text-left">&nbsp; &nbsp;Class Name</th>
            <th>Ranking</th>
      			<th>Action</th>
      		</tr>
      	</thead>
        <?php
          $rows = $db->selectWhere('tbl_admin_class',$where,"rank");
          foreach ($rows as $row) {?>
            <tr>
              <td style="width:40%" class="text-left">&nbsp; &nbsp;<?php echo $row['programme'];?></td>
              <td style="width:40%" class="text-left"> &nbsp; &nbsp;<?php echo $row['class'];?></td>
              <td><?php echo $row['rank'];?></td>
              <td><strong>
              	<a href="#" class="deleleClass text-danger" id="<?php echo $row['id']; ?>"><i class="fas fa-times"></i></a></strong>
              </td>
            </tr>
          <?php
          }
          ?>
      </tbody>
    </table>  			
<script>
  $(".deleleClass").on("click",function(e){
    e.preventDefault();
    var action = "deleteclass";
    var id = $(this).attr("id");
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
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
          data: {id:id,action:action},
          success:function(data) {
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
              value = $("#program").val();
              $.ajax({
                url:"app_model/classes.php",
                method:"POST",
                data:{value:value},
                success:function(data){
                  $(".contents").html(data);
                }
              });
          }
        });
      }
    })

  })


</script>