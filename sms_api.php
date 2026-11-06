<?php 
include 'inc/sessaion.php';
include 'inc/heder.php'; 
include 'inc/menu.php'; 
include 'inc/config.php'; 

$sec = $_SESSION['sec'];
$sql = "SELECT * FROM sms_gtw WHERE sec='$sec'";
$row = mysqli_fetch_assoc($conn->query($sql) );





?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark">SMS API Setings</h1>
     
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Package</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">


        

          <div class="card">
              <div class="card-header">
                <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">SMS API Setings</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->


              <?php
              if (empty($row['id'])) {


                ?>




              <form action="data_add/sms_api.php" method="post" role="form">
                <div class="card-body">
                   <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div  class="form-group">
                        <label>SMS Provider Name</label>
                        <select name="provider" class="form-control">
                          <option value="bulksmsbd">bulksmsbd.net</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Sender ID</label>
                        <input name="senderid" type="text" class="form-control" placeholder="Enter Sender ID" value="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">API Secret</label>
                    <input name="api_secret" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter API Secret" value="">
                  </div>
                </div>
                 <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">SMS Provider API URL</label>
                    <input name="api_url" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter SMS Provider API URL" value="">
                  </div>
                </div>
                </div>
              </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Add</button>
                </div>
              </form>
                 <?php
                
              }else{


              
              ?>

<form action="data_update/sms_api.php" method="post" role="form">
                <div class="card-body">
                   <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div  class="form-group">
                        <label>SMS Provider Name</label>
                        <select name="provider" class="form-control">
                          <option selected value="<?= $row['name']; ?>"><?= $row['name']; ?></option>
                          <option value="bulksmsbd">bulksmsbd.net</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Sender ID</label>
                        <input name="senderid" type="text" class="form-control" placeholder="Enter Sender ID" value="<?= $row['sender_id']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">API Secret</label>
                    <input name="api_secret" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter API Secret" value="<?= $row['api']; ?>">
                  </div>
                </div>
                 <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">SMS Provider API URL</label>
                    <input name="api_url" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter SMS Provider API URL" value="<?= $row['url']; ?>">
                  </div>
                </div>
                </div>
              </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>





              <?php

}

              ?>





            </div>
              </div>
              <!-- /.card-header -->


              <?php

             // function get_balance() {
    $url = "http://bulksmsbd.net/api/getBalanceApi";
    $api_key = $row['api'];
    $data = [
        "api_key" => $api_key
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    //return ;
//}
 $json_array=json_decode($response,true);

 if (empty($json_array['balance'])) {
   
    $balance= '0 > Api Not Valid';

 }else{

       $balance= $json_array['balance'];

 }


   



              ?>
  
               <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fas fa-sms"></i></span>

              <div class="info-box-content">
                <span class="info-box-number"><?= $balance?></span>
                <span class="info-box-text">SMS Balance remaining</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
              <!-- /.card-body -->
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





