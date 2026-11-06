<?php 
include 'inc/sessaion.php';
include 'inc/heder.php'; 
include 'inc/menu.php'; 
include 'inc/config.php'; 

$sec = $_SESSION['sec'];

$sql = "SELECT * FROM profile WHERE sec='$sec'";
$row = mysqli_fetch_assoc($conn->query($sql));

$startid = $row['startid'];
$endid   = $row['endid'];

// বর্তমান সর্বোচ্চ ID বের করা
$sql = "SELECT MAX(custid) AS cust
        FROM userinfo
        WHERE custid BETWEEN $startid AND $endid";

$row = mysqli_fetch_assoc($conn->query($sql));

if (empty($row['cust'])) {
    // রেঞ্জে কোনো ইউজার না থাকলে startid থেকেই শুরু
    $newCustId = $startid;
} else {
    $newCustId = $row['cust'] + 1;
}

// রেঞ্জ শেষ হয়ে গেলে
if ($newCustId > $endid) {
    die("Customer ID Range Full");
}

?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">New User Registration</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        
      <form id="regForm" action="new_user_reg.php" method="post" style="max-width: 800px;background: none;margin: 0 auto;">
 
       <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">New User Registration</h3>
              </div>
              <!-- /.card-header -->

                <div class="card-body">
                 <div class="row" style="width: 100%">
                    <div class="form-group col-md-4">
                    <label>Customer ID</label>
                    <input readonly required="" name="custid" type="number" value="<?= $newCustId; ?>" class="form-control"  placeholder="Customer ID">
                  </div>
                  <div class="form-group col-md-8">
                    <label >User Full Name *</label>
                    <input required name="fullname" type="text" class="form-control"  placeholder="User Name">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Email Address</label>
                    <input name="email" type="email" class="form-control"  placeholder="Email Address">
                  </div>
                    <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Mobile *</label>
                    <input required name="mobile" type="text" class="form-control"  placeholder="Mobile Number">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Gender</label>
                    <select name="gender" class="form-control">
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </div>
                    <div class="form-group col-md-6">
                    <label  for="exampleInputEmail1">NID *</label>
                    <input required name="nid" type="text" class="form-control"  placeholder="NID Card Number">
                  </div>

                    <div class="form-group col-md-4">
                    <label  for="exampleInputEmail1">House</label>
                    <input name="house" type="text" class="form-control" id="exampleInputEmail1" placeholder="House">
                  </div>
                  <div class="form-group col-md-4">
                    <label  for="exampleInputEmail1">Road</label>
                    <input name="road" type="text" class="form-control" id="exampleInputEmail1" placeholder="Road">
                  </div>
                  <div class="form-group col-md-4">
                    <label  for="exampleInputEmail1">Flat</label>
                    <input name="flat" type="text" class="form-control" id="exampleInputEmail1" placeholder="Flat">
                  </div>
                  <div class="form-group col-md-6">
                    <label  for="exampleInputEmail1">Area *</label>
                    <select required name="zone" class="form-control">
                      <?php
                      $sql = "SELECT * FROM area WHERE sec='$sec'";
                      $res = $conn->query($sql);
                      while ($i = $res->fetch_assoc()) {
                      ?>
                      <option value="<?php echo  $i['name']; ?>"><?php echo  $i['name']; ?></option>
                    <?php } ?>

                    </select>
                  </div>
                   <div class="form-group col-md-6">
                    <label  for="exampleInputEmail1">Thana *</label>
                    <select required name="thana" class="form-control">
                      <?php
                      $sql = "SELECT * FROM thana WHERE sec='$sec'";
                      $res = $conn->query($sql);
                      while ($i = $res->fetch_assoc()) {
                      ?>
                      <option value="<?php echo  $i['name']; ?>"><?php echo  $i['name']; ?></option>
                    <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label  for="exampleInputEmail1">Post Code</label>
                    <input name="postcode" type="text" class="form-control" id="exampleInputEmail1" placeholder="Post Code">
                  </div>
                  <div class="form-group col-md-4">
                    <label  for="exampleInputEmail1">District *</label>
                    <select required name="distric" class="form-control">
                      <?php
                      $sql = "SELECT * FROM distric WHERE sec='$sec'";
                      $res = $conn->query($sql);
                      while ($i = $res->fetch_assoc()) {
                      ?>
                      <option value="<?php echo  $i['name']; ?>"><?php echo  $i['name']; ?></option>
                    <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label  for="exampleInputEmail1">Remarks</label>
                    <input name="remark" type="text" class="form-control" id="exampleInputEmail1" placeholder="Remarks">
                  </div>


                  <p class="form-group col-md-12">User Conncetion Information:</p>

                    <div class="form-group col-md-6">
                    <label >User ID * </label>
                    <input required id="chakuser" name="userid" type="text" class="form-control"  placeholder="User ID">
                    <span id="datachak"></span>
                  </div>

                    <div class="form-group col-md-6">
                    <label  for="exampleInputEmail1">Password *</label>
                    <input required name="password" type="text" class="form-control" id="exampleInputEmail1" placeholder="Password">
                  </div>
                  <div class="form-group col-md-6">
                    <label  for="exampleInputEmail1">Package *</label>
                    <select required name="package" class="form-control">
                      <?php 

                      $sql = "SELECT * FROM package WHERE sec='$sec'";
                      $result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

                      ?>
                      <option value="<?php echo $row["id"];?>"><?php echo $row["name"];?> @ <?php echo $row["mbill"];?> BDT</option>
                      <?php

                      }
                      } else {
                      echo "0 results";
                      }
                      ?>
                    </select>
                  </div>



                         <div class="form-group col-md-6">
                    <label  for="exampleInputEmail1">Billing Cycle *</label>
                     <select required name="cycle" class="form-control">
                    <?php 

                      $sql = "SELECT * FROM cycle WHERE sec='$sec' AND status='1'";
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
                    <label  for="exampleInputEmail1">Connection Type</label>
                     <select name="type" class="form-control">
                      <option value="UTP">UTP</option>
                      <option value="FTTH">FTTH</option>
                    </select>
                  </div>
                   <div class="form-group col-md-4">
                    <label  for="exampleInputEmail1">Onu MAC</label>
                    <input name="onumac" type="text" class="form-control" id="exampleInputEmail1" placeholder="Onu MAC">
                  </div>





</div>
</div>

<div style="text-align: center;">
  <button id="submit" class="btn btn-primary" style="width: 100px;padding: 10px;margin: 10px;">Submit</button>
</div>
  </div>



</form>
     
    





</div>


          </section>
        </div>

        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
<?php include 'inc/foter.php'; ?>

   <script>
            $(document).ready(function(){

                $("#chakuser").keyup(function(){

                    var username = $(this).val().trim();
            
                    if(username != ''){
            
                       
            
                        $.ajax({
                            url: './data_chak/useridchak.php',
                            type: 'post',
                            data: {username: username},
                            success: function(response){
                
                                $('#datachak').html(response);
                                $('#submit').html(res);
                
                             }
                        });
                    }else{
                        $("#datachak").html("");
                        $('#submit').html(res);
                    }
            
                });

            });
        </script>