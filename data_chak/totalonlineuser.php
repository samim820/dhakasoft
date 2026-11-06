<?php

include '../inc/sessaion.php';
include '../inc/config.php';
include '../inc/api.php'; 

$sec = $_SESSION['sec'];


$sql = "SELECT * FROM userinfo WHERE sec='$sec'";
 if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){




 $zone = $row['zone'];
 $userid = $row['username'];

 $sql1 = "SELECT * FROM pop WHERE id='$zone'";
 $pop = mysqli_fetch_assoc($conn->query($sql1) );
 $mikrotikid = $pop['mikrotik'];
 $popname = $pop['name'];

 $sql2 = "SELECT * FROM nas WHERE id='$mikrotikid'";
 $routerid = mysqli_fetch_assoc($conn->query($sql2) );
$deviceip = $routerid['nasname'];





  $API = new routeros_api();
              $API->debug = false;
              $API->port = $routerid['api'];
              if ($API->connect($routerid['nasname'] , $routerid['username'], $routerid['password'])) {


              	$wofBIT=$API->comm("/ppp/active/getall",
                array(
                ".proplist"=> "uptime",
                "?name" => $userid,
                ));

                if (empty($wofBIT)) {

                	$arrID = $API->comm("/ppp/secret/getall",
                array(
                ".proplist"=> "last-logged-out",
                "?name" => $userid,
                ));
                //       $arrID4 = $API->comm("/ppp/secret/getall",
                // array(
                // ".proplist"=> "disabled",
                // "?name" => $userid,
                // ));
                //  $arrID3 = $API->comm("/ppp/secret/getall",
                // array(
                // ".proplist"=> "password",
                // "?name" => $userid,
                // ));
                //  $arrID5 = $API->comm("/ppp/secret/getall",
                // array(
                // ".proplist"=> "profile",
                // "?name" => $userid,
                //));

                  if (empty($arrID)) {
                    $lastlog = 'ID Not Found in Router';
                  }else{

                    $lastlog =  $arrID[0]["last-logged-out"];
                    // $userdisabled =  $arrID4[0]["disabled"];
                    // $password =  $arrID3[0]["password"];
                    // $profile =  $arrID5[0]["profile"];

                  }

                	
              $uptime =  '- - -';
              $activemac =  '- - -';
              $ipaddress =  '- - -';
              $sts = 'Disconected';
                }else{



              		$arrID = $API->comm("/ppp/secret/getall",
                array(
                ".proplist"=> "last-logged-out",
                "?name" => $userid,
                ));
                // $arrID3 = $API->comm("/ppp/secret/getall",
                // array(
                // ".proplist"=> "password",
                // "?name" => $userid,
                // ));
                // $arrID4 = $API->comm("/ppp/secret/getall",
                // array(
                // ".proplist"=> "disabled",
                // "?name" => $userid,
                // ));
                //  $arrID5 = $API->comm("/ppp/secret/getall",
                // array(
                // ".proplist"=> "profile",
                // "?name" => $userid,
                // ));

                // $arrID1 = $API->comm("/ppp/active/getall",
                // array(
                // ".proplist"=> "caller-id",
                // "?name" => $userid,
                // ));	
                // $arrID2 = $API->comm("/ppp/active/getall",
                // array(
                // ".proplist"=> "address",
                // "?name" => $userid,
                // ));

           
             // $uptime =  $wofBIT[0]["uptime"];
             $lastlog =  $arrID[0]["last-logged-out"];
             // $activemac =  $arrID1[0]["caller-id"];
             // $ipaddress =  $arrID2[0]["address"];
             // $password =  $arrID3[0]["password"];
             // $userdisabled =  $arrID4[0]["disabled"];
             // $profile =  $arrID5[0]["profile"];
             $sts = 'Connected';


                }

}else{

			$uptime =  '- - -';
             $lastlog =  '- - -';
             $activemac =  '- - -';
             $ipaddress =  '- - -';
             $sts = 'Device Error';



}

              $sql2 = "INSERT INTO ppp_active (userid, logout, sec, sts) VALUES ('$userid','$lastlog','$sec', '$sts') ON DUPLICATE KEY UPDATE logout='$lastlog', sts='$sts'";
if ($conn->query($sql2) === TRUE) {

  
}


}}}

$result = $conn->query("select * from ppp_active where sts='Connected' AND sec='$sec'");
$count=$result->num_rows;

echo $count;

die;





?>
