<?php 
include 'inc/sessaion.php';
include 'inc/heder.php'; 
include 'inc/menu.php'; 
include 'inc/config.php'; 

$sec = $_SESSION['sec'];
$sql = "SELECT * FROM sms_temp WHERE sec='$sec' AND msg_sec='welcome'";
$row = mysqli_fetch_assoc($conn->query($sql) );

if (empty($row['id'])) {

    
    $msg = "Dear {CUST_NAME}, Welcome to Your Company Name, Your UserID is: {USER_ID},  Password : {PASSWORD}. ,Monthly Bill : {RATE},
Enjoy your new connection. Thanks - 
Support: mobile Number .";
$status= "Inactive";
$datasrc = 'data_add';

}else{

$msg = $row['msg'];
$status= $row['status'];
$datasrc = 'data_update';
}







?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark">SMS Setings</h1>
     
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">SMS Setings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">


        <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#welcome" data-toggle="tab">Welcome</a></li>
                  <li class="nav-item"><a class="nav-link" href="#paidmsg" data-toggle="tab">Receive payment</a></li>
                  <li class="nav-item"><a class="nav-link" href="#billalert" data-toggle="tab">Bill Alert</a></li>
                  <li class="nav-item"><a class="nav-link" href="#ticket " data-toggle="tab">Create Ticket</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">

                  <!-- Welcome Mesage -->

                  <div class="active tab-pane" id="welcome">
                   <div class="row">
                     <div class="col-md-6">
                      <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">User Welcome Mesage Setings</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= $datasrc?>/welcomemsg.php" method="post" role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Message</label>
                    <textarea id="textbox" name="msg" onkeyup="charcountupdate(this.value)" style="height: 200px;" class="form-control"><?= $msg?></textarea>


 <div>
                          <p style="margin-top: 10px;margin-left: 10px;color: green;font-size: 20px;">Character Count: <span id=charcount>0</span></p>
                        <p style="margin-top: -20px; margin-left: 10px;color: red;font-size: 20px;">SMS Count : <span id=smscount>0</span></p>
                     </div>

<script>
function charcountupdate(strlen) {
        var lng = strlen.length;
        var count = lng / 158;
        var sms = Math.ceil(count);
        document.getElementById("smscount").innerHTML = sms;
        document.getElementById("charcount").innerHTML = lng;
        }

 
                      </script>
                  </div>
                  <div class="form-group">
                     <div class="form-group">
                        <label>Welcome Message Sending Status</label>
                        <select name="status" class="custom-select">
                          <option selected><?= $status?></option>
                          <option style="color: green;" value="Active">Active</option>
                          <option style="color: red;" value="Inactive">Inactive</option>
                        </select>
                      </div>
                  </div>
               
   
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
                       
                     </div>
                     <div class="col-md-6">
                      <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title" style="font-size: 14px;">User following Patterns to include some information from database in the SMS:</h3>
              </div>

              <div class="card-body">
                <table style="width:100%">
                  <tr>
                    <td>{EXPIRE_DATE}</td>
                    <td>=</td>
                    <td>Expiry date of customer</td>
                  </tr>
                  <tr>
                  <td>{USER_ID}</td>
                  <td>=</td>
                  <td> Login ID/Username</td>
                  </tr>
                   <tr>
                  <td>{CUSTOMER_ID}</td>
                  <td>=</td>
                  <td> Customer ID</td>
                  </tr>
                   <tr>
                  <td>{CUST_NAME}</td>
                  <td>=</td>
                  <td>Customer Full Name</td>
                  </tr>
                   <tr>
                  <td>{AMOUNT}</td>
                  <td>=</td>
                  <td>Amount Paid</td>
                  </tr>
                   <tr>
                  <td>{DUE}</td>
                  <td>=</td>
                  <td>Amount Due</td>
                  </tr>
                  <tr>
                  <td>{PACKAGE}</td>
                  <td>=</td>
                  <td>Package Name</td>
                  </tr>
                  <tr>
                  <td>{RATE}</td>
                  <td>=</td>
                  <td>Package Rate</td>
                  </tr>
                  <tr>
                  <td>{PASSWORD}</td>
                  <td>=</td>
                  <td>Password</td>
                  </tr>
                </table>


                
              </div>
            </div>
           

            </div>
                       
                     </div>
                   </div>
                

                <!-- Bill Payment Message Setings -->
<?php

$sql1 = "SELECT * FROM sms_temp WHERE sec='$sec' AND msg_sec='paidmsg'";
$row1 = mysqli_fetch_assoc($conn->query($sql1) );

if (empty($row1['id'])) {

    
    $msg1 = "Dear {CUST_NAME}, billing to Your Company Name, Your UserID is: {USER_ID},  Password : {PASSWORD}. ,Monthly Bill : {RATE},
Enjoy your new connection. Thanks - 
Support: mobile Number .";
$status1= "Inactive";
$datasrc1 = 'data_add';

}else{

$msg1 = $row1['msg'];
$status1= $row1['status'];
$datasrc1 = 'data_update';
}


?>

                  <div class="tab-pane" id="paidmsg">
                    <div class="row">
                     <div class="col-md-6">
                      <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Receive payment Mesage Setings</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= $datasrc1?>/paidmsg.php" method="post"  role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Message</label>
                    <textarea id="textbox" name="msg" onkeyup="charcountupdate(this.value)" style="height: 200px;" class="form-control"><?= $msg1?></textarea>


 <div>
                          <p style="margin-top: 10px;margin-left: 10px;color: green;font-size: 20px;">Character Count: <span id=charcount>0</span></p>
                        <p style="margin-top: -20px; margin-left: 10px;color: red;font-size: 20px;">SMS Count : <span id=smscount>0</span></p>
                     </div>

<script>
function charcountupdate(strlen) {
        var lng = strlen.length;
        var count = lng / 158;
        var sms = Math.ceil(count);
        document.getElementById("smscount").innerHTML = sms;
        document.getElementById("charcount").innerHTML = lng;
        }

 
                      </script>
                  </div>
                  <div class="form-group">
                     <div class="form-group">
                        <label>Receive payment Message Sending Status</label>
                        <select name="status" class="custom-select">
                          <option selected value="<?= $status1?>"><?= $status1?></option>
                          <option style="color: green;" value="Active">Active</option>
                          <option style="color: red;" value="Inactive">Inactive</option>
                        </select>
                      </div>
                  </div>
               
   
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
                       
                     </div>
                     <div class="col-md-6">
                      <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title" style="font-size: 14px;">User following Patterns to include some information from database in the SMS:</h3>
              </div>

              <div class="card-body">
                <table style="width:100%">
                  <tr>
                    <td>{EXPIRE_DATE}</td>
                    <td>=</td>
                    <td>Expiry date of customer</td>
                  </tr>
                  <tr>
                  <td>{USER_ID}</td>
                  <td>=</td>
                  <td> Login ID/Username</td>
                  </tr>
                   <tr>
                  <td>{CUSTOMER_ID}</td>
                  <td>=</td>
                  <td> Customer ID</td>
                  </tr>
                   <tr>
                  <td>{CUST_NAME}</td>
                  <td>=</td>
                  <td>Customer Full Name</td>
                  </tr>
                   <tr>
                  <td>{AMOUNT}</td>
                  <td>=</td>
                  <td>Amount Paid</td>
                  </tr>
                   <tr>
                  <td>{DUE}</td>
                  <td>=</td>
                  <td>Amount Due</td>
                  </tr>
                  <tr>
                  <td>{PACKAGE}</td>
                  <td>=</td>
                  <td>Package Name</td>
                  </tr>
                  <tr>
                  <td>{RATE}</td>
                  <td>=</td>
                  <td>Package Rate</td>
                  </tr>
                  <tr>
                  <td>{PASSWORD}</td>
                  <td>=</td>
                  <td>Password</td>
                  </tr>
                </table>


                
              </div>
            </div>
           

            </div>
                       
                     </div>

                  </div>

                  <?php

$sql1 = "SELECT * FROM sms_temp WHERE sec='$sec' AND msg_sec='billalert'";
$row1 = mysqli_fetch_assoc($conn->query($sql1) );

if (empty($row1['id'])) {

    
    $msg1 = "Dear {CUST_NAME}, billalert to Your Company Name, Your UserID is: {USER_ID},  Password : {PASSWORD}. ,Monthly Bill : {RATE},
Enjoy your new connection. Thanks - 
Support: mobile Number .";
$status1= "Inactive";
$datasrc1 = 'data_add';

}else{

$msg1 = $row1['msg'];
$status1= $row1['status'];
$before1= $row1['before1'];
$before2= $row1['before2'];
$before3= $row1['before3'];
$datasrc1 = 'data_update';
}


?>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="billalert">

                     <div class="row">
                     <div class="col-md-6">
                      <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Bill Alert Mesage Setings</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= $datasrc1?>/billalertmsg.php" method="post"  role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Message</label>
                    <textarea id="textbox" name="msg" onkeyup="charcountupdate(this.value)" style="height: 200px;" class="form-control"><?= $msg1?></textarea>


 <div>
                          <p style="margin-top: 10px;margin-left: 10px;color: green;font-size: 20px;">Character Count: <span id=charcount>0</span></p>
                        <p style="margin-top: -20px; margin-left: 10px;color: red;font-size: 20px;">SMS Count : <span id=smscount>0</span></p>
                     </div>

<script>
function charcountupdate(strlen) {
        var lng = strlen.length;
        var count = lng / 158;
        var sms = Math.ceil(count);
        document.getElementById("smscount").innerHTML = sms;
        document.getElementById("charcount").innerHTML = lng;
        }

 
                      </script>
                  </div>
                  <div class="form-group">
                     <div class="form-group">
                        <label>Bill Alert Message Sending Status</label>
                        <select name="status" class="custom-select">
                          <option selected value="<?= $status1?>"><?= $status1?></option>
                          <option style="color: green;" value="Active">Active</option>
                          <option style="color: red;" value="Inactive">Inactive</option>
                        </select>
                      </div>
                  </div>

                   <div class="form-group">
                     <div class="form-group">
                        <label>Message Send Before 1 Day</label>
                        <select name="before1" class="custom-select">
                          <option selected value="<?= $before1?>"><?= $before1?></option>
                          <option style="color: green;" value="Yes">Yes</option>
                          <option style="color: red;" value="NO">NO</option>
                        </select>
                      </div>
                  </div>
               
                  <div class="form-group">
                     <div class="form-group">
                        <label>Message Send Before 2 Day</label>
                        <select name="before2" class="custom-select">
                          <option selected value="<?= $before2 ?>"><?= $before2?></option>
                          <option style="color: green;" value="Yes">Yes</option>
                          <option style="color: red;" value="NO">NO</option>
                        </select>
                      </div>
                  </div>

                   <div class="form-group">
                     <div class="form-group">
                        <label>Message Send Before 3 Day</label>
                        <select name="before3" class="custom-select">
                          <option selected value="<?= $before3 ?>"><?= $before3?></option>
                          <option style="color: green;" value="Yes">Yes</option>
                          <option style="color: red;" value="NO">NO</option>
                        </select>
                      </div>
                  </div>
   
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
                       
                     </div>
                     <div class="col-md-6">
                      <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title" style="font-size: 14px;">User following Patterns to include some information from database in the SMS:</h3>
              </div>

              <div class="card-body">
                <table style="width:100%">
                  <tr>
                    <td>{EXPIRE_DATE}</td>
                    <td>=</td>
                    <td>Expiry date of customer</td>
                  </tr>
                  <tr>
                  <td>{USER_ID}</td>
                  <td>=</td>
                  <td> Login ID/Username</td>
                  </tr>
                   <tr>
                  <td>{CUSTOMER_ID}</td>
                  <td>=</td>
                  <td> Customer ID</td>
                  </tr>
                   <tr>
                  <td>{CUST_NAME}</td>
                  <td>=</td>
                  <td>Customer Full Name</td>
                  </tr>
                   <tr>
                  <td>{AMOUNT}</td>
                  <td>=</td>
                  <td>Amount Paid</td>
                  </tr>
                   <tr>
                  <td>{DUE}</td>
                  <td>=</td>
                  <td>Amount Due</td>
                  </tr>
                  <tr>
                  <td>{PACKAGE}</td>
                  <td>=</td>
                  <td>Package Name</td>
                  </tr>
                  <tr>
                  <td>{RATE}</td>
                  <td>=</td>
                  <td>Package Rate</td>
                  </tr>
                  <tr>
                  <td>{PASSWORD}</td>
                  <td>=</td>
                  <td>Password</td>
                  </tr>
                </table>


                
              </div>
            </div>
           

            </div>
                       
                     </div>
              
                  </div>
           <!-- /.tab-pane -->
            <?php      
$sql1 = "SELECT * FROM sms_temp WHERE sec='$sec' AND msg_sec='create_ticket'";
$row1 = mysqli_fetch_assoc($conn->query($sql1) );

if (empty($row1['id'])) {

    
    $msg1 = "Dear {CUST_NAME}, billalert to Your Company Name, Your UserID is: {USER_ID},  Password : {PASSWORD}. ,Monthly Bill : {RATE},
Enjoy your new connection. Thanks - 
Support: mobile Number .";
$status1= "Inactive";
$datasrc1 = 'data_add';

}else{

$msg1 = $row1['msg'];
$status1= $row1['status'];
$datasrc1 = 'data_update';
}


?>


                  <div class="tab-pane" id="ticket">
                   <div class="row">
                     <div class="col-md-6">
                      <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Create Ticket Mesage Setings</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= $datasrc1?>/create_ticket.php" method="post"  role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Message</label>
                    <textarea id="textbox" name="msg" onkeyup="charcountupdate(this.value)" style="height: 200px;" class="form-control"><?= $msg1?></textarea>


 <div>
                          <p style="margin-top: 10px;margin-left: 10px;color: green;font-size: 20px;">Character Count: <span id=charcount>0</span></p>
                        <p style="margin-top: -20px; margin-left: 10px;color: red;font-size: 20px;">SMS Count : <span id=smscount>0</span></p>
                     </div>

<script>
function charcountupdate(strlen) {
        var lng = strlen.length;
        var count = lng / 158;
        var sms = Math.ceil(count);
        document.getElementById("smscount").innerHTML = sms;
        document.getElementById("charcount").innerHTML = lng;
        }

 
                      </script>
                  </div>
                  <div class="form-group">
                     <div class="form-group">
                        <label>Create Ticket Message Sending Status</label>
                        <select name="status" class="custom-select">
                          <option selected value="<?= $status1?>"><?= $status1?></option>
                          <option style="color: green;" value="Active">Active</option>
                          <option style="color: red;" value="Inactive">Inactive</option>
                        </select>
                      </div>
                  </div>
               
   
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
                       
                     </div>
                     <div class="col-md-6">
                      <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title" style="font-size: 14px;">User following Patterns to include some information from database in the SMS:</h3>
              </div>

              <div class="card-body">
                <table style="width:100%">
                  <tr>
                    <td>{EXPIRE_DATE}</td>
                    <td>=</td>
                    <td>Expiry date of customer</td>
                  </tr>
                  <tr>
                  <td>{USER_ID}</td>
                  <td>=</td>
                  <td> Login ID/Username</td>
                  </tr>
                   <tr>
                  <td>{CUSTOMER_ID}</td>
                  <td>=</td>
                  <td> Customer ID</td>
                  </tr>
                   <tr>
                  <td>{CUST_NAME}</td>
                  <td>=</td>
                  <td>Customer Full Name</td>
                  </tr>
                   <tr>
                  <td>{AMOUNT}</td>
                  <td>=</td>
                  <td>Amount Paid</td>
                  </tr>
                   <tr>
                  <td>{DUE}</td>
                  <td>=</td>
                  <td>Amount Due</td>
                  </tr>
                  <tr>
                  <td>{PACKAGE}</td>
                  <td>=</td>
                  <td>Package Name</td>
                  </tr>
                  <tr>
                  <td>{RATE}</td>
                  <td>=</td>
                  <td>Package Rate</td>
                  </tr>
                  <tr>
                  <td>{PASSWORD}</td>
                  <td>=</td>
                  <td>Password</td>
                  </tr>
                </table>


                
              </div>
            </div>
           

            </div>
                       
                     </div>
              
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
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





