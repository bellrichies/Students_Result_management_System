<div class="row">
    <div class="col-md-8">
        <div class="header fixed ">
            <h5 class="text-primary">Accounting Section</h5>
            <div class="header_tabs">
                <ul class="nav nav-pills nav-pills-icons" role="tablist">
                    <li class="nav-item command" id="newpay">
                        <a class="nav-link active" href="#" role="tab" data-toggle="tab">
                            <i class="fas fa-file-invoice-dollar"></i>
                            Payments
                        </a>
                    </li>
                    <li class="nav-item command" id="account-summary">
                        <a class="nav-link " href="#" role="tab" data-toggle="tab">
                            <i class="fas fa-address-card"></i>
                            Summary
                        </a>
                    </li>
                </ul>
           </div>
            <div class="header_forms"></div>
            <div id="message"></div>
        </div>
        <div class="contents"></div>
    </div>
</div>                        
<script>
    $(document).ready(function(){

        setInterval(function(){
            var balance = $("#temp-balance").text();
            balance =  numberFormat(parseFloat(balance));
           $("#outstanding").html(balance);
        },3000);

        function runCommand(filename){
            $.ajax({
                url:"app_views/"+ filename + ".php",
                method:"POST",
                success:function(data){
                    $(".header_forms").html(data);
                }
            });   
        }

        function updateData(id, text, column_name){
            $.ajax({
                url:"app_model/updatepayment.php",
                method:"POST",
                data:{id:id, text:text, column_name:column_name},
                dataType:"text",
                success:function(data){

                }
            })
        }
        
        function deleteData(id){
            $.ajax({
                url:"app_model/deletepayment.php",
                method:"POST",
                data:{id:id},
                dataType:"text",
                success:function(data){
                    return true; 
                }
            })
        }

        function fetchHistory(){
            let value = $("#matric").val();
            if (!value) {
                return false;
            }
            $.ajax({
                url:"app_model/paymenthistory.php",
                method:"POST",
                data:{value:value},
                success:function(data){
                    $(".contents").html(data);
                }
            });


        }
        function numberFormat(num) {
          return '₦' + num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        }

        runCommand("newpay");
        
        $(".command").click(function(){
            var filename = $(this).attr("id");
            runCommand(filename);
        });



        $(document).on('blur','.cell',function(){
            var cell = $(this).attr("id");
            var pointer = cell.split("-");
            var id = pointer[1];
            var text = $(this).val();
            var column_name = $(this).data("name");
            
            if (id != 0) {
                updateData(id, text, column_name);
            }
            
            var cellPointer = pointer[0];

            if (cellPointer == "celldue" || cellPointer == "cellpay") {

                var cellpay = "#cellpay-" + id;
                var celldue = "#celldue-" + id;
                var amount_due = $(celldue).val();
                var amount_pay = $(cellpay).val();

                var balance = amount_due - amount_pay;
                var bal_id = '#cellbal-' + id;

                $(bal_id).val(numberFormat(balance));
            }
        });

        $(document).on('click', '#btn_add', function(){

            id = $("#matric").val();
            var celldat = $('#celldat-0').val();
            var cellban = $('#cellban-0').val();
            var cellrec = $('#cellrec-0').val();
            var celldue = $('#celldue-0').val();
            var cellpay = $('#cellpay-0').val();
            var cellses = $('#cellses-0').val();

            if (celldat=="" || cellban=="" || cellrec=="" || celldue=="" || cellpay =="" || cellses=="") {
                
                $("#message").html("<span class='text-danger'>One or more empty field(s), fill and try again.</span>");
                $("#message").show(1000);

                setTimeout(function(){
                    $("#message").hide('slow');
                },3000);

                return false;
            }else{
                $("#message").html("<span class='text-primary'>Creating the new payment... Please wait.</span>");
                $("#message").show(1000);
                setTimeout(function(){ $("#message").hide('slow') }, 3000);

                $.ajax({

                    url:"app_model/newpay.php",
                    method:"POST",
                    data:{id:id,cell1:celldat,cell2:cellban, cell3:cellrec, cell4:celldue, cell5:cellpay, cell6:cellses},
                    dataType:"text",
                    success:function(data){

                        if (data == "success") {
                            fetchHistory();
                            $("#message").html("<span class='text-primary'>Record successfully inserted! </span>");
                            $("#message").show(1000);
                            setTimeout(function(){ $("#message").hide('slow') }, 3000);      
                            
                        }else{
                            $("#message").html('<span class="text-danger">'+ data + '<span>'); 
                            $("#message").show(1000);      
                            setTimeout(function(){ $("#message").hide('slow') }, 3000);
                            fetchHistory();
                        }
                    }
                });
            }
        });

        $(document).on('click', '#btn_delete', function(){

            var id = $(this).data("id7");
            Swal.fire({
              title: 'Delete record, are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {

                deleteData(id);
                fetchHistory();
                $("#message").html("<span class='text-primary'>Record successfully deleted!</span>");
                $("#message").show(1000);
                setTimeout(function(){ $("#message").hide('slow') }, 3000);
                
              }
            });
        })
    });

</script>


