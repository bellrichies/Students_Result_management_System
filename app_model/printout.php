
<?php
session_start();
 if (isset($_SESSION['cards'])) {
    $length = count($_SESSION['cards']);
    $cards = $_SESSION['cards'];
    ?>
    <link rel="stylesheet" href="../app_assets/assets/css/material-kit.css"  />    
    <div class="container" style="font-size: .92em; line-height: 15px;">
        <div class="row bg-white" style="padding-top:20px !important;">
    <?php
    for ($i=1; $i <= $length ; $i++) { 
    ?>

        <div class="col-md-3" style="margin-bottom: 5px;">
            <div style="border:1px solid #eee; padding:5px;">
                <img src="../images/logo.png" style="width:100px;"><br>
                <?php echo $cards[$i]; ?>
            </div>      
        </div>




<?php

    }
 }
 echo "<script>window.print();</script>";
