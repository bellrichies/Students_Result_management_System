<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/portal/app_dbase/connection.php");
$db = new Databases;
?>
<div class="row">
	<div class="col-md-8">
	<div class="header">
		<h5 class="text-primary">Registration Pin Generator</h5>
		<div class="header_tabs"></div>
		<div class="header_forms">
			<div class="bd_form">
			<form method="POST" id="cardform" class="no_margin" style="display: flex">
				<div class="col-md-3"><input id="quantity" type="text" name="quantity" class="form-control" placeholder="How many card? "></div>
				<div class="col-md-3"><input type="submit" value="Generate Form" class="btn btn-primary btn-sm"></div>
				<div class="col-md-3"><a href="#" id='print' class='btn btn-sm btn-danger'>Send to Printer</a></div>
				<div class="col-md-3"><a href="#" id='clean'   class='btn btn-link btn-primary'>Dismiss Page</a></div>
			</form>
		</div>
		</div>
		<div id="message"></div>
	</div>
	<div class="contents"><div>
</div>
</div>





<script>
	$(document).ready(function(){
		
		$.ajax({
            url:"app_model/pin.php",
            method:"POST",
            success:function(data){
                $(".contents").html(data);
            }
        });   

		$("#cardform").on("submit", function(e){
			e.preventDefault();
			var value = $("#quantity").val();
			var action = $("#quantity").attr('id');
			if (value==""){
				Swal.fire(
			      'Empty entry!',
			      'Please type a number in the box',
			      'warning'
			    )
			}else {
				$.ajax({
					url:"app_model/pin.php",
					method:"POST",
					data:{value:value,action:action},
					success:function(data){
					  $(".contents").html(data);
					}
				});
			}
		});
		$(document).on('click',"#clean",function(){
			var action = $(this).attr('id');
			Swal.fire({
			  title: 'Are you sure?',
			  text: "Data will not be saved into database",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, clean it!'
			}).then((result) => {
			  if (result.value) {
			  	$.ajax({
				    url:"app_model/pin.php",
				    method:"POST",
				    data:{action:action},
				    success:function(data){
					  $(".contents").html("");
				    }
				  });
			    Swal.fire(
			      'Cleaned!',
			      'Data dismissed',
			      'success'
			    )
			  }
			})

		});
		$(document).on('click',"#print",function(){
			var page = $('.contents').html();
			if (page == "") {
			  Swal.fire(
			      'Empty Document!',
			      'Please generate ticket to be printed',
			      'error'
			    );
			}else {
				$.ajax({
				    url:"app_model/printout.php",
				    method:"POST",
				    data:{action:'printcard'},
				    success:function(data){
				    	printing = window.open("app_model/printout.php","CACTS Form Pin", "location=1, status=1, width=960, height=700");
					  	printing.moveTo(0,0);
				    }
				});
			} 
	    });
	})
</script>