<?php 
include 'inc/sessaion.php';
include 'inc/config.php';
include 'inc/heder.php'; 
include 'inc/menu.php'; 
include 'inc/api.php';

$secid= $_SESSION['sec'];




if (empty($_GET['id'])) {

 $_SESSION['error'] = "User ID Not Found";
echo "<script>window.location.replace('index.php')</script>";


}else{
  $id = $_GET['id'];
  $sql = "SELECT * FROM userinfo WHERE custid='$id' AND sec='$secid'";
  $row11 = mysqli_fetch_assoc($conn->query($sql) );


  $packageidfind = $row11['package'];


   $sql12 = "SELECT * FROM package WHERE id= '$packageidfind' ";
    $row12 = mysqli_fetch_assoc($conn->query($sql12) );


  if (empty($row11['custid'])) {

     $_SESSION['success'] = "User ID Not Found";
    echo "<script>window.location.replace('index.php')</script>";
  }else{

  }

 
  


}


 $sql = "SELECT * FROM userinfo WHERE custid='$id'";
 $row = mysqli_fetch_assoc($conn->query($sql) );

 $zone = $row['zone'];
 $userid = $row['username'];
 $routerid = $row['routerid'];

 $sql1 = "SELECT * FROM nas WHERE id='$routerid'";
 $router = mysqli_fetch_assoc($conn->query($sql1) );
$ip = $router['nasname'];
$username = $router['username'];
$pass = $router['password'];
$apiport = $router['api'];

  $API = new routeros_api();
              $API->debug = false;
              $API->port = $apiport;

     if ($API->connect($ip , $username, $pass))





    $ARRAY2=$API->comm("/ppp/secret/getall",
                array(
                "?name" => $userid,
                ));





?>
 


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
<div class="row">
   <div class="col-md-12">

            <!-- Profile Image -->
            <div class="card card-primary"><i class=""></i>
              <div class="card-body">

                    <?php 
            if ($row11['userstatus'] == '0') {
              
              
           


            ?> 

            <!-- If user Left -->

            <a href="data_update/reactive_user.php?id=<?php echo $row11['custid']; ?>"><button title="Reactive User" style="margin: 3px;" class="btn btn-success"><i style="font-size: 35px;" class="fas fa-undo"></i></button><i class=""></i></a>
            <a href="data_delete/delete_user.php?id=<?php echo $row11['custid']; ?>"><button title="Peremently Delete" style="margin: 3px;" class="btn btn-danger"><i style="font-size: 35px;" class="fas fa-trash"></i></button><i class=""></i></a>


            <?php 
 }else{




            ?>
            <a href="recharge.php?id=<?php echo $row11['custid']; ?>"><button title="Recherg" style="margin: 3px;" class="btn btn-success"><i style="font-size: 35px;" class="fas fa-battery-half"></i></button></a>
            <button data-toggle="modal" data-target="#passchange" title="Password Change" style="margin: 3px;" class="btn btn-danger"><i style="font-size: 35px;" class="fas fa-key"></i></button>
            <button data-toggle="modal" data-target="#packagechange"  title="Package Change"  style="margin: 3px;" class="btn btn-dark"><i style="font-size: 35px;" class="fas fa-exchange-alt"></i></button>
            <button data-toggle="modal" data-target="#billingcycle" title="Cycle Change" style="margin: 3px;" class="btn btn-danger"><i style="font-size: 35px;" class="fas fa-calendar-alt"></i></button>
            <button data-toggle="modal" data-target="#balanceadd" title="Cash Receve"  style="margin: 3px;background: #ff7800;color: white;" class="btn"><i style="font-size: 35px;" class="fas fa-wallet"></i></button>
            <a href="userpaymentreports.php?id=<?php echo $row11['custid']; ?>"><button title="Payment Report" style="margin: 3px;" class="btn btn-success"><i style="font-size: 35px;" class="fas fa-list"></i></button></a>
            <button title="Crate Ticket" style="margin: 3px;" class="btn btn-dark"><i style="font-size: 35px;" class="fas fa-ticket-alt"></i></button>
            <button title="Ticket List" style="margin: 3px;" class="btn btn-success"><i style="font-size: 35px;" class="fas fa-clipboard-list"></i></button>
            <button title="SMS List" style="margin: 3px;" class="btn btn-success"><i style="font-size: 35px;" class="fas fa-sms"></i></button>
            <a href="sessaion_history.php?id=<?php echo $row11['custid']; ?>"><button title="Sessaion History" style="margin: 3px;" class="btn btn-dark"><i style="font-size: 35px;" class="fas fa-history"></i></button><i class=""></i></a>
            <a href="ipchange.php?id=<?php echo $row11['custid']; ?>"><button title="IP Address" style="margin: 3px;" class="btn btn-success"><i style="font-size: 35px;" class="fas fa-wifi"></i></button><i class=""></i></button></a>

            <?php
            if ($row11['userstatus'] == '1') {

            ?>

            <a href="data_update/disabled.php?id=<?php echo $row11['custid']; ?>"><button title="User Disabled" style="margin: 3px;" class="btn btn-dark"><i style="font-size: 35px;" class="fas fa-user-slash"></i></button><i class=""></i></a>

            <?php
          }elseif ($row11['userstatus'] == '10') {
            

            ?>

            <a href="data_update/enable.php?id=<?php echo $row11['custid']; ?>"><button title="User Enable" style="margin: 3px;" class="btn btn-dark"><i style="font-size: 35px;" class="fas fa-user-check"></i></button><i class=""></i></a>

            <?php


          }


            ?>
            <a href="data_chak/kick.php?id=<?php echo $row11['custid']; ?>"><button title="Disconnect User" style="margin: 3px;" class="btn btn-danger"><i style="font-size: 35px;" class="fas fa-minus-circle"></i></button><i class=""></i></a>


            <?php
$now = date('Y/m/d');
$exp = $row11['expire'];

$date1 = strtotime($now);
$date2 = strtotime($exp);
$diff = $date2 - $date1;
$days = floor($diff / (60 * 60 * 24));


if ($days < 0 ) {
 

            

            ?>


            <a href="data_update/left_user.php?id=<?php echo $row11['custid']; ?>"><button title="Left User" style="margin: 3px;" class="btn btn-danger"><i style="font-size: 35px;" class="fas fa-times-circle"></i></button><i class=""></i></a>

<?php
}else{


}

?>



        
<?php } ?>




              </div>
            </div>
          </div>
</div>



        <div class="row">
          <div class="col-md-4">

            <!-- Profile Image -->
            <div class="card card-primary">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="dist/img/user4-128x128.jpg"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $row11['firstname']; ?> </h3>

                <p class="text-muted text-center">CUSTOMER ID: <strong style="font-size: 25px;"><?php echo $row11['custid']; ?></strong></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>User ID:</b> <a class="float-right"><?php echo $row11['username']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Mobile:</b> <a class="float-right"><?php echo $row11['mobilephone']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Address:</b> <a class="float-right">House-<?php echo $row11['house']; ?>,Road-<?php echo $row11['road']; ?>,<?php echo $row11['thana']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>City:</b> <a class="float-right"><?php echo $row11['city']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Zone:</b> <a class="float-right"><?php echo $row11['zone']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Post:</b> <a class="float-right"><?php echo $row11['zip']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Email:</b> <a class="float-right"><?php echo $row11['email']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Gender:</b> <a class="float-right"><?php echo $row11['gender']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Join Date:</b> <a class="float-right"><?php 

                    $originalDate = $row11['creationdate'];
$newDate = date("d-M-Y h:m:s a", strtotime($originalDate));


echo $newDate; ?></a>
                  </li>

                  <li class="list-group-item">

                      <?php 
                      if ($row11['userstatus'] == '0') {
                       
                       echo '<b>Status:</b> <a class="float-right"><span class="badge badge-danger">User Left</span></a>';
                      }elseif($row11['userstatus'] == '1'){

                        echo '<b>Status:</b> <a class="float-right"><span class="badge badge-success">Active</span></a>';

                      }elseif($row11['userstatus'] == '10'){

                        echo '<b>Status:</b> <a class="float-right"><span class="badge badge-secondary">Disabled</span></a>';

                      }else{
                        echo '<b>Status:</b> <a class="float-right"><span class="badge badge-warning">wrong</span></a>';

                      }

                      ?>

                    


                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>

          </div>

           <div class="col-md-4">

            <!-- Profile Image -->
            <div class="card card-primary">
              <div class="card-body box-profile">

                <h3 class="profile-username text-center">Billing Information</h3>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Monthly Bill:</b> <a class="float-right"><?php echo $row11['amount']; ?> Tk</a>
                  </li>
                  <li class="list-group-item">
                    <b>Package:</b> <a class="float-right">
                      <?php

                      if (empty($row12['name'])) {
                        
                        echo '<span style="color:red;">Package not Found</span>';
                      }else{

                        echo $row12['name'];
                      }


                       ?>




                  </a>
                  </li>
                  <li class="list-group-item">
                    <b>Balance:</b> <a class="float-right"><?php echo $row11['balance']; ?> Tk</a>
                  </li>
                  <li class="list-group-item">
                    <b>Discount:</b> <a class="float-right"><?php echo $row11['discount']; ?> Tk</a>
                  </li>
                  <li class="list-group-item">
                    <b>Billing Cycle:</b> <a class="float-right">Day of <?php echo $row11['cycle']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Expire Date:</b> <a class="float-right">
                      <?php 

$now = date('Y/m/d');
$exp = $row11['expire'];

$expire_date = date("d-F-Y", strtotime($exp));
$date1 = strtotime($now);
$date2 = strtotime($exp);
$diff = $date2 - $date1;
$days = floor($diff / (60 * 60 * 24));

if ($days > 0) {
  echo '<span class="text text-success">'.$expire_date.'</span>';
}else{
    echo '<span class="text text-danger">'.$expire_date.'</span>';
}


                      ?>


                      </a>
                  </li>
                  <li class="list-group-item">
                    <b>Billing Status:</b> <a class="float-right">

                      <?php 

  
  if ($days > 0) {
    echo '<span class="badge badge-success">Active</span>';
  }else{

    echo '<span class="badge badge-danger">Expire</span>';
  }




                      ?>


                      </a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>


            <div class="card card-primary">
              <div class="card-body box-profile">

                <h3 class="profile-username text-center">Server Information</h3>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>User ID:</b> <a class="float-right"><span data-copy="<?php echo $row11['username']; ?>" class="copy-text"><?php echo $row11['username']; ?></span></a>
                    <span class="copied" id="msg1"></span>
                  </li>
                  <li class="list-group-item">
                    <b>Password:</b> <a class="float-right"><span data-copy="<?php echo $row11['portalloginpassword']; ?>" class="copy-text"><?php echo $row11['portalloginpassword']; ?></span></a>
                    <span class="copied" id="msg2"></span>
                  </li>
                 <li class="list-group-item">
                    <b>IP Address:</b> <a class="float-right"><?php echo $row11['ip']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Server:</b> <a class="float-right">
                      <?php 
                      $rtid = $row11['routerid'];
                      $sql = "SELECT * FROM nas WHERE id='$rtid'";
                      $row11 = mysqli_fetch_assoc($conn->query($sql) );

                        echo $row11['shortname'].'/'.$row11['nasname'];
                        ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Server Status:</b> <a class="float-right">

                      <?php 

              

                       if (empty($ARRAY2[0]['name'])) {
      
                           echo '<span class="badge badge-danger">ID Not Found</span>';
                           echo '<a href="data_add/readd.php?custid='.$id.'" class="badge badge-primary">Readded</a>';

                        }else{
                            echo '<span class="badge badge-success">ID Found</span>';

                        }



                      ?>


                      </a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>

          </div>

           <div class="col-md-4">

            <!-- Profile Image -->
            <div class="card card-primary">
              <div  class="card-body box-profile">
                <h3 class="profile-username text-center">Connection Status</h3>
                <ul id="status"  class="list-group list-group-unbordered mb-3">
                  <p style="text-align: center;margin-top: 50px;">Data Loading....</p>
               </ul>
              </div>
              <!-- /.card-body -->
            </div>

          </div>

            
          <!-- /.col -->
          
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<!-- Billing Cycle Change Model Start -->

 <div class="modal fade" id="billingcycle">
        <div class="modal-dialog">
          <div class="modal-content col-md-16">
            <div class="modal-header">
              <h4 class="modal-title">Cycle Change</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>   
            <div class="modal-body">
              <form action="cyclechange.php" method="POST">
              <div class="row">
                 <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">Current Cycle</label>
                    <input readonly type="text" class="form-control"  value="<?php echo $row11['cycle']; ?>">
                    <input style="display: none;" name="custid" type="text" class="form-control"  value="<?php echo $row11['custid']; ?>">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">Select New Cycle</label>
                    <select name="newcycle" class="form-control">
                       <?php 

                      $sql = "SELECT * FROM cycle WHERE sec='$secid' AND status='1'";
                      $result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

                      ?>
                      <option value="<?php echo $row["cycle"];?>"><?php echo $row["name"];?></option>
                      <?php

                      }
                      } else {
                      echo "0 results";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">Set Action</label>
                    <button class="btn btn-primary">Submit</button>
                  </div>
              </div>
                   </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <div class="modal fade" id="packagechange">
        <div class="modal-dialog">
          <div class="modal-content col-md-16">
            <div class="modal-header">
              <h4 class="modal-title">Package Change</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>   
            <div class="modal-body">
              <form action="packagechange.php" method="POST">
              <div class="row">
                 <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">Current Package</label>
                    <input readonly type="text" class="form-control"   value="<?php echo $row11['package']; ?>">
                    <input style="display: none;" name="custid" type="text" class="form-control"  value="<?php echo $row11['custid']; ?>">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">Select New Package</label>
                    <select name="newpackage" class="form-control">
                       <?php 

                      $sql = "SELECT * FROM package WHERE sec='$secid' ";
                      $result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

                      ?>
                      <option value="<?php echo $row["name"];?>"><?php echo $row["name"];?></option>
                      <?php

                      }
                      } else {
                      echo "0 results";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">Set Action</label>
                    <button class="btn btn-primary">Submit</button>
                  </div>
              </div>
                   </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>


      <!--  Billing Cycle Change Model END -->


      <!-- Password Change Command -->

      <div class="modal fade" id="passchange">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Password Change</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>   
            <div class="modal-body">
              <form action="data_update/passchange.php" method="POST">
              <div class="row">
                 <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">Current password</label>
                    <input readonly type="text" class="form-control"   value="<?php echo $row11['portalloginpassword']; ?>">
                  </div>
             <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">New Password</label>
                    <input  type="text" class="form-control" name="newpass"   placeholder="New Password">
                    <input style="display: none;" name="custid" type="text" class="form-control"  value="<?php echo $row11['custid']; ?>">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">Set Action</label>
                    <button class="btn btn-primary">Update</button>
                  </div>
              </div>
                   </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <!-- Password Change Code -->


       <div class="modal fade" id="balanceadd">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Password Change</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>   
            <div class="modal-body">
              <form action="data_update/balanceadd.php" method="POST">
              <div class="row">
                 <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">Curent Balance</label>
                    <input readonly type="text" class="form-control"   value="<?php echo $row11['balance']; ?>">
                  </div>
             <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">Receive Money</label>
                    <input  type="text" class="form-control" name="receive"   placeholder="Enter Receive Amount">
                    <input style="display: none;" name="custid" type="text" class="form-control"  value="<?php echo $row11['custid']; ?>">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">Set Action</label>
                    <button class="btn btn-primary">Update</button>
                  </div>
              </div>
                   </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>



<?php include 'inc/foter.php'; ?>

  <script>
    const spans = document.querySelectorAll('.copy-text');

    spans.forEach((span, index) => {
      span.addEventListener('click', () => {
        const textToCopy = span.getAttribute('data-copy');
        navigator.clipboard.writeText(textToCopy).then(() => {
          // Show copied message
          document.getElementById(`msg${index + 1}`).textContent = 'Copied!';
          // Clear message after 2 seconds
          setTimeout(() => {
            document.getElementById(`msg${index + 1}`).textContent = '';
          }, 2000);
        });
      });
    });
  </script>

 <script>
           

             
             setInterval(function(){ 
   userstatus();     
}, 2000);

                 
                      function userstatus(){

                          $.ajax({
                            type: 'json',
                            url: './data_chak/userstatus.php?id=<?= $id; ?>',
                            success: function(data){
                           

                  $('#status').html(data);
                                 
                            
                               
                
                             }
                        });
                      }

        </script>