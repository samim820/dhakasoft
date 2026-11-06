<?php

include '../inc/sessaion.php';
include '../inc/config.php'; 

   

$sec = $_SESSION['sec'];

    




  ?>


      
     <table class="table table-bordered">
                  <thead>                  
                    <tr style="text-align: center;">
                    <th>Cust ID</th>
                      <th>User ID</th>
                      <th>Exp Date</th>
                      <th>Mobile</th>
                      <th>Amount</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>


    <?php 

    if(isset($_POST['searchid'])){

    $custid = $_POST['searchid'];


    

   $sql = "
SELECT * 
FROM userinfo 
WHERE sec = '$sec' 
  AND (
        custid LIKE '%{$custid}%' 
     OR mobilephone LIKE '%{$custid}%' 
     OR username LIKE '%{$custid}%'
      )
ORDER BY custid ASC 
LIMIT 10
";

if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
    

         
                 echo '
                    <tr style="text-align: center;">
                    <td>'.$row['custid'].'</td>
                      <td>'.$row['username'].'</td>
                      <td>'.$row['expire'].'</td>
                      <td>'.$row['mobilephone'].'</td>
                      <td>'.$row['amount'].'</td>
                      <td><a target="_blank" href="recharge.php?id='.$row['custid'].'"><button class="btn btn-success">Recherg</button></a> 
                      <a target="_blank" href="profile.php?id='.$row['custid'].'"><button class="btn btn-primary">View</button></a></td>
                    </tr>';

}}}

?>
                
                 </tbody> 
                </table>

                 
<?php

                


    }else{



    }

    die;




?>

