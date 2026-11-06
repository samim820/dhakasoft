<?php

include __DIR__ . '/../inc/config.php';

$sql = "SELECT * FROM sms_gtw WHERE sec='main'";
$row = mysqli_fetch_assoc($conn->query($sql) );

	$url = "http://bulksmsbd.net/api/smsapi";
    $api_key = $row['api'];
    $senderid = $row['sender_id'];
  


$sql10 = "SELECT * FROM sms WHERE  status='Pending' limit 50";
if($result = mysqli_query($conn, $sql10)){
    if(mysqli_num_rows($result) > 0){
     // $i = 0;
        while($row = mysqli_fetch_array($result)){
         // $i++;


			$number = $row['mobile'];
			$message = $row['msg'];
			$msgid = $row['id'];
 
    $data = [
        "api_key" => $api_key,
        "senderid" => $senderid,
        "number" => $number,
        "message" => $message
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    $json_array=json_decode($response,true);
    $smsresult=$json_array['response_code'];


if ($smsresult == 202) {
 
    $sql = "UPDATE sms SET status='Deliverd' WHERE id='$msgid'";
	$conn->query($sql);      

}elseif ($smsresult == 1000) {
     $sql = "UPDATE sms SET status='1000' WHERE id='$msgid'";
	$conn->query($sql);
}
elseif ($smsresult == 1002) {
 	 $sql = "UPDATE sms SET status='1002' WHERE id='$msgid'";
	$conn->query($sql);
}

elseif ($smsresult == 1003) {
    	 $sql = "UPDATE sms SET status='1003' WHERE id='$msgid'";
	$conn->query($sql);
}

elseif ($smsresult == 1004) {
  	 $sql = "UPDATE sms SET status='1004' WHERE id='$msgid'";
	$conn->query($sql);
}

elseif ($smsresult == 1006) {
   	 $sql = "UPDATE sms SET status='1006' WHERE id='$msgid'";
	$conn->query($sql);
}

elseif ($smsresult == 1007) {
       $sql = "UPDATE sms SET status='1007' WHERE id='$msgid'";
	$conn->query($sql);
}

elseif ($smsresult == 1009) {
    	 $sql = "UPDATE sms SET status='1009' WHERE id='$msgid'";
	$conn->query($sql);
}else{

 
}


}}}

?>