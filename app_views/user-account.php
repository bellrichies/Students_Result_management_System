

<div class="row">
<div class="col-md-9">
	<h5 class="text-primary">User Acccount</h5>
<form method="post" id="frmUsers" enctype="multipart/form-data">

	<table class="">
		<tr>
			<td rowspan="2" style="vertical-align: middle; padding:0; text-align:right">
				<label for="profile-image"><img src="images/profile/noimage.jpg" style="width:50px; "></label>
				<input type="file" name="profile" placeholder="upload reciept copy" id="profile-image" class="hidden">
			</td>
			<td style="padding:0; vertical-align: middle; text-align: center;">
				<input style=" width: 90%; padding:5px 5px;background:#fff;" type="surname" name="surname" placeholder="Surname" autocomplete="off">
			</td>
			<td style="padding:0; vertical-align: middle; text-align: center;">
				<input style=" width: 90%; padding:5px 5px;background:#fff;" type="Firstname" name="firstname" placeholder="Firstname" autocomplete="off">
			</td>
			<td style="padding:0; vertical-align: middle; text-align: center;">
				<input style=" width: 90%; padding:5px 5px;background:#fff;" type="email" name="email" placeholder="E-mail address" autocomplete="off">
			</td>
		</tr>
		<tr>
			<td style="padding:0; vertical-align: middle; text-align: center;">
				<input style=" width: 90%; padding:5px 5px;background:#fff;" type="username" name="userbame" placeholder="Username" autocomplete="off">
			</td>
			<td style="padding:0; vertical-align: middle; text-align: center;">
				<input style=" width: 90%; padding:5px 5px;background:#fff;" type="password" name="pass1" placeholder="Password" autocomplete="off">
			</td>
			<td style="padding:0; vertical-align: middle; text-align: center;">
				<select name="type" style=" width: 90%; padding:6px 5px;">
					<option value="1">Lecturer</option>
					<option value="2">Accounting Staff</option>
					<option value="3">Admin Staff</option>
					<option value="4">Director</option>
					<option value="5">Academics Staff</option>
					<option value="4">IT Staff</option>
				</select>
			</td>
			<td rowspan="2" style="padding:0;"><input type="submit" value="Add"  class="btn btn-sm btn-primary"></td>
		</tr>
	</table>
</form>
</div></div>
<script>
   	$('#frmUsers').on('submit',function(e){
        e.preventDefault();
        formData = $(this).serializeArray();
        $.ajax({
            url:"",
            method:"POST",
            data:{formData:formData},
            success:function(data){
            	$("").html(data);
            }
          });
    });
</script>