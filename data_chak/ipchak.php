<?php

include '../inc/sessaion.php';
include '../inc/config.php'; 


if(isset($_POST['ip'])){
    $ip = mysqli_real_escape_string($conn,$_POST['ip']);

    $query = "select count(*) as cntUser from userinfo where ip='".$ip."'";



    if (filter_var($ip, FILTER_VALIDATE_IP)) {
        
        $result = mysqli_query($conn,$query);
    $response = "<span style='color: green;'>IP Address Available.</span>";
    $res = "<script>$('#submit').prop('disabled',false);</script>";
    if(mysqli_num_rows($result)){
        $row = mysqli_fetch_array($result);
    
        $count = $row['cntUser'];
        
        if($count > 0){
            $response = "<span style='color: red;'>IP Address Already Used..</span>";
            $res = "<script>$('#submit').prop('disabled',true);</script>";
            
        }
       
    }

    }else{

        $response = "<span style='color: red;'>Please Provide Right IP Formate Like xxx.xxx.xxx.xxx.</span>";
    $res = "<script>$('#submit').prop('disabled',false);</script>";

    }
    
    
    
    echo $response;
    echo $res;
    die;
}




?>
