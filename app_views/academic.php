<div class="row">
  <div class="col-md-8">
    <div class="header fixed ">
      <h5 class="text-primary">Academic Department</h5>
      <div class="header_tabs">
        <ul class="nav nav-pills nav-pills-icons" role="tablist">
            <li class="nav-item command" id="subjects_header_form">
                <a class="nav-link active" href="#" role="tab" data-toggle="tab">
                    <i class="fas fa-tasks"></i>
                    Subjects
                </a>
            </li>
            <li class="nav-item command" id="classes">
                <a class="nav-link" href="#" role="tab" data-toggle="tab">
                    <i class="fas fa-chalkboard-teacher"></i>
                    Classes
                </a>
            </li>
            <li class="nav-item command" id="grades">
                <a class="nav-link" href="#" role="tab" data-toggle="tab">
                    <i class="fas fa-sort-amount-up"></i>
                    Grades
                </a>
            </li>
            <li class="nav-item command" id="scoresheet">
                <a class="nav-link" href="#" role="tab" data-toggle="tab">
                    <i class="fas fa-scroll"></i>
                    Scoresheet
                </a>
            </li>
            <li class="nav-item command" id="promotion">
                <a class="nav-link" href="#" role="tab" data-toggle="tab">
                    <i class="fas fa-user-graduate"></i>
                    Promotion
                </a>
            </li>
        </ul>
      </div>
      <div class="header_forms"></div>
      <div id="message"></div>
    </div>
    <div class="contents"></div>
</div>
                                
<script>
 $(document).ready(function(){

      function runCommand(filename){
            $.ajax({
                url:"app_views/"+ filename + ".php",
                method:"POST",
                success:function(data){
                    $(".header_forms").html(data);
                }
            });   
        }

      runCommand("subjects_header_form");

      $('.command').on('click',function(){
         var filename = $(this).attr("id");
         $.ajax({
                url:"app_views/"+ filename + ".php",
                method:"POST",
                success:function(data){
                  if (filename == "grades") {
                    $(".header_forms").html("");
                    $(".header_forms").addClass("no_bg");                    
                    $(".contents").html(data);
                  }else{
                    $(".contents").html("");
                    $(".header_forms").removeClass("no_bg"); 
                    $(".header_forms").html(data);                    
                  }
                }
            });
      });

      $('#choice').change(function(){ 
        var list = $(this).val();
        $.ajax({
          url:"app_model/admission.php",
          method:"POST",
          data:{value:list},
          success:function(data){
            $('.contents').html(data);
          }
        });
      });
      
  })


    

</script>


