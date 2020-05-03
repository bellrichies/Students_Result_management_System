<select class="form-dropdown form-control col-4" id="choice">
  <option>Select Student Class</option>
  <option value="Certificate 1">Certificate </option>
  <option value="Diploma 1">Diploma</option>
  <option value="Diploma 2">Diploma Two Direct Entry</option>
  <option value="Bachelor 1">100 Level Degree</option>
  <option value="Bachelor 2">200 Level Direct Entry</option>
  <option value="Bachelor 3">300 Level Direct Entry</option>         
</select>
                               
<script>
 $(document).ready(function(){
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
  });
</script>