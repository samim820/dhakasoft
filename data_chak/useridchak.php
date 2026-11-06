<?php

include '../inc/sessaion.php';
include '../inc/config.php'; 


if(isset($_POST['username'])){
    $username = mysqli_real_escape_string($conn,$_POST['username']);

    $query = "select count(*) as cntUser from userinfo where username='".$username."'";
    
    $result = mysqli_query($conn,$query);
    $response = "<span style='color: green;'>User ID Available.</span>";
    $res = "<script>$('#submit').prop('disabled',false);</script>";
    if(mysqli_num_rows($result)){
        $row = mysqli_fetch_array($result);
    
        $count = $row['cntUser'];
        
        if($count > 0){
            $response = "<span style='color: red;'>User ID Not Available.</span>";
            $res = "<script>$('#submit').prop('disabled',true);</script>";
            
        }
       
    }
    
    echo $response;
    echo $res;
    die;
}




?>
