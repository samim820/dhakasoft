  <?php

  


      $msgg = $sms_temp['msg'];







            
            $messages =  strtr($msgg, array('{EXPIRE_DATE}' => $expire, '{USER_ID}' => $userid, '{CUSTOMER_ID}' => $custid,'{CUST_NAME}' => $fullname, '{AMOUNT}' => $recive, '{DUE}' => $due, '{PACKAGE}' => $package, '{RATE}' => $rent,  '{PASSWORD}' => $password)); 

         date_default_timezone_set("Asia/Dhaka");
            $Date = date('Y-m-d h:i a');
            $length = strlen($messages);
            $divid = '158';
            $count = ceil($length/$divid);

       $sql1 = "INSERT INTO sms (custid, mobile, msg, count, status, sec, datetimee) VALUES ('$custid','$mobile','$messages', '$count', 'Pending','$sec','$Date')";
        $conn->query($sql1);

 