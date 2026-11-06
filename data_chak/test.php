<?php

include '../inc/sessaion.php';
include '../inc/config.php'; 


if(isset($_POST['month'])){

    $month = $_POST['month'];
    $cycle = '15';

  $data = date('Y/m/'.$cycle, strtotime('+'.$month.' month'));

echo $data;
}else{

}

    

    die;




?>

