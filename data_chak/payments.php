<?php

include '../inc/sessaion.php';
include '../inc/config.php'; 
$sec = $_SESSION['sec'];



?>
 <thead>
                  <tr style="text-align: center;">
                    <th width="2%">SL</th>
                    <th width="10%">CUST ID</th>
                    <th width="10%">UserID</th>
                    <th width="10%">Rec Amount</th>
                    <th width="15%">Total Amount</th>
                    <th width="20%">Notes</th>
                    <th width="10%">Date</th>
                    <th width="10%">Recive</th>
                    <th width="10%">Action</th>
                  </tr>
                  </thead>
                  <tbody>

<?php
   
$sql = "SELECT * FROM payment WHERE  sec='$sec'";

$selectedUser = isset($_POST['user']) ? $_POST['user'] : null;
$startDateFilter = isset($_POST['startDate']) ? $_POST['startDate'] : null;
$endDateFilter = isset($_POST['endDate']) ? $_POST['endDate'] : null;



if ($selectedUser !== null) {
    $sql .= " AND  reciveby Like '$selectedUser%'";
}

if ($startDateFilter !== null && $endDateFilter !== null) {
    $sql .= " AND datee BETWEEN '$startDateFilter' AND '$endDateFilter'";
}



     if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
      $i = 0;
        while($row = mysqli_fetch_array($result)){
          $i++;




?>

 <tr style="text-align: center;">
                    <td width="2%"><?php echo $sec; ?></td>
                    <td width="10%"><?php echo $row['custid']; ?></td>
                    <td width="10%"><?php echo $row['username']; ?></td>
                    <td width="10%"><?php echo $row['receve_amount']; ?></td>
                    <td width="10%"><?php echo $row['total_amount']; ?></td>
                    <td width="30%"><?php echo $row['notes']; ?></td>
                    <td width="20%"><?php 

                    $dateTime = new DateTime($row['datee']);
                    $formattedDate = $dateTime->format('d-M-Y h:i:s');


                    echo $formattedDate; ?></td>
                    <td width="20%"><?php echo $row['reciveby']; ?></td>
                    <td width="10%"><a href="#"><button class="btn btn-primary">Edite</button></a></td>
                  </tr>

                 
           
                  


<?php


  



}
  } }

else {
    echo "No results found for the selected user and date range.";
}

$conn->close();


    










   
  

    die;




?>

