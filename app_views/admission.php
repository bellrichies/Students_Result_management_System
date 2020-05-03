<div class="row">
  <div class="col-md-8">
    <div class="header">
      <h5 class="text-primary">Academic</h5>
      <div class="header_tabs">
        <ul class="nav nav-pills nav-pills-icons nav-pills-primary" role="tablist">
            <li class="nav-item command" id="grant">
                <a class="nav-link active" href="#dashboard-1" role="tab" data-toggle="tab">
                    <i class="fas fa-hand-holding-heart"></i>
                    Admit
                </a>
            </li>
            <li class="nav-item command" id="matric">
                <a class="nav-link" href="#dashboard-1" role="tab" data-toggle="tab">
                    <i class="fas fa-tasks" ></i>
                    Matric
                </a>
            </li>
            <li class="nav-item command" id="deffer">
                <a class="nav-link" href="#dashboard-1" role="tab" data-toggle="tab">
                    <i class="fas fa-random"></i>
                    Deffer
                </a>
            </li>
            <li class="nav-item command" id="editstudent">
                <a class="nav-link" href="#dashboard-1" role="tab" data-toggle="tab">
                    <i class="fas fa-user-edit"></i>
                    Profile
                </a>
            </li>
        </ul>
      </div>
      <div class="header_forms">
      </div>
      <div id="message"></div>
    </div>
    <div class="contents"></div>
  </div>
  <div class="col-md-4"></div>
</div>
                           
<script>
 $(document).ready(function(){

      function get_page(page){

        page ="app_views/"+ page +".php";
        $.ajax({
            url:page,
            method: "POST",
            success:function(data){
              $(".header_forms").html(data);
              $(".contents").html("");
            }
         });
      }

      get_page("grant");

      $('.command').on('click',function(){
         var page = $(this).attr("id");
         $("#message").html("");
         get_page(page);
      });
  })
      
</script>