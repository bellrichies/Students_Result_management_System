<?php
session_start();
require_once(__DIR__ . "../../app_dbase/connection.php");
require_once(__DIR__ . "../../app_function/function.php");
$db = new Databases;
$i = 1;
$seria_no = str_shuffle("0123456789");
?>

<div class="container" style="font-size: .6em; line-height: 15px; letter-spacing: ">
    <div class="row bg-white" style="padding-top:20px !important;">

<?php
$cards = array();

if (empty($_SESSION['cards'])) {
    if (isset($_POST['value'])) {
        $value= $_POST['value'];
        
        while ( $i<= $value) {

            $pin_no  = pin_no();
            $where  = array("pin"=>$pin_no);
            $table  = "tbl_form_pin";
            if (!isDuplicate($db, $table, $where)) {
                $seria_no ++;
                $data = array("pin"=>$pin_no,"serial"=>$seria_no);
                if ($db->insert($table, $data)) {
                    $scratchedCard = scratchedCard($pin_no,$seria_no);
                }
                $cards[$i] = $scratchedCard;
                printTicket($scratchedCard);
                $i++;
            }
        }

        $_SESSION['cards']=$cards;
    }
}else {
    echo '<p class="col-12"> Duplicate tickets found, print before you dismis the page! </p>';
    $cards = $_SESSION['cards'];
    $value = count($cards);
    for ($i=1; $i <= $value ; $i++) { 
        printTicket($cards[$i]);
    }
}

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    if ($action == "clean") {
        $cards = array();
        $_SESSION['cards'] = $cards;
    }
}
?>
</div>
</div>