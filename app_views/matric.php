<select class="form-dropdown form-control col-4" id="choice" >
  <option>Select Fresher Class</option>
  <option value="Certificate 1">Certificate </option>
  <option value="Diploma 1">Diploma</option>
  <option value="Diploma 2">Diploma Two Direct Entry</option>
  <option value="Bachelor 1">100 Level Degree</option>
  <option value="Bachelor 2">200 Level Direct Entry</option>
  <option value="Bachelor 3">300 Level Direct Entry</option>
</select>

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
  $('#choice').change(function(){
    var course_list = $(this).val();
    get_awaiting_admission(course_list);
  });
});
</script>