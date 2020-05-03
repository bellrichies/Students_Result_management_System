<?php 
    $page_title = "Login Page";
    include_once("includes/header.php");
?>

<div class="main_container">
  <h1 class="form-heading"><p><br></p></h1>
  <div class="login-form">
    <div class="main-div">
      <div class="panel"><h2>Portal Access Login</h2><p>Please enter your email and password</p></div>
      <form id="login">
          <div class="form-group">
            <input type="email" class="form-control" id="form_email" name="form_email" placeholder="Email Address">
          </div>
          <div class="form-group">
            <input type="password" id="form_password" name="form_password" class="form-control" placeholder="Password">
          </div>
          <div class="forgot"><a href="forgot.php">Forgot password?</a></div>
          <button type="submit" class="btn btn-primary" id="submit">Login</button>
          <span id="loading"></span>
      </form>
    </div>
  </div>
</div>
</div>
</body>


  <script src="app_assets/assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="app_assets/assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="app_assets/assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="app_assets/assets/js/plugins/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
  $(document).ready(function(){
    $('#login').on('submit',function(e){
      e.preventDefault();
      var form_email = $("#form_email").val();
      var form_password = $("#form_password").val();
      if (form_password == "" || form_email == "") {
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
          icon: 'error',
          title: 'All fields are required'
        });
        return false;
      }else{
        // $("#submit").hide();
        // $("#loading").html("<img src='app_assets/gif/loading.gif'>");
        $.ajax({
          url:"app_model/login.php",
          method: "POST",
          data: new FormData(this),
          contentType:false,
          processData:false,
          success:function(data) {
            if (data=="success") {
              // const Toast = Swal.mixin({
              //   toast: true,
              //   position: 'top-end',
              //   showConfirmButton: false,
              //   timer: 3000,
              //   timerProgressBar: true,
              //   onOpen: (toast) => {
              //     toast.addEventListener('mouseenter', Swal.stopTimer)
              //     toast.addEventListener('mouseleave', Swal.resumeTimer)
              //   }
              // })
              // Toast.fire({
              //   icon: 'success',
              //   title: 'Signed in successfully'
              // });
              // redirect to dashboard page
              window.location.replace("dashboard.php");
            }else{

              // const Toast = Swal.mixin({
              //   toast: true,
              //   position: 'top-end',
              //   showConfirmButton: false,
              //   timer: 3000,
              //   timerProgressBar: true,
              //   onOpen: (toast) => {
              //     toast.addEventListener('mouseenter', Swal.stopTimer)
              //     toast.addEventListener('mouseleave', Swal.resumeTimer)
              //   }
              // })
              // Toast.fire({
              //   icon: 'error',
              //   title: 'Invalid login detail, try again!'
              // })
              // $("#submit").show();
              // $("#loading").html("");
            }
          }
        });
      }
    })
  })
</script>
