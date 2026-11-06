<?php

include '../inc/config.php'; 
include'../inc/api.php';


$nasid = $_GET['nasid'];


$sql = "SELECT * FROM nas WHERE id = " . intval($nasid);
$row = mysqli_fetch_assoc($conn->query($sql) );



              $API = new routeros_api();
              $API->debug = false;
              $API->port = $row['api'];

 if ($API->connect($row['nasname'] , $row['username'], $row['password'])) {


                  $ARRAY1  = $API->comm("/ppp/profile/print");

                  $num =count($ARRAY1);  
        $count=0;                                            
    for($i=0; $i<$num; $i++){
      $count++;
echo "<option value=".$ARRAY1[$i]['name'].">".$ARRAY1[$i]['name']."</option>";

}

                    }else{

                     echo "<option value='0'>".'disconnect'."</option>";
                    }


?>
